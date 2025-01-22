<div>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">Driver Location <button type="button"
                        class="btn btn-light btn-sm" onclick="getLocation()">Update Location</button></h4>
            </div>
        </div>
        <div class="col-md-5">
            <div id="driversList" style="margin-top:100px"></div>
            <div id="location-error" style="color: red; display: none;">
                Location is required to use this service. Please allow location access.
                <br>
                <a href="#" onclick="showInstructions()">How to enable location access</a>
            </div>

            <div id="location-instructions" style="display: none;">
                <p>To enable location access, please follow these steps:</p>
                <ul>
                    <li>Open your browser's settings.</li>
                    <li>Navigate to the privacy or site settings section.</li>
                    <li>Find this website in the list and allow location access.</li>
                </ul>
            </div>

            <form id="location-form" method="POST" action="">
                @csrf
                <input type="hidden" name="latitude" id="latitude" wire:model="latitude">
                <input type="hidden" name="longitude" id="longitude" wire:model="longitude">

            </form>
        </div>
        <div class="col-md-7">
            <div id="map" style="height: 100vh; width: 100%;"></div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let map;
    let driverMarker;
    let driverCircle;
    let currentPath = [];
    let directionsService;
    let directionsRenderer;

        function initMap(data, destinationCoords = null) {
        console.log(data);
        const mapOptions = {
            zoom: 20,
            center: {
                lat: data[0].lat,
                lng: data[0].lng
            },
        };

        // Create map only once if it doesn't exist
        if (!map) {
            map = new google.maps.Map(document.getElementById('map'), mapOptions);

            // Initialize DirectionsService and DirectionsRenderer
            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer({
                map: map,
                suppressMarkers: true,
                polylineOptions: {
                    strokeColor: '#4285F4',
                    strokeOpacity: 0.8,
                    strokeWeight: 5
                }
            });
        }

        const icon = [{
            icon: '{{ asset('img/car-icon.png') }}'
        }];

        // Create or update marker
        if (!driverMarker) {
            driverMarker = new google.maps.Marker({
                position: {
                    lat: data[0].lat,
                    lng: data[0].lng
                },
                map: map,
                icon: {
                    url: icon[0].icon,
                    scaledSize: new google.maps.Size(40, 40),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(20, 20)
                }
            });
        } else {
            // Just update marker position without moving the map
            driverMarker.setPosition(new google.maps.LatLng(data[0].lat, data[0].lng));
        }

        // Create or update circle
        if (!driverCircle) {
            driverCircle = new google.maps.Circle({
                map: map,
                radius: 10,
                center: {
                    lat: data[0].lat,
                    lng: data[0].lng
                },
                fillColor: '#70c2ff',
                fillOpacity: 0.35,
                strokeColor: '#70c2ff',
                strokeOpacity: 0.8,
                strokeWeight: 2,
            });
        } else {
            driverCircle.setCenter(new google.maps.LatLng(data[0].lat, data[0].lng));
        }

        // Update current path
        if (currentPath.length === 0) {
            currentPath.push(new google.maps.LatLng(data[0].lat, data[0].lng));
        } else {
            const lastPosition = currentPath[currentPath.length - 1];
            const newPosition = new google.maps.LatLng(data[0].lat, data[0].lng);

            // Only add new position if it's different from the last one
            if (lastPosition.lat() !== newPosition.lat() || lastPosition.lng() !== newPosition.lng()) {
                currentPath.push(newPosition);
            }
        }

        // Draw or update path
        if (window.driverPath) {
            window.driverPath.setMap(null);
        }

        window.driverPath = new google.maps.Polyline({
            path: currentPath,
            geodesic: true,
            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 2,
            map: map
        });

        // If destination coordinates are provided, draw route once
        if (destinationCoords && !window.routeDrawn) {
            const origin = new google.maps.LatLng(data[0].lat, data[0].lng);
            const destination = new google.maps.LatLng(destinationCoords.lat, destinationCoords.lng);

            // Create markers with Google Maps default styles
            new google.maps.Marker({
                position: origin,
                map: map,
                label: 'A',
                title: 'Origin'
            });

            new google.maps.Marker({
                position: destination,
                map: map,
                label: 'B',
                title: 'Destination'
            });

            // Calculate and display route
            directionsService.route(
                {
                    origin: origin,
                    destination: destination,
                    travelMode: google.maps.TravelMode.DRIVING
                },
                (response, status) => {
                    if (status === google.maps.DirectionsStatus.OK) {
                        directionsRenderer.setDirections(response);
                        window.routeDrawn = true;
                    } else {
                        console.error('Directions request failed:', status);
                    }
                }
            );
        }

        // Optional: Dynamically adjust circle radius based on zoom
        google.maps.event.addListener(map, 'zoom_changed', function() {
            const zoom = map.getZoom();
            driverCircle.setRadius(350 * Math.pow(2, 15 - zoom));
        });
    }


        function getLocation2(extraParam) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        showPosition2(position, extraParam);
                    },
                    showError, {
                        enableHighAccuracy: true,
                    }
                );
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError, {
                    enableHighAccuracy: true,
                    // timeout: 10000,
                    // maximumAge: 0
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            console.log('Latitude:', lat, 'Longitude:', lng);

            const locationData = [{
                lat: parseFloat(lat),
                lng: parseFloat(lng)
            }];

            initMap(locationData);
            updateDriverLocation(lat, lng);
        }

        function showError(error) {
            document.getElementById('location-error').style.display = 'block';
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

        function showInstructions() {
            document.getElementById('location-instructions').style.display = 'block';
        }

        // function updateDriverLocation(latitude, longitude) {
        //     var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        //     fetch('/update-driver-location', {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json',
        //                 'X-CSRF-TOKEN': csrfToken
        //             },
        //             body: JSON.stringify({
        //                 latitude: latitude,
        //                 longitude: longitude,
        //                 vehID: {{ $vehId }}
        //             })
        //         })
        //         .then(response => response.json())
        //         .then(data => {
        //             // alert(data.message);
        //         })
        //         .catch(error => {
        //             console.error('Error:', error);
        //         });
        // }
        function updateDriverLocation(lat, lng) {
        // Optional: You can add additional logic here if needed
        // This function now does nothing to prevent map movement
        console.log('Location updated:', lat, lng);
    }

        function myOrders() {
            $.ajax({
                url: '/myOrders', // Adjust this URL to your backend endpoint
                method: 'GET',
                success: function(response) {
                    $('#driversList').empty(); // Clear existing content
                    if (response.length !== 0) {
                        response.forEach(order => {
                            const originCoords = JSON.parse(order.originCoords);
                            const destinationCoords = JSON.parse(order.destinationCoords);
                            let btn1;
                            let btn2;
                            if (order.status == 0) {
                                btn1 =
                                    `<a onclick="acceptRequest(${order.id}, ${order.vehicle_id}, ${originCoords.lat}, ${originCoords.lng})" style="border-radius:5px; cursor:pointer; width:max-content; background: mediumseagreen; padding: 5px 5px;color: #fff !important; margin-top: 10px !important;">Accept</a>`;
                                btn2 =
                                    `<a onclick="rejectRequest(${order.id})" style="border-radius:5px; cursor:pointer; width:max-content; background: tomato; padding: 5px 5px;color: #fff !important; margin-top: 10px !important;">Reject</a>`;
                            } else if (order.status == 1) {
                                btn1 =
                                    `<a onclick="acceptRequest(${order.id}, ${order.vehicle_id}, ${originCoords.lat}, ${originCoords.lng})" style="border-radius:5px; cursor:pointer; width:max-content; background: dodgerblue; padding: 3px 3px;color: #fff !important; margin-top: 10px !important;">On Trip</a>`;
                                btn2 =
                                    `<a onclick="rejectRequest(${order.id})" style="border-radius:5px; cursor:pointer; width:max-content; background: tomato; padding: 5px 5px;color: #fff !important; margin-top: 10px !important;">Cancel</a>`;
                            }
                            $('#driversList').append(
                                `<div class="container p-1 mt-2" style="border: 2px solid #ccc; max-width: 450px; border-radius: 10px;">
                                    <div class="row flex-nowrap">
                                        <div class="col-3 d-flex align-items-center">
                                            <i class="fa fa-user" style="font-size:35px; padding: 15px;"></i>
                                        </div>
                                        <div class="col-4 d-flex flex-column justify-content-center">
                                            <h6 class="m-0 text-truncate">${order.name}</h6>
                                            <span>Amount: $${order.amount}</span>
                                        </div>
                                        <div class="col-2 get-items-centered">
                                            ${btn1}
                                        </div>
                                        <div class="col-2 get-items-centered">
                                            ${btn2}
                                        </div>
                                    </div>
                                </div>`
                            );
                        });
                    } else {
                        $('#driversList').append(
                            `<div class="alert alert-info text-center">No ride request at the moment</div>`);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching ride:', error);
                }
            });
        }
        myOrders();
        let ordersInterval = setInterval(() => {
            myOrders();
        }, 5000);


        function acceptRequest(id, vehicleId, lat, lng) {
            var lat1 = document.getElementById('latitude').value
            var lng1 = document.getElementById('longitude').value;
            $('#cancelRide').text('Accepting');
            var token = $("input[name=_token]").val();
            $.ajax({
                url: '/accept-ride',
                method: 'POST',
                data: {
                    id: id,
                    vehicleId: vehicleId,
                    _token: token
                },
                success: function(response) {
                    if (response.responseCode == 200) {
                        const currentLocation = {
                            lat: parseFloat(lat1),
                            lng: parseFloat(lng1)
                        };
                        const destinationLocation = {
                            lat: parseFloat(lat),
                            lng: parseFloat(lng)
                        };

                        // Initialize map with current location and destination
                        initMap([currentLocation], destinationLocation);

                        myOrders();
                        clearInterval(ordersInterval);

                        // Start periodic location updates
                        setInterval(() => {
                            getLocation2(destinationLocation);
                        }, 5000);
                    } else {
                        alert(response.responseMessage);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error accepting ride:', error);
                }
            });
        }

        function rejectRequest(id) {
            var token = $("input[name=_token]").val();
            $.ajax({
                url: '/reject-ride', // Adjust this URL to your backend endpoint
                method: 'POST',
                data: {
                    id: id,
                    _token: token
                },
                success: function(response) {
                    if (response.responseCode == 200) {
                        myOrders();
                        alert('You have rejected this ride');
                    } else {
                        alert('An error occurred rejecting ride');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error rejecting ride:', error);
                }
            });
        }

        function getLocation2(extraParam) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    showPosition2(position, extraParam);
                },
                showError, {
                    enableHighAccuracy: true,
                }
            );
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    function showPosition2(position, extraParam) {
        const lat = position.coords.latitude;
        const lng = position.coords.longitude;

        console.log('Latitude:', lat, 'Longitude:', lng, 'Extra Param:', extraParam);
        const locationData = [{
            lat: parseFloat(lat),
            lng: parseFloat(lng)
        }];

        // Pass destination coordinates to maintain route drawing
        initMap(locationData, extraParam);
    }

        window.addEventListener('load', getLocation);
        // Adjust interval as needed
    </script>

</div>
