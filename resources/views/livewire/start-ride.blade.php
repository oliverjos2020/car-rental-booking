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
    function initMap(data) {

        console.log(data);
        const mapOptions = {
            zoom: 13,
            center: { lat: data[0].lat, lng: data[0].lng },
        };

        const map = new google.maps.Map(document.getElementById('map'), mapOptions);
        const icon = [
            {
                icon: '{{asset("img/car-icon.png")}}'
            },
            {
                icon: '{{asset("img/Map-Marker.png")}}'
            }
        ];
        // data.forEach(locate => {

        for (let i = 0; i < data.length; i++) {
            new google.maps.Marker({
                position: { lat: data[i].lat, lng: data[i].lng },
                map: map,
                icon: {
                          url: icon[i].icon,
                          scaledSize: new google.maps.Size(40, 40),
                          origin: new google.maps.Point(0, 0),
                          anchor: new google.maps.Point(20, 20)
                      }
            });

            const circle = new google.maps.Circle({
                map: map,
                radius: 450, // 500 meters radius
                center: { lat: data[i].lat, lng: data[i].lng },
                fillColor: '#70c2ff',
                fillOpacity: 0.35,
                strokeColor: '#70c2ff',
                strokeOpacity: 0.8,
                strokeWeight: 2,
            });

            google.maps.event.addListener(map, 'zoom_changed', function () {
                const zoom = map.getZoom();
                circle.setRadius(350 * Math.pow(2, 15 - zoom));
            });
        }
        // });
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

        const locationData = [{lat:parseFloat(lat), lng:parseFloat(lng)}];

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
                    if(response.length !== 0){
                        response.forEach(order => {
                            const originCoords = JSON.parse(order.originCoords);
                            const destinationCoords = JSON.parse(order.destinationCoords);
                            let btn1;
                            let btn2;
                            if(order.status == 0){
                                btn1 = `<a onclick="acceptRequest(${order.id}, ${order.vehicle_id}, ${originCoords.lat}, ${originCoords.lng})" style="border-radius:5px; cursor:pointer; width:max-content; background: mediumseagreen; padding: 5px 5px;color: #fff !important; margin-top: 10px !important;">Accept</a>`;
                                btn2 = `<a onclick="rejectRequest(${order.id})" style="border-radius:5px; cursor:pointer; width:max-content; background: tomato; padding: 5px 5px;color: #fff !important; margin-top: 10px !important;">Reject</a>`;
                            }else if(order.status == 1){
                                btn1 = `<a onclick="acceptRequest(${order.id}, ${order.vehicle_id}, ${originCoords.lat}, ${originCoords.lng})" style="border-radius:5px; cursor:pointer; width:max-content; background: dodgerblue; padding: 3px 3px;color: #fff !important; margin-top: 10px !important;">On Trip</a>`;
                                btn2 = `<a onclick="rejectRequest(${order.id})" style="border-radius:5px; cursor:pointer; width:max-content; background: tomato; padding: 5px 5px;color: #fff !important; margin-top: 10px !important;">Cancel</a>`;
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
                    }else{
                        $('#driversList').append(`<div class="alert alert-info text-center">No ride request at the moment</div>`);
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


    function acceptRequest(id, vehicleId, lat, lng)
    {
        var lat1 = document.getElementById('latitude').value
        var lng1 = document.getElementById('longitude').value;
        $('#cancelRide').text('Accepting');
            var token = $("input[name=_token]").val();
            $.ajax({
                url: '/accept-ride', // Adjust this URL to your backend endpoint
                method: 'POST',
                data: {
                    id: id,
                    vehicleId:vehicleId,
                    _token: token
                },
                success: function(response) {
                    if(response.responseCode == 200) {
                        const Data = [
                        {
                            lat: parseFloat(lat1),
                            lng: parseFloat(lng1)
                        },{

                             lat: parseFloat(lat),
                             lng: parseFloat(lng)
                        }
                    ];
                    initMap(Data);
                    myOrders();
                    clearInterval(ordersInterval);
                    const Data2 = { lat: lat, lng: lng}
                    setInterval(() => {
                        getLocation2(Data2);
                    }, 5000);
                    // alert('You have accepted this ride');
                    }else{
                        alert('An error occurred accepting ride');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error accepting ride:', error);
                }
            });
    }
    function rejectRequest(id)
    {
        var token = $("input[name=_token]").val();
        $.ajax({
            url: '/reject-ride', // Adjust this URL to your backend endpoint
            method: 'POST',
            data: {
                id: id,
                _token: token
            },
            success: function(response) {
                if(response.responseCode == 200) {
                    myOrders();
                    alert('You have rejected this ride');
                }else{
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
                showError,
                {
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
        const locationData = [{lat:parseFloat(lat), lng:parseFloat(lng)}, extraParam];

        initMap(locationData);
        updateDriverLocation(lat, lng);
    }

    window.addEventListener('load', getLocation);
   // Adjust interval as needed
</script>

</div>
