<?php
// index.php
session_start();
require 'db.php';

// Fetch latest tagged location from the database
$loc_query = $conn->query("SELECT * FROM locations ORDER BY id DESC LIMIT 1");
$location = $loc_query->fetch_assoc();

// Default fallback if no location yet
if (!$location) {
    $location = [
        'latitude' => 0,
        'longitude' => 0,
        'radius' => 100
    ];
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>DTR Map View</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Leaflet CSS & JS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

  <style>
    body {
      margin: 0;
      font-family: sans-serif;
    }
    #map {
      height: 100vh;
      width: 100%;
    }
  </style>
</head>
<body>

<div id="map"></div>

<script>
// Admin-defined coordinates
const centerLat = <?= $location['latitude'] ?>;
const centerLng = <?= $location['longitude'] ?>;
const radius = <?= $location['radius'] ?>;

// Initialize map
const map = L.map('map').setView([centerLat, centerLng], 16);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

// Draw circle and marker for admin tagged location
L.circle([centerLat, centerLng], {
  color: 'blue',
  fillColor: '#aad3df',
  fillOpacity: 0.5,
  radius: radius
}).addTo(map).bindPopup("Tagged Location by Admin");

L.marker([centerLat, centerLng]).addTo(map)
  .bindPopup("Center Point")
  .openPopup();

// Show current user location
if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(pos => {
    const userLat = pos.coords.latitude;
    const userLng = pos.coords.longitude;

    L.marker([userLat, userLng]).addTo(map)
      .bindPopup("Your Current Location")
      .openPopup();

    const distance = getDistance(userLat, userLng, centerLat, centerLng);
    console.log("Distance from center: " + distance + " meters");

    if (distance <= radius) {
      alert("✅ You are inside the allowed area.");
    } else {
      alert("🚫 You are outside the allowed area.");
    }
  });
} else {
  alert("Geolocation is not supported by your browser.");
}

// Distance calculation (Haversine)
function getDistance(lat1, lon1, lat2, lon2) {
  const R = 6371000;
  const dLat = toRad(lat2 - lat1);
  const dLon = toRad(lon2 - lon1);
  const a = Math.sin(dLat/2)**2 +
            Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
            Math.sin(dLon/2)**2;
  const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
  return R * c;
}

function toRad(x) {
  return x * Math.PI / 180;
}
</script>

</body>
</html>
