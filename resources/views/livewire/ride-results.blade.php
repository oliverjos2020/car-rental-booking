<div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let map;
        let directionsService;
        let directionsRenderer;
        let driverMarkers = [];
        let OCoords;
        let DCoords;
        let charge;

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 10,
                center: {
                    lat: 0,
                    lng: 0
                },
            });

            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map);

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };
                        map.setCenter(pos);

                        new google.maps.Marker({
                            position: pos,
                            map: map,
                            title: "You are here",
                        });
                    },
                    () => {
                        handleLocationError(true, map.getCenter());
                    }
                );
            } else {
                handleLocationError(false, map.getCenter());
            }
        }

        function handleLocationError(browserHasGeolocation, pos) {
            const infoWindow = new google.maps.InfoWindow({
                position: pos,
                content: browserHasGeolocation ?
                    "Error: The Geolocation service failed." :
                    "Error: Your browser doesn't support geolocation.",
            });
            infoWindow.open(map);
        }

        function calculateRoute() {
            const origin = document.getElementById("location").value;
            const destination = document.getElementById("destination").value;

            if (!origin || !destination) {
                alert("Please enter both location and destination.");
                return;
            }
            $('#driversList').empty();

            // Use Geocoding API to get coordinates for origin and destination
            fetchCoordinates(origin, (originCoords) => {
                fetchCoordinates(destination, (destinationCoords) => {
                    directionsService.route({
                            origin: originCoords,
                            destination: destinationCoords,
                            travelMode: google.maps.TravelMode.DRIVING,
                        },
                        (response, status) => {
                            if (status === "OK") {
                                directionsRenderer.setDirections(response);

                                // Fit map to bounds
                                const bounds = new google.maps.LatLngBounds();
                                const route = response.routes[0];
                                route.legs.forEach(leg => {
                                    bounds.extend(leg.start_location);
                                    bounds.extend(leg.end_location);
                                });
                                map.fitBounds(bounds);

                                // Calculate the total distance
                                const totalDistance = route.legs.reduce((sum, leg) => sum + leg.distance
                                    .value, 0) / 1000; // in km
                                const price = totalDistance * 1; // $1 per km
                                charge = price;
                                // Display price
                                // document.getElementById("price").innerText = Total Price: $${price.toFixed(2)};
                                // document.getElementById("distance").innerText = Total distance: ${totalDistance} km;
                                $('#distance').html(
                                    `<div class="container p-1 mt-2" style="border: 2px solid #ccc; max-width: 450px; border-radius: 10px;">
                                        <div class="row p-2 flex-nowrap">
                                            <div class="col-6 d-flex align-items-center">
                                                <strong>Travel Distance: ${totalDistance} km</strong>
                                            </div>
                                            <div class="col-6 d-flex flex-column justify-content-center">
                                                <h6 class="m-0 text-truncate">Price: $${price.toFixed(2)}</h6>
                                            </div>

                                        </div>
                                    </div>`
                                );
                                OCoords = originCoords;
                                DCoords = destinationCoords;


                                // Fetch nearby drivers
                                fetchDrivers(originCoords, destinationCoords, (drivers) => {
                                    calculateDriverTimes(originCoords, drivers, (
                                        driversWithTime) => {
                                        displayDrivers(driversWithTime);
                                    });
                                });
                            } else {
                                window.alert("Directions request failed due to " + status);
                            }
                        }
                    );
                });
            });
        }

        function fetchCoordinates(address, callback) {
            const geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                address: address
            }, (results, status) => {
                if (status === 'OK') {
                    const location = results[0].geometry.location;
                    // console.log('lat:'+ location.lat(), 'lng:'+ location.lng());
                    callback({
                        lat: location.lat(),
                        lng: location.lng(),
                    });
                } else {
                    console.error('Geocode was not successful for the following reason: ' + status);
                }
            });
        }

        function fetchDrivers(originCoords, destinationCoords, callback) {
            $.ajax({
                url: '/get-nearby-drivers', // Adjust this URL to your backend endpoint
                method: 'GET',
                data: {
                    origin_lat: originCoords.lat,
                    origin_lng: originCoords.lng,
                    destination_lat: destinationCoords.lat,
                    destination_lng: destinationCoords.lng
                },
                success: function(response) {
                    const drivers = response.drivers;
                    if (drivers.length === 0) {
                        alert("No driver available for your location");
                        callback(null); // or you can pass a specific value or message to the callback
                    } else {
                        callback(drivers);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching drivers:', error);
                }
            });
        }

        function calculateDriverTimes(originCoords, drivers, callback) {
            const service = new google.maps.DistanceMatrixService();
            const destinations = drivers.map(driver => ({
                lat: parseFloat(driver.latitude),
                lng: parseFloat(driver.longitude)
            }));

            service.getDistanceMatrix({
                origins: [originCoords],
                destinations: destinations,
                travelMode: google.maps.TravelMode.DRIVING,
            }, (response, status) => {
                if (status === 'OK') {
                    response.rows[0].elements.forEach((element, index) => {
                        drivers[index].duration = element.duration.text;
                    });
                    callback(drivers);
                } else {
                    console.error('Distance Matrix request failed due to ' + status);
                }
            });
        }

        function displayDrivers(drivers) {
            // Clear previous markers
            driverMarkers.forEach(marker => marker.setMap(null));
            driverMarkers = [];
            let orders = [];
            $('#driversList').empty();

            // Fetch orders once and then process drivers
            $.ajax({
                url: '/fetch-ride', // Adjust this URL to your backend endpoint
                method: 'GET',
                success: function(response) {
                    console.log('Raw response from server:', response);

                    // Ensure the response is parsed correctly
                    let orders = Array.isArray(response) ? response : JSON.parse(response);
                    const ordersNumbers = orders.map(id => Number(id));

                    drivers.forEach(driver => {
                        const position = {
                            lat: parseFloat(driver.latitude),
                            lng: parseFloat(driver.longitude)
                        };
                        const carIconUrl = '{{ asset('img/car-icon.png') }}';
                        const marker = new google.maps.Marker({
                            position: position,
                            map: map,
                            title: `${driver.name} - ${driver.distance ? driver.distance.toFixed(2) : 'N/A'} km, ${driver.duration ? driver.duration : 'N/A'} away`,
                            icon: {
                                url: carIconUrl,
                                scaledSize: new google.maps.Size(40, 40),
                                origin: new google.maps.Point(0, 0),
                                anchor: new google.maps.Point(20, 20)
                            }
                        });

                        driverMarkers.push(marker);
                        const circle = new google.maps.Circle({
                            map: map,
                            radius: 500,
                            center: position,
                            fillColor: '#70c2ff',
                            fillOpacity: 0.2,
                            strokeColor: '#70c2ff',
                            strokeOpacity: 0.8,
                            strokeWeight: 2,
                        });
                        google.maps.event.addListener(map, 'zoom_changed', function() {
                            const zoom = map.getZoom();
                            circle.setRadius(500 * Math.pow(2, 15 - zoom));
                        });

                        const distance = parseFloat(driver.distance);
                        const charge = distance * 1;

                        // Check if the driver's ID is in the orders array
                        let btn;
                        if (ordersNumbers.includes(driver.id)) {
                            btn =
                                `<a onclick="cancelRide(${driver.id})" id="cancelRide" style="border-radius:5px; cursor:pointer; width:max-content; background: tomato; padding: 5px 5px;color: #fff !important; margin-top: 10px !important;">Cancel</a>`;
                            console.log(`Driver ID ${driver.id} is present in the orders.`);
                        } else {
                            btn =
                                `<a onclick="orderRide(${driver.id})" id="orderRide" style="border-radius:5px; cursor:pointer; width:max-content; background: #333; padding: 5px 5px;color: #fff !important; margin-top: 10px !important;">Order</a>`;
                            console.log(`Driver ID ${driver.id} is not present in the orders.`);
                        }

                        // Display driver info on the page
                        $('#driversList').append(
                            `<div class="container p-1 mt-2" style="border: 2px solid #ccc; max-width: 450px; border-radius: 10px;">
                                    <div class="row flex-nowrap">
                                        <div class="col-4 d-flex align-items-center">
                                            <img src="{{ asset('img/service1.png') }}" alt="home-image" class="img-fluid" style="max-height:100px;">
                                        </div>
                                        <div class="col-4 d-flex flex-column justify-content-center">
                                            <h6 class="m-0 text-truncate">${driver.name}</h6>
                                            <span>${driver.distance ? driver.distance.toFixed(2) : 'N/A'} km away, ${driver.duration ? driver.duration : 'N/A'} away</span>
                                        </div>
                                        <div class="col-4 get-items-centered">
                                            ${btn}
                                        </div>
                                    </div>
                                </div>`
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching orders:', error);
                }
            });
            // Update driver locations periodically
            // setTimeout(() => {
            //     fetchDriversAgain();
            // }, 10000); // Adjust interval as needed
        }

        function fetchDriversAgain() {
            const origin = document.getElementById("location").value;
            const destination = document.getElementById("destination").value;

            if (!origin || !destination) {
                return;
            }

            fetchCoordinates(origin, (originCoords) => {
                fetchCoordinates(destination, (destinationCoords) => {
                    fetchDrivers(originCoords, destinationCoords, (drivers) => {
                        calculateDriverTimes(originCoords, drivers, (driversWithTime) => {
                            displayDrivers(driversWithTime);
                        });
                    });
                });
            });
        }

        function loadGoogleMaps() {
            const script = document.createElement("script");
            script.src =
                `https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&callback=initMap&libraries=places`;
            script.defer = true;
            script.async = true;
            document.head.appendChild(script);
        }

        window.onload = loadGoogleMaps;

        $(document).ready(function() {
            $("#bookRide").click(function() {
                calculateRoute();
            });
        });
        let ordersInterval;

        function stopMyFunction() {
            if (ordersInterval) {
                clearInterval(ordersInterval);
                console.log("Interval cleared!");
            }
        }

        function orderRide(id) {
            $('#orderRide').text('Ordering');
            var _token = $("input[name=_token]").val();
            $.ajax({
                url: '/order-ride',
                method: 'POST',
                data: {
                    vehicle_id: id,
                    user_id: {{ Auth()->user()->id }},
                    originCoords: OCoords,
                    destinationCoords: DCoords,
                    charge,
                    _token: _token
                },
                success: function(response) {
                    alert(response.message);
                    if (response.responseCode == 200) {
                        fetchDriversAgain();
                        // Clear any previous interval before setting a new one
                        stopMyFunction();
                        ordersInterval = setInterval(() => {
                            acceptRequest(response.data.id);
                        }, 5000);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching drivers:', error);
                }
            });
        }

        function cancelRide(id) {
            $('#cancelRide').text('Cancelling');
            var token = $("input[name=_token]").val();
            $.ajax({
                url: '/cancel-ride',
                method: 'POST',
                data: {
                    vehicle_id: id,
                    user_id: {{ Auth()->user()->id }},
                    _token: token
                },
                success: function(response) {
                    alert(response.message);
                    fetchDriversAgain();
                    // Clear the interval when the ride is canceled
                    stopMyFunction();
                },
                error: function(xhr, status, error) {
                    console.error('Error canceling ride:', error);
                }
            });
        }

        function acceptRequest(id) {
            var _token = $("input[name=_token]").val();
            $.ajax({
                url: '/acceptRequest',
                method: 'POST',
                data: {
                    id,
                    _token
                },
                success: function(response) {
                    if (response.data.is_request_accepted == 1) {
                        alert('Driver has accepted your request');
                        updateMap(response.data);
                        stopMyFunction(); // Stop the interval after acceptance
                    } else if (response.data.is_request_accepted == 2) {
                        alert('Driver has rejected your request');
                        stopMyFunction(); // Stop the interval after rejection
                    }
                }
            });
        }

        function updateMap(data) {
            // Initialize DirectionsService and DirectionsRenderer
            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer();
            // directionsRenderer.setMap(map);

            // Set the destination coordinates
            // destination = { lat: 9.0742854, lng: 7.4949809 };
            destination = JSON.parse(data.destinationCoords); // Replace with your destination

            // Start watching the position
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(showPosition, showError, {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            const origin = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            console.log('Current Position:', origin);

            // Recalculate and display the route with updated origin
            calculateAndDisplayRoute(directionsService, directionsRenderer, origin, destination);
        }

        function calculateAndDisplayRoute(directionsService, directionsRenderer, origin, destination) {
            directionsService.route({
                    origin: origin,
                    destination: destination,
                    travelMode: google.maps.TravelMode.DRIVING,
                },
                (response, status) => {
                    if (status === 'OK') {
                        directionsRenderer.setDirections(response);
                    } else {
                        console.error('Directions request failed due to ' + status);
                    }
                }
            );
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("User denied the request for Geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred.");
                    break;
            }
        }
    </script>

    <div class="grid grid-cols-2 p-2">
        <div class="row" style="margin-top:140px">
            <div class="col-md-5 p-3">
                <div class="container p-4"
                    style="max-width:450px; margin:0 auto; margin-top:0px; border: 1px solid #ccc; border-radius: 5px;">
                    <h5 class="text-light">Order a ride</h5>
                    <div>
                        @csrf
                        <div class="input-group mb-3">
                            <span class="input-group-text input-group-text-right">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                            </span>
                            <br>
                            <input type="text" id="location" wire:model.debounce.500ms="location"
                                class="form-control my-form-control" placeholder="Enter Location">
                            @if (count($suggestionsLocation) > 0)
                                <ul class="list-group position-absolute w-100" style="z-index: 1000; margin-top:45px;">
                                    @foreach ($suggestionsLocation as $suggestion)
                                        <li class="list-group-item list-group-item-action"
                                            wire:click="selectSuggestion('location', '{{ $suggestion['place_id'] }}', '{{ $suggestion['description'] }}')">
                                            {{ $suggestion['description'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text input-group-text-right">
                                <i class="fa fa-map" aria-hidden="true"></i>
                            </span>
                            <br>
                            <input type="text" id="destination" wire:model.debounce.500ms="destination"
                                class="form-control my-form-control" placeholder="Enter Destination">
                            @if (count($suggestionsDestination) > 0)
                                <ul class="list-group position-absolute w-100" style="z-index: 1000; margin-top:45px;">
                                    @foreach ($suggestionsDestination as $suggestion)
                                        <li class="list-group-item list-group-item-action"
                                            wire:click="selectSuggestion('destination', '{{ $suggestion['place_id'] }}', '{{ $suggestion['description'] }}')">
                                            {{ $suggestion['description'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                    @if (Auth::check())
                        <a id="bookRide" class="my-btn-dark" style="border-radius:5px; cursor:pointer;">Book Ride</a>
                    @else
                        <a href="/login" class="my-btn-dark" style="border-radius:5px; cursor:pointer;">Book Ride</a>
                    @endif
                </div>
                <div id="distance"></div>
                <div id="driversList"></div>
            </div>
            <div class="col-md-7 p-3" id="map" style="height: 100vh;" wire:ignore></div>
        </div>
    </div>

    {{-- <script>
        let map;
        let geocodeCache = {};

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 10,
                center: { lat: 0, lng: 0 },
            });

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };
                        map.setCenter(pos);

                        new google.maps.Marker({
                            position: pos,
                            map: map,
                            title: "You are here",
                        });
                    },
                    () => {
                        handleLocationError(true, map.getCenter());
                    }
                );
            } else {
                handleLocationError(false, map.getCenter());
            }

            window.addEventListener('locationSelected', event => {
                const placeId = event.detail;
                const geocoder = new google.maps.Geocoder();

                geocoder.geocode({ placeId: placeId }, (results, status) => {
                    if (status === 'OK' && results[0]) {
                        const location = results[0].geometry.location;
                        map.setCenter(location);
                        map.setZoom(15);

                        new google.maps.Marker({
                            position: location,
                            map: map,
                            title: "Selected Location",
                        });
                    } else {
                        console.error('Geocode was not successful for the following reason: ' + status);
                    }
                });
            });
        }

        function handleLocationError(browserHasGeolocation, pos) {
            const infoWindow = new google.maps.InfoWindow({
                position: pos,
                content: browserHasGeolocation
                    ? "Error: The Geolocation service failed."
                    : "Error: Your browser doesn't support geolocation.",
            });
            infoWindow.open(map);
        }

        function loadGoogleMaps() {
            const script = document.createElement("script");
            script.src = `https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&callback=initMap&libraries=places`;
            script.async = true;
            script.defer = true;
            document.head.appendChild(script);
        }
        function calculateRoute() {
            const origin = document.getElementById("location").value;
            const destination = document.getElementById("destination").value;

            if (!origin || !destination) {
                alert("Please enter both location and destination.");
                return;
            }

            fetchCoordinates(origin)
                .then(originCoords => {
                    return fetchCoordinates(destination).then(destinationCoords => ({
                        originCoords,
                        destinationCoords
                    }));
                })
                .then(({ originCoords, destinationCoords }) => {
                    OCoords = originCoords;
                    DCoords = destinationCoords;

                    return requestDirections(originCoords, destinationCoords)
                        .then(response => {
                            renderDirections(response);
                            const totalDistance = calculateTotalDistance(response);
                            displayTravelInfo(totalDistance);

                            return fetchDrivers(originCoords, destinationCoords); // Return the promise
                        })
                        .then(drivers => {
                            if (drivers.length > 0) {
                                return calculateDriverTimes(OCoords, drivers);
                            } else {
                                throw new Error("No drivers available for calculation.");
                            }
                        })
                        .then(driversWithTime => {
                            displayDrivers(driversWithTime);
                        })
                        .catch(error => {
                            handleAjaxError(error, "Error processing drivers");
                        });
                })
                .catch(error => handleAjaxError(error, "Error fetching coordinates"));
        }
        function fetchCoordinates(address) {
            if (geocodeCache[address]) {
                console.log(`Cache hit for address: ${address}`);
                return Promise.resolve(geocodeCache[address]);
            }

            const geocoder = new google.maps.Geocoder();
            return new Promise((resolve, reject) => {
                geocoder.geocode({ address: address }, (results, status) => {
                    if (status === 'OK') {
                        const location = results[0].geometry.location;
                        geocodeCache[address] = { lat: location.lat(), lng: location.lng() };
                        resolve(geocodeCache[address]);
                    } else {
                        reject('Geocode was not successful for the following reason: ' + status);
                    }
                });
            });
        }


        $("#bookRide").click(function() {
            calculateRoute();
        });

        window.onload = loadGoogleMaps;
    </script> --}}
</div>
