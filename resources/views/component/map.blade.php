<div id='map' class='rounded'></div>
<script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>
<script>
    let map, markers = [];
    /* ----------------------------- Initialize Map ----------------------------- */
    function initMap() {
        map = L.map('map', {
            center: {
                lat: -7.7925927,
                lng: 110.3658812,
            },
            zoom: 13
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Â© OpenStreetMap'
        }).addTo(map);

        map.on('click', mapClicked);
        initMarkers();
    }
    initMap();

    /* --------------------------- Initialize Markers --------------------------- */
    function initMarkers() {
        const initialMarkers = <?php echo json_encode($initialMarkers); ?>;

        for (let index = 0; index < initialMarkers.length; index++) {

            const data = initialMarkers[index];
            const marker = generateMarker(data, index);
            marker.addTo(map).bindPopup(`<b>${data.position.lat},  ${data.position.lng}</b>`);
            map.panTo(data.position);
            markers.push(marker)
        }
    }

    function generateMarker(data, index) {
        return L.marker(data.position, {
                draggable: data.draggable
            })
            .on('click', (event) => markerClicked(event, index))
            .on('dragend', (event) => markerDragEnd(event, index));
    }

    /* ------------------------- Handle Map Click Event ------------------------- */
    function mapClicked($event) {
        console.log(map);
        console.log($event.latlng.lat, $event.latlng.lng);
    }

    /* ------------------------ Handle Marker Click Event ----------------------- */
    function markerClicked($event, index) {
        console.log(map);
        console.log($event.latlng.lat, $event.latlng.lng);
    }

    /* ----------------------- Handle Marker DragEnd Event ---------------------- */
    function markerDragEnd($event, index) {
        console.log(map);
        console.log($event.target.getLatLng());
    }
</script>