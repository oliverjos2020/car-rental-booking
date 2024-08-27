<div>
    
    <div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Driver Location <button type="button" class="btn btn-light btn-sm" onclick="getLocation()">Update Location</button></h4>
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
    function initMap(lat, lng) {
        const mapOptions = {
            zoom: 15,
            center: { lat: lat, lng: lng },
        };

        const map = new google.maps.Map(document.getElementById('map'), mapOptions);

        new google.maps.Marker({
            position: { lat: lat, lng: lng },
            map: map,
        });

        const circle = new google.maps.Circle({
            map: map,
            radius: 500, // 500 meters radius
            center: { lat: lat, lng: lng },
            fillColor: '#70c2ff',
            fillOpacity: 0.35,
            strokeColor: '#70c2ff',
            strokeOpacity: 0.8,
            strokeWeight: 2,
        });

        google.maps.event.addListener(map, 'zoom_changed', function () {
            const zoom = map.getZoom();
            circle.setRadius(500 * Math.pow(2, 15 - zoom));
        });
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

        initMap(lat, lng);
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

    function updateDriverLocation(latitude, longitude) {
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/update-driver-location', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                latitude: latitude,
                longitude: longitude,
                vehID: {{$vehId}}
            })
        })
        .then(response => response.json())
        .then(data => {
            // alert(data.message);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function myOrders()
    {
        $.ajax({
                url: '/myOrders', // Adjust this URL to your backend endpoint
                method: 'GET',
                success: function(response) {
                    $('#driversList').empty(); // Clear existing content

                response.forEach(order => {
                    $('#driversList').append(
                        `<div class="container p-1 mt-2" style="border: 2px solid #ccc; max-width: 450px; border-radius: 10px;">
                            <div class="row flex-nowrap">
                                <div class="col-3 d-flex align-items-center">
                                    <i class="fa fa-user" style="font-size:35px; padding: 15px;"></i>
                                </div>
                                <div class="col-6 d-flex flex-column justify-content-center">
                                    <h6 class="m-0 text-truncate">${order.name}</h6>
                                    <span>Amount: $${order.amount}</span>
                                </div>
                                <div class="col-3 get-items-centered">
                                    <a style="border-radius:5px; cursor:pointer; width:max-content; background: mediumseagreen; padding: 5px 5px;color: #fff !important; margin-top: 10px !important;">Accept</a>
                                </div>
                            </div>
                        </div>`
                    );
                });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching ride:', error);
                }
            });
    }
    
    window.addEventListener('load', getLocation);
    myOrders();
    setTimeout(() => {
        myOrders();
    }, 10000); // Adjust interval as needed
</script>

</div>