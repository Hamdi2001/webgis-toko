<script>
	var southWest = L.latLng (2.661003, 116.697984);
	var northEast = L.latLng (0.887633, 118.950181);
	var bounds = L.latLngBounds(southWest, northEast);

    const map = L.map('map').setView([1.753254, 117.629075], 9).setMaxBounds(bounds);

	const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 19,
		maxBounds: bounds,
        minZoom: 8, // Set this to your desired minimum zoom level
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map);
</script>