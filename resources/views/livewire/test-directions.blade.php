<div>
    <div class="grid grid-cols-2 p-2">
        <div class="row" style="margin-top:140px">
            <div class="col-md-5 p-3">
                <div class="container p-4"
                    style="max-width:450px; margin:0 auto; margin-top:0px; border: 1px solid #ccc; border-radius: 5px;">
                    <h5 class="text-light">Order a ride {{ env('APP_NAME') }}</h5>
                    <div>
                        @csrf
                        <div class="input-group mb-3">
                            <span class="input-group-text input-group-text-right">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                            </span>
                            <input type="text" id="location" wire:model.debounce.500ms="location"
                                class="form-control my-form-control" placeholder="Enter Location">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text input-group-text-right">
                                <i class="fa fa-map" aria-hidden="true"></i>
                            </span>
                            <input type="text" id="destination" wire:model.debounce.500ms="destination"
                                class="form-control my-form-control" placeholder="Enter Destination">
                        </div>
                    </div>
                    <a id="bookRide" class="my-btn-dark" style="border-radius:5px; cursor:pointer;">Book Ride</a>
                    {{-- <div id="vehicleList" style="max-height: 300px; overflow-y: auto; padding: 10px; background: rgb(245, 245, 245); border-radius: 8px;"><div class="vehicle-card" data-vehicle-id="25">
                        <div class="vehicle-details">
                            <div class="vehicle-image">
                                <i class="fa fa-car" style="font-size:35px"></i>
                            </div>
                            <div class="vehicle-info">
                                <h3>Chevrolet 911</h3>
                                <div class="vehicle-stats">
                                    <span class="distance">
                                        <i class="fa fa-map-marker"></i> Driver is on his way
                                    </span>
                                </div>
                            </div>
                        </div>
                        <button onclick="startNavigation({" lat":9.1198654,"lng":7.385714600000001},="" {"lat":9.0677252,"lng":7.451543999999999})"="" class="select-vehicle-btn">Start Trip</button>
                        <button onclick="startNavigation({" lat":9.1198654,"lng":7.385714600000001},="" {"lat":9.0677252,"lng":7.451543999999999})"="" class="select-vehicle-btn">Start Trip</button>
                    </div></div> --}}
                </div>
                <div id="vehicleList"></div>
            </div>
            <div class="col-md-7 p-3" id="map" style="height: 100vh;" wire:ignore></div>
        </div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfBwLJ8_9K-iu7vf1jJ7B2vdr5cpA3qPw&libraries=places" async
    defer></script>

{{-- <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.0/dist/echo.iife.js"></script> --}}
{{-- <script src="https://js.pusher.com/7.0/pusher.min.js"></script> --}}
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>


<script>
    Pusher.logToConsole = false;
    var pusher = new Pusher('62fa54aa1df62c15f35a', {
        cluster: 'eu'
    });

    let map, markerLocation, markerDestination, autocompleteLocation, autocompleteDestination;
    let directionsService, directionsRenderer;
    let navigationStarted = false;
    let driverLocation = null;
    let navigationInterval = null;

    const userId = {{ auth()->user()->id }};
    const channel = pusher.subscribe(`user.${userId}`)


    // channel.bind('RideAccepted', (data) => {

    //     startNavigation(data.vehId, data.pickupLocation, data.dropoffLocation);
    //     console.log('Ride Accpt:', data);
    //     alert('Your ride has been accepted by the driver!');
    // });

channel.bind('RideAccepted', (data) => {
    // console.log('Ride Accepted:', data);
    // console.log('pickup:', data.pickupLocation);
    // console.log('dropoff:', data.dropoffLocation);
    // Preserve the existing route
    const pickupLocation = JSON.parse(data.pickupLocation);
    const dropoffLocation = JSON.parse(data.dropoffLocation);

    // Update vehicle selection UI
    $('.vehicle-card .select-vehicle-btn')
        .text('Driver Accepted')
        .prop('disabled', true)
        .addClass('accepted');

    // Start navigation
    startNavigation(data.vehId, pickupLocation, dropoffLocation);

    // console.log('Ride Accepted:', data);
    alert('Your ride has been accepted by the driver!');
});


    function initMap() {

        if (!google || !google.maps || !google.maps.Map) {
        console.error('Google Maps API not loaded');
        return;
        }
        // Initialize the map
        map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: -1.2921,
                lng: 36.8219
            }, // Default to Nairobi
            zoom: 12,
        });

        // Initialize markers
        markerLocation = new google.maps.Marker({
            map: map,
            title: "Location"
        });

        markerDestination = new google.maps.Marker({
            map: map,
            title: "Destination"
        });

        // Directions Service and Renderer for displaying the route
        directionsService = new google.maps.DirectionsService();
        directionsRenderer = new google.maps.DirectionsRenderer();
        directionsRenderer.setMap(map); // Link the directions renderer to the map

        // Geolocation API to center the map on the user's current location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                const userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };
                map.setCenter(userLocation);
                // console.log('current location', userLocation);
                markerLocation.setPosition(userLocation); // Set user's location marker
            });
        }

        // Initialize Google Places Autocomplete for Location
        autocompleteLocation = new google.maps.places.Autocomplete(document.getElementById('location'));
        autocompleteLocation.addListener('place_changed', () => {
            const place = autocompleteLocation.getPlace();
            if (!place.geometry) return; // If no place found, return early

            const location = place.geometry.location;
            markerLocation.setPosition(location); // Update location marker
            map.setCenter(location); // Center the map on location
            map.setZoom(14); // Zoom in to location
            @this.set('location', place.formatted_address); // Update Livewire model
        });

        // Initialize Google Places Autocomplete for Destination
        autocompleteDestination = new google.maps.places.Autocomplete(document.getElementById('destination'));
        autocompleteDestination.addListener('place_changed', () => {
            const place = autocompleteDestination.getPlace();
            if (!place.geometry) return; // If no place found, return early

            const destination = place.geometry.location;
            markerDestination.setPosition(destination); // Update destination marker
            map.setCenter(destination); // Center the map on destination
            map.setZoom(14); // Zoom in to destination
            @this.set('destination', place.formatted_address); // Update Livewire model

            // Now that we have both location and destination, calculate the route
            calculateRoute(markerLocation.getPosition(), destination);
        });
    }

    // Function to calculate and display the route
    function calculateRoute(start, end) {
        const request = {
            origin: start,
            destination: end,
            travelMode: google.maps.TravelMode.DRIVING, // Or WALKING, BICYCLING, etc.
        };

        directionsService.route(request, (result, status) => {
            if (status === google.maps.DirectionsStatus.OK) {
                directionsRenderer.setDirections(result); // Display the route
            } else {
                console.error('Directions request failed due to ' + status);
            }
        });
    }

    // Load the map when the component is mounted
    document.addEventListener('livewire:load', () => {
        initMap();
    });

    document.addEventListener('DOMContentLoaded', () => {
    // Get query parameters from the URL
    const urlParams = new URLSearchParams(window.location.search);
    const location = urlParams.get('location');
    const destination = urlParams.get('destination');

    if (location && destination) {
        geocodeAndSetMarkers(location, destination);
    }
});

function geocodeAndSetMarkers(location, destination) {
    const geocoder = new google.maps.Geocoder();

    // Geocode pickup location
    geocoder.geocode({ address: location }, (results, status) => {
        if (status === 'OK') {
            const pickupCoords = results[0].geometry.location;
            markerLocation.setPosition(pickupCoords);
            map.setCenter(pickupCoords); // Optionally center map on pickup location

            const pickupField = document.getElementById('location');
            if (pickupField) {
                pickupField.value = location;
            } else {
                console.error("Pickup field not found in DOM.");
            }
        } else {
            console.error('Geocoding failed for location:', status);
            alert('Failed to set pickup location.');
        }
    });

    // Geocode dropoff location
    geocoder.geocode({ address: destination }, (results, status) => {
        if (status === 'OK') {
            const dropoffCoords = results[0].geometry.location;
            markerDestination.setPosition(dropoffCoords);

            const dropoffField = document.getElementById('destination');
            if (dropoffField) {
                dropoffField.value = destination;
            } else {
                console.error("Dropoff field not found in DOM.");
            }

            // Draw route after setting both markers
            calculateRoute(markerLocation.getPosition(), markerDestination.getPosition());
        } else {
            console.error('Geocoding failed for destination:', status);
            alert('Failed to set dropoff location.');
        }
    });
}

function calculateRoute(pickup, dropoff) {
    const directionsService = new google.maps.DirectionsService();
    const directionsRenderer = new google.maps.DirectionsRenderer();

    directionsRenderer.setMap(map);

    const request = {
        origin: pickup,
        destination: dropoff,
        travelMode: google.maps.TravelMode.DRIVING,
    };

    directionsService.route(request, (result, status) => {
        if (status === google.maps.DirectionsStatus.OK) {
            directionsRenderer.setDirections(result);
        } else {
            console.error('Failed to calculate route:', status);
            alert('Could not calculate route.');
        }
    });
}


document.getElementById('bookRide').addEventListener('click', () => {
    $("#bookRide").html('Processing...');
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {
            const pickupPosition = markerLocation.getPosition();
            const dropoffPosition = markerDestination.getPosition();

            if (!pickupPosition || !dropoffPosition) {
                alert("Please set both pickup and dropoff locations.");
                $("#bookRide").html('Book Ride');
                return;
            }

            const pickupLocation = {
                lat: pickupPosition.lat(),
                lng: pickupPosition.lng(),
            };

            const dropoffLocation = {
                lat: dropoffPosition.lat(),
                lng: dropoffPosition.lng(),
            };

            if (isNaN(pickupLocation.lat) || isNaN(pickupLocation.lng) ||
                isNaN(dropoffLocation.lat) || isNaN(dropoffLocation.lng)) {
                alert("Invalid pickup or dropoff location.");
                console.error("Invalid coordinates:", {
                    pickupLocation,
                    dropoffLocation
                });
                $("#bookRide").html('Book Ride');
                return;
            }

            const requestData = {
                pickup: pickupLocation,
                dropoff: dropoffLocation,
                vehicle_id: 25, // Adjust as needed
            };

            fetch('/request-ride', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                    },
                    body: JSON.stringify(requestData),
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        $("#bookRide").html('Book Ride');
                        const rideId = data.rideRequest.id;
                        getNearbyVehicles(pickupLocation.lat, pickupLocation.lng, rideId);
                    } else {
                        console.error('Error:', data.message);
                        alert('Failed to request ride.');
                        $("#bookRide").html('Book Ride');
                    }
                })
                .catch((error) => {
                    console.error('Error submitting ride request:', error);
                    $("#bookRide").html('Book Ride');
                });
        }, (error) => {
            alert("Unable to retrieve your location.");
            console.error(error);
            $("#bookRide").html('Book Ride');
        });
    } else {
        alert("Geolocation is not supported by this browser.");
        $("#bookRide").html('Book Ride');
    }
});



    // Function to get nearby vehicles based on the user's location (you can reuse this logic from the previous solution)
    function getNearbyVehicles(user_lat, user_lng, rideId) {
        fetch('/get-nearby-vehicles', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    origin_lat: user_lat,
                    origin_lng: user_lng
                })
            })
            .then(response => response.json())
            .then(data => {
                if (Array.isArray(data.vehicles) && data.vehicles.length > 0) {
                    const vehicles = data.vehicles;
                    const vehicleList = $('#vehicleList');
                    vehicleList.empty(); // Clear previous list

                    // Improved vehicle display
                    vehicles.forEach(vehicle => {
                        // Predefined car images (replace with actual URLs)
                        const carImages = [
                            'img/car-icon.png',
                            'img/car-icon.png',
                            'img/car-icon.png'
                        ];
                        const randomCarImage = carImages[Math.floor(Math.random() * carImages.length)];

                        // Create vehicle card
                        // <img src="${randomCarImage}" alt="${vehicle.vehicleMake} ${vehicle.vehicleModel}">
                        const vehicleCard = $(`
                        <div class="vehicle-card" data-vehicle-id="${vehicle.id}">
                            <div class="vehicle-details">
                                <div class="vehicle-image">
                                    <img src="${randomCarImage}" alt="${vehicle.vehicleMake} ${vehicle.vehicleModel}">
                                </div>
                                <div class="vehicle-info">
                                    <h3>${vehicle.vehicleMake} ${vehicle.vehicleModel}</h3>
                                    <div class="vehicle-stats">
                                        <span class="distance">
                                            <i class="fa fa-map-marker"></i> ${vehicle.distance.toFixed(2)} km away
                                        </span>
                                        <span class="eta">
                                            <i class="fa fa-clock-o"></i> ${Math.round(vehicle.distance * 10)} min
                                        </span>
                                    </div>
                                    <div class="vehicle-pricing">
                                        <span class="price">$${(vehicle.distance * 500).toFixed(2)}</span>
                                    </div>
                                </div>
                            </div>
                            <button onclick="selectVehicle(${vehicle.id}, ${rideId}, ${Math.round(vehicle.distance * 10)}, ${(vehicle.distance * 500).toFixed(2)})" class="select-vehicle-btn">Select</button>
                        </div>
                    `);

                        // Add markers to the map
                        const vehicleMarker = new google.maps.Marker({
                            position: {
                                lat: vehicle.latitude,
                                lng: vehicle.longitude
                            },
                            map: map,
                            icon: {
                                url: 'img/car-icon.png', // Car icon
                                scaledSize: new google.maps.Size(40, 40)
                            },
                            title: `${vehicle.vehicleMake} ${vehicle.vehicleModel}`
                        });

                        // Highlight vehicle card and marker on hover
                        vehicleCard.hover(
                            function() {
                                $(this).addClass('highlighted');
                                vehicleMarker.setIcon({
                                    url: 'img/car-icon.png', // Highlighted car icon
                                    scaledSize: new google.maps.Size(50, 50)
                                });
                            },
                            function() {
                                $(this).removeClass('highlighted');
                                vehicleMarker.setIcon({
                                    url: 'img/car-icon.png',
                                    scaledSize: new google.maps.Size(40, 40)
                                });
                            }
                        );

                        // Vehicle selection
                        vehicleCard.find('.select-vehicle-btn').on('click', function() {
                            // Remove selection from other vehicles
                            $('.vehicle-card').removeClass('selected');
                            vehicleList.find('button').text('Select');

                            // Mark this vehicle as selected
                            $(this).closest('.vehicle-card').addClass('selected');
                            $(this).text('Selected');

                            // Store selected vehicle ID
                            window.selectedVehicleId = vehicle.id;
                        });

                        vehicleList.append(vehicleCard);
                    });

                    // Style the vehicle list container
                    vehicleList.css({
                        'max-height': '300px',
                        'overflow-y': 'auto',
                        'padding': '10px',
                        'background': '#f5f5f5',
                        'border-radius': '8px'
                    });
                } else {
                    console.log('No vehicles found within 5km radius.');
                    $('#vehicleList').html('<p style="padding: 25px; margin-top:15px; text-align: center; font-weight: bold; background: lightgray;">No vehicles available nearby</p>');
                }
            })
            .catch(error => console.error('Error fetching vehicles:', error));
    }

    const style = document.createElement('style');
    style.textContent = `
        .vehicle-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        .vehicle-card:hover {
            box-shadow: 0 4px 6px rgba(0,0,0,0.15);
            transform: translateY(-3px);
        }
        .vehicle-card.selected {
            border-color: #4CAF50;
            background-color: #e8f5e9;
        }
        .vehicle-details {
            display: flex;
            align-items: center;
            flex-grow: 1;
        }
        .vehicle-image {
            width: 100px;
            height: 100px;
            margin-right: 15px;
        }
        .vehicle-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }
        .vehicle-info {
            flex-grow: 1;
        }
        .vehicle-stats {
            display: flex;
            gap: 15px;
            color: #666;
            margin-top: 5px;
        }
        .select-vehicle-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .select-vehicle-btn:hover {
            background-color: #45a049;
        }
        .select-vehicle-btn.waiting {
            background-color: #FFC107;
            color: black;
        }
        .select-vehicle-btn.accepted {
            background-color: #2196F3;
            color: white;
        }
        .select-vehicle-btn.start-trip {
            background-color: #4CAF50;
            color: white;
        }
    `;
    document.head.appendChild(style);


function selectVehicle(vehicleId, rideId, distance, price) {
    const requestData = {
        vehicleId,
        rideId,
        distance,
        price
    };

    // Remove all vehicle cards except the selected one
    $('.vehicle-card').each(function() {
        const currentVehicleId = $(this).data('vehicle-id');
        if (currentVehicleId !== vehicleId) {
            $(this).remove();
        }
    });

    // Remove other vehicle markers from the map
    // map.getObjects().forEach(function(obj) {
    //     if (obj instanceof google.maps.Marker && obj.getTitle() !== 'Your Driver') {
    //         obj.setMap(null);
    //     }
    // });

    fetch('/select-vehicle', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify(requestData),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update the select button to "Start Trip"
            const vehicleCard = $(`.vehicle-card[data-vehicle-id="${vehicleId}"]`);
            vehicleCard.find('.select-vehicle-btn')
                .text('Waiting for Driver')
                .prop('disabled', true)
                .addClass('waiting');
        } else {
            alert('Failed to select vehicle.');
        }
    })
    .catch(error => console.error('Error selecting vehicle:', error));
}


function startNavigation(vehId, driverInitialLocation, destinationLocation) {
    if (!google || !google.maps || !google.maps.Map) {
        console.error('Google Maps API not loaded');
        return;
    }

    if (!directionsService || !directionsRenderer) {
        console.error('Directions services not initialized');
        return;
    }

    // const pickup = JSON.parse(driverInitialLocation);
    // const dropoff = JSON.parse(destinationLocation);
    const pickup = driverInitialLocation;
    const dropoff = destinationLocation;

    if (!pickup?.lat || !pickup?.lng || !dropoff?.lat || !dropoff?.lng) {
        console.error('Invalid coordinates', { pickup, dropoff });
        return;
    }

    if (!map) {
        map = new google.maps.Map(document.getElementById('map'), {
            center: pickup,
            zoom: 16
        });
    } else {
        map.setCenter(pickup);
    }
    directionsRenderer.setMap(null);

    const pickupMarker = new google.maps.Marker({
        map: map,
        position: pickup,
        title: 'Pickup Location'
    });

    const dropoffMarker = new google.maps.Marker({
        map: map,
        position: dropoff,
        title: 'Dropoff Location'
    });

    let driverMarker = null;
    let lastDriverPosition = null;
    let driverAtPickup = false;

    function updateDriverLocation(newLocation) {
        if (!newLocation?.lat || !newLocation?.lng) {
            console.error('Invalid new location', newLocation);
            return;
        }

        if (!driverMarker) {
            driverMarker = new google.maps.Marker({
                map: map,
                position: newLocation,
                icon: {
                    url: 'img/car-icon.png',
                    scaledSize: new google.maps.Size(50, 50)
                },
                title: 'Your Driver'
            });
        } else {
            driverMarker.setPosition(newLocation);
        }

        const pickupDistance = google.maps.geometry.spherical.computeDistanceBetween(
            new google.maps.LatLng(newLocation.lat, newLocation.lng),
            new google.maps.LatLng(pickup.lat, pickup.lng)
        );

        if (pickupDistance <= 100 && !driverAtPickup) {
            driverAtPickup = true;

            $('.vehicle-card .select-vehicle-btn')
                .text('Start Trip')
                .prop('disabled', false)
                .removeClass('accepted')
                .addClass('start-trip');
        }

        const distanceMoved = lastDriverPosition
            ? google.maps.geometry.spherical.computeDistanceBetween(
                new google.maps.LatLng(lastDriverPosition.lat, lastDriverPosition.lng),
                new google.maps.LatLng(newLocation.lat, newLocation.lng)
            )
            : Infinity;

        if (distanceMoved >= 100 || !lastDriverPosition) {
            lastDriverPosition = newLocation;

            const request = {
                origin: new google.maps.LatLng(newLocation.lat, newLocation.lng),
                // destination: new google.maps.LatLng(pickup.lat, pickup.lng),
                destination: dropoff,
                waypoints: [{
                    location: pickup,
                    stopover: true
                }],
                travelMode: google.maps.TravelMode.DRIVING
            };

            directionsService.route(request, (result, status) => {
                if (status === google.maps.DirectionsStatus.OK) {
                    directionsRenderer.setMap(map);
                    directionsRenderer.setDirections(result);
                } else {
                    console.error('Directions request failed:', status);
                }
            });
        }
    }

    const driverLocationChannel = pusher.subscribe(`ride.${vehId}`);
    driverLocationChannel.bind('DriverLocation', (locationData) => {
        // console.error('Drivers Location:', locationData);
        try {
            const parsedLocationData = typeof locationData === 'string'
                ? JSON.parse(locationData)
                : locationData;

            if (parsedLocationData.latitude && parsedLocationData.longitude) {
                updateDriverLocation({
                    lat: parseFloat(parsedLocationData.latitude),
                    lng: parseFloat(parsedLocationData.longitude)
                });
            } else {
                console.error('Invalid location data:', parsedLocationData);
            }
        } catch (error) {
            console.error('Error processing DriverLocation event:', error);
        }
    });

    $(document).on('click', '.start-trip', function() {
        if (driverMarker) {
            driverMarker.setMap(null);
        }
        startUserTracking(dropoff);
    });
}


function startUserTracking(dropoff) {
    if (navigator.geolocation) {
        const watchId = navigator.geolocation.watchPosition(
            (position) => {
                const userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                // Update route to dropoff
                const request = {
                    origin: new google.maps.LatLng(userLocation.lat, userLocation.lng),
                    destination: new google.maps.LatLng(dropoff.lat, dropoff.lng),
                    travelMode: google.maps.TravelMode.DRIVING
                };

                directionsService.route(request, (result, status) => {
                    if (status === google.maps.DirectionsStatus.OK) {
                        directionsRenderer.setDirections(result);
                        map.setCenter(userLocation);
                    }
                });

                // Check if user is close to dropoff
                const dropoffDistance = google.maps.geometry.spherical.computeDistanceBetween(
                    new google.maps.LatLng(userLocation.lat, userLocation.lng),
                    new google.maps.LatLng(dropoff.lat, dropoff.lng)
                );

                if (dropoffDistance <= 100) { // Within 100 meters
                    navigator.geolocation.clearWatch(watchId);
                    alert('You have arrived at your destination!');
                    // Additional end-of-ride logic can be added here
                }
            },
            (error) => {
                console.error('Error tracking location:', error);
            },
            {
                enableHighAccuracy: true,
                maximumAge: 30000,
                timeout: 27000
            }
        );
    }
}

</script>

<!-- Google Maps API Script -->
