const mediterranean = {
    lat: 40,
    lng: 20
}

const zoomLevel = 5;

var map = L.map('map').setView([mediterranean.lat, mediterranean.lng], zoomLevel);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);