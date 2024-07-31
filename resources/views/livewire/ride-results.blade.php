<div class="grid grid-cols-2">
    <div class="row">
        <div class="col-md-3">
            <p>Distance: {{ $distanceText }}</p>
            <p>Estimated Charge: ${{ $distance * 1000 }}</p>
            <p>duration :{{ $durationText }}</p>
            @forelse($nearestDrivers as $drivers)
                <p>{{$drivers->name}}</p>
                @empty
            @endforelse
        </div>
        <div class="col-md-9" id="map" style="height: 100vh;"></div>
    </div>
</div>

<script>
    function initMap() {
        const origin = "{{ $location }}";
        const destination = "{{ $destination }}";
        const durationText = "{{ $durationText }}"; // Extract duration text

        const directionsService = new google.maps.DirectionsService();
        const directionsRenderer = new google.maps.DirectionsRenderer();

        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 10, // Adjust zoom level as needed
            center: { lat: 0, lng: 0 }, // Default center
        });
        directionsRenderer.setMap(map);

        directionsService.route(
            {
                origin: origin,
                destination: destination,
                travelMode: google.maps.TravelMode.DRIVING,
            },
            (response, status) => {
                if (status === "OK") {
                    directionsRenderer.setDirections(response);
                } else {
                    window.alert("Directions request failed due to " + status);
                }
            }
        );

        const currentLocation = { lat: parseFloat("{{ explode(',', $location)[0] }}"), lng: parseFloat("{{ explode(',', $location)[1] }}") };
        const destinationLocation = { lat: parseFloat("{{ explode(',', $destination)[0] }}"), lng: parseFloat("{{ explode(',', $destination)[1] }}") };

        const markerOptions = {
            icon: {
                url: '{{asset('img/Map-Marker.png')}}', // Replace with your icon URL
                scaledSize: new google.maps.Size(40, 40),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(20, 20)
            }
        };

        // Add marker for current location
        new google.maps.Marker({
            position: currentLocation,
            map: map,
            title: 'Current Location',
            icon: markerOptions
        });

        // Add marker for destination
        const destinationMarker = new google.maps.Marker({
            position: destinationLocation,
            map: map,
            title: 'Destination',
            icon: markerOptions,
            label: {
                text: durationText, // Set the label text
                color: 'black',
                fontSize: '16px', // Increase size if necessary
                fontWeight: 'bold' // Make it bold for better visibility
            }
        });

        // Create and add an info window for estimated time
        const infoWindow = new google.maps.InfoWindow({
            content: `<div><strong>Estimated Arrival Time:</strong> ${durationText}</div>`
        });

        destinationMarker.addListener('click', function() {
            infoWindow.open(map, destinationMarker);
        });

        // Add markers and circles for nearest drivers
        const drivers = @json($nearestDrivers);
        console.log('Drivers:', drivers); // Log drivers array for debugging

        if (drivers.length === 0) {
            console.log('No drivers found.');
            alert('No drivers found nearby.');
            return;
        }

        const carIconUrl = '{{asset('img/car-icon.png')}}'; // Replace with your car icon URL

        drivers.forEach(driver => {
            const position = { lat: parseFloat(driver.latitude), lng: parseFloat(driver.longitude) };
            console.log('Adding marker for driver:', driver.name, 'at', position); // Log each driver's position

            // Create marker for driver
            new google.maps.Marker({
                position: position,
                map: map,
                title: driver.name,
                icon: {
                    url: carIconUrl, // URL of the custom car icon
                    scaledSize: new google.maps.Size(40, 40),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(20, 20)
                }
            });

            // Create circle around driver
            new google.maps.Circle({
                map: map,
                radius: 200, // Radius in meters (adjust as needed)
                center: position,
                fillColor: 'red',
                fillOpacity: 0.2,
                strokeColor: 'red',
                strokeOpacity: 0.8,
                strokeWeight: 2,
            });
        });

        // Fit map to bounds
        const bounds = new google.maps.LatLngBounds();
        bounds.extend(currentLocation);
        bounds.extend(destinationLocation);
        drivers.forEach(driver => {
            bounds.extend({ lat: parseFloat(driver.latitude), lng: parseFloat(driver.longitude) });
        });
        map.fitBounds(bounds);
    }

    window.initMap = initMap;
</script>


<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&callback=initMap"></script>
