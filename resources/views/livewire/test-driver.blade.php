<div>
    <div class="grid grid-cols-2 p-2">
        <div class="row" style="margin-top:140px">
            <div class="col-md-5 p-3">
                <div class="container p-4"
                    style="max-width:450px; margin:0 auto; margin-top:0px; border: 1px solid #ccc; border-radius: 5px;">
                    <h5 class="text-dark">Driver</h5>
                    <!-- Driver Go Online/Offline Button -->
                    <button id="statusButton" data-status="0" class="my-btn-dark btn btn-dark" onclick="toggleDriverStatus()">
                        Go Online
                    </button>
                </div>
                <div id="userList" style="max-height: 300px; margin-top:20px; overflow-y: auto; padding: 20px; background: transparent; border-radius: 8px;">
                </div>
            </div>
            <div class="col-md-7 p-3" id="map" style="height: 100vh;" wire:ignore></div>
            <div id="directionsPanel" style="margin-top: 20px;"></div>
        </div>
    </div>
</div>
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfBwLJ8_9K-iu7vf1jJ7B2vdr5cpA3qPw&libraries=places" async defer></script> --}}
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfBwLJ8_9K-iu7vf1jJ7B2vdr5cpA3qPw"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    let isOnline = false; // Track the driver's online/offline status
    let locationInterval = null; // To store the interval ID for location updates

    function toggleDriverStatus() {
        isOnline = !isOnline; // Toggle status

        // Send the status to the backend
        fetch('/driver/toggle-status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    status: isOnline ? 1 : 0,
                    vehID: {{$vehId}}
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Driver status updated:', data);

                // Update the button text
                const button = document.getElementById('statusButton');
                button.textContent = isOnline ? 'Go Offline' : 'Go Online';

                // Start or stop location updates
                if (isOnline) {
                    startLocationUpdates();
                } else {
                    stopLocationUpdates();
                }
            })
            .catch(error => {
                console.error('Error toggling driver status:', error);
            });
    }

    function startLocationUpdates() {
        if (navigator.geolocation) {
            // Update location every 10 seconds
            locationInterval = setInterval(() => {
                navigator.geolocation.getCurrentPosition(function(position) {
                    let lat = position.coords.latitude;
                    let lng = position.coords.longitude;

                    // Send the location to the backend
                    fetch('/update-driver-location', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
                            },
                            body: JSON.stringify({
                                latitude: lat,
                                longitude: lng,
                                vehID: {{$vehId}} // Replace with dynamic ID retrieval
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Location updated:', data);
                        })
                        .catch(error => {
                            console.error('Error updating location:', error);
                        });
                    // fetch('/broadcast-driver-location', {
                    //     method: 'POST',
                    //     headers: {
                    //         'Content-Type': 'application/json',
                    //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                    //             .content,
                    //     },
                    //     body: JSON.stringify({
                    //         latitude: lat,
                    //         longitude: lng,
                    //         vehID: 25, // Replace with dynamic ride ID
                    //     }),
                    // });
                });
            }, 15000);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    function stopLocationUpdates() {
        if (locationInterval) {
            clearInterval(locationInterval);
            locationInterval = null;
        }
    }

    window.addEventListener('beforeunload', function() {
        // Send the driver offline when they close the page or browser
        fetch('/driver/toggle-status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content'),
                },
                body: JSON.stringify({
                    status: 0 // Ensure offline is represented as 0
                })
            })
            .catch(error => console.error('Error setting driver status to offline:', error));
    });

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = false;

    var pusher = new Pusher('62fa54aa1df62c15f35a', {
        cluster: 'eu'
    });

    const vehicleId = {{$vehId}};
    var channel = pusher.subscribe(`vehicle.${vehicleId}`);
    channel.bind('BookedRide', function(data) {
        // if (confirm('You have a ride request. Do you want to accept this ride?')) {
        //     acceptRide(data);
        // } else {
        //     rejectRide(data);
        // }
        var rideData = JSON.stringify(data);
        $("#userList").html(`

                    <div class="row p-2" style="border: 1px solid green; !important; background:#e8f5e9;" data-vehicle-id="${vehicleId}">
                        <div class="col-3" style="display: flex;justify-content: center;align-items: center;">
                            <img src="{{asset('img/user-icon.png')}}" class="img-fluid" alt="${data.user.name}">
                        </div>
                        <div class="col-6 text-center">
                            <strong class="fw-bold text-dark">${data.user.name}</strong><br>
                            <span><i class="fa fa-clock"></i> ${data.distance} min away</span> <span>$${data.price}</span><br>
                            <span><i class="fa fa-phone"></i> ${data.user.phone_no}</span>
                        </div>
                        <div class="col-3" style="display: flex;justify-content: center;align-items: center;">
                            <button class="btn btn-success btn-sm select-vehicle-btn" data-ride='${rideData.replace(/'/g, "&apos;")}'>Accept Ride</button>
                        </div>
                    </div>
        `);

        $(".select-vehicle-btn").on('click', function() {
            const ride = JSON.parse($(this).attr('data-ride'));
            stopLocationUpdates();
            acceptRide(ride);
        });
    });


    function acceptRide(data) {
        // Send an AJAX request to update the ride status
        fetch('/acceptRide', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    rideId: data.rideId,
                    is_request_accepted: 2,

                })
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    // alert('Ride accepted successfully!');
                    $("#userList").html('');
                    $("#userList").html(`

                        <div class="row p-2" style="border: 1px solid green; !important; background:#e8f5e9;" data-vehicle-id="${vehicleId}">
                            <div class="col-3" style="display: flex;justify-content: center;align-items: center;">
                                <img src="{{asset('img/user-icon.png')}}" class="img-fluid" alt="${data.user.name}">
                            </div>
                            <div class="col-6 text-center">
                                <strong class="fw-bold text-dark">${data.user.name}</strong><br>
                                <span><i class="fa fa-clock"></i> ${data.distance} min away</span> <span>$${data.price}</span><br>
                                <span><i class="fa fa-phone"></i> ${data.user.phone_no}</span>
                            </div>
                            <div class="col-3" style="display: flex;justify-content: center;align-items: center;">
                                <button class="btn btn-dark btn-sm">Ride Accepted</button>
                            </div>
                        </div>
                        `);
                    initMap(data.pickupLocation, data.dropoffLocation); // Call initMap with coordinates
                    // startLocationUpdates();

                } else {
                    alert('Failed to accept the ride.');
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function rejectRide(data) {
        // Send an AJAX request to update the ride status
        fetch('/rejectRide', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    rideId: data.rideId,
                    is_request_accepted: 3,

                })
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    // alert('Ride accepted successfully!');
                    // initMap(data.pickupLocation, data.dropoffLocation); // Call initMap with coordinates
                    // startLocationUpdates();
                    alert('Request rejected!');

                } else {
                    alert('Failed to accept the ride.');
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function initMap(pickupLocation, dropoffLocation) {
        const pickup = JSON.parse(pickupLocation);
        const dropoff = JSON.parse(dropoffLocation);

        navigator.geolocation.getCurrentPosition(function(position) {
            const map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                },
                zoom: 16
            });

            const directionsService = new google.maps.DirectionsService();
            const directionsRenderer = new google.maps.DirectionsRenderer({
                map: map,
                // suppressMarkers: true // We will add custom markers
                icon:{
                        url: 'img/car-icon.png', // Car icon
                        scaledSize: new google.maps.Size(40, 40)
                    }
            });

            // Define the route request
            const request = {
                origin: {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                },
                destination: dropoff,
                waypoints: [{
                    location: pickup,
                    stopover: true
                }],
                travelMode: 'DRIVING'
            };

            directionsService.route(request, function(result, status) {
                if (status === 'OK') {
                    directionsRenderer.setDirections(result);

                    // Add custom markers for pickup and dropoff locations
                    new google.maps.Marker({
                        position: pickup,
                        map: map,
                        label: 'P',
                        title: 'Pickup Location'
                    });

                    new google.maps.Marker({
                        position: dropoff,
                        map: map,
                        label: 'D',
                        title: 'Dropoff Location'
                    });
                } else {
                    alert('Failed to calculate route: ' + status);
                }
            });

            // Arrow marker for navigation
            const arrowMarker = new google.maps.Marker({
                position: {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                },
                map: map,
                icon: {
                    url: '{{asset('img/car-icon.png')}}',
                    scaledSize: new google.maps.Size(50, 50)
                }
                // icon: {
                //     path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
                //     scale: 5,
                //     fillColor: 'blue',
                //     fillOpacity: 1,
                //     strokeWeight: 2
                // }
            });

            // Update position dynamically
            function updateDriverPosition() {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const newPosition = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    // Move the arrow marker to the new location
                    arrowMarker.setPosition(newPosition);

                    // Optionally, re-center the map on the new location
                    map.setCenter(newPosition);

                    fetch('/update-driver-location', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .content,
                        },
                        body: JSON.stringify({
                            latitude: position.coords.latitude,
                            longitude: position.coords.longitude,
                            vehID: {{$vehId}}, // Replace with dynamic ride ID
                        }),
                    });
                });
            }

            // Update the driver's position every few seconds
            setInterval(updateDriverPosition, 13000); // Update every 5 seconds
        }, function(error) {
            alert('Error getting location: ' + error.message);
        });
    }

    function loadMap() {
        // Initialize the map with a default location (Nairobi)
        const defaultLocation = {
            lat: -1.2921,
            lng: 36.8219
        };
        const map = new google.maps.Map(document.getElementById('map'), {
            center: defaultLocation,
            zoom: 12,
        });

        // Initialize the user's location marker
        const markerLocation = new google.maps.Marker({
            map: map,
            title: "Your Location",
        });

        // Initialize the destination marker (optional for now)
        const markerDestination = new google.maps.Marker({
            map: map,
            title: "Destination",
        });

        // Initialize Directions Service and Renderer
        const directionsService = new google.maps.DirectionsService();
        const directionsRenderer = new google.maps.DirectionsRenderer();
        directionsRenderer.setMap(map);

        const geolocationOptions = {
            enableHighAccuracy: true,
            timeout: 10000, // Optional: maximum time to wait for location (in milliseconds)
            maximumAge: 0, // Optional: do not use a cached location
        };

        // Use the Geolocation API to get the user's current location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };
                    // Center the map on the user's location
                    map.setCenter(userLocation);
                    // Set the marker's position to the user's location
                    markerLocation.setPosition(userLocation);
                    // markerLocation.setIcon('http://maps.google.com/mapfiles/ms/icons/blue-dot.png'); // Optional: Customize marker icon
                },
                (error) => {
                    // Handle errors and fallback to the default location
                    console.error("Geolocation error:", error.message);
                    alert("Unable to fetch your location. Default location will be used.");
                    map.setCenter(defaultLocation);
                }
            );
        } else {
            // Geolocation not supported by the browser
            alert("Geolocation is not supported by your browser. Default location will be used.");
            map.setCenter(defaultLocation);
        }
    }

    // Call the loadMap function when the page loads
    loadMap();
</script>
