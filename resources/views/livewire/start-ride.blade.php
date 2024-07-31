<div>
    <div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Driver Location</h4>
        </div>
    </div>
    <div class="col-md-4">
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
            <input type="text" name="latitude" id="latitude" wire:model="latitude">
            <input type="text" name="longitude" id="longitude" wire:model="longitude">
            <button type="button" onclick="getLocation()">Update Location</button>
        </form>
    </div>
    <div class="col-md-8">
        <div id="map" style="height: 100vh; width: 100%;"></div>
    </div>
</div>

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
                longitude: longitude
            })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
    window.addEventListener('load', getLocation);
</script>

</div>