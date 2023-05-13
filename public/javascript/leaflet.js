fetch("users/data", { // fetch the file php
    method: "GET", // POST method
    headers: { "Content-Type": "application/json" }, // set the content type
}).then(function (response) { // when the response is returned
    return response.json(); // return the response
}).then(function (response) { // when the response is returned
    response.forEach(element => { 
        console.log(element['Mid Latitude', 'Mid Longitude']);
    });
    // console.log(response);
});

// SPLIT

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

var marker = L.marker([41, 18]).addTo(map);