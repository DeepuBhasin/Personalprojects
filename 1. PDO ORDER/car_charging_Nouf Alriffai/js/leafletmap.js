// Get the values of the input fields with the ids 'lat', 'long', and 'price'
const lat = document.querySelector('#lat').value;
const long = document.querySelector('#long').value;
const price = document.querySelector('#price').value;

// Create a Leaflet map with the specified latitude and longitude, and zoom level 13
const map = L.map('map').setView([lat, long], 13);

// Add a tile layer to the map with the specified URL and options
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

// Create a marker with the specified latitude and longitude, and bind a popup with the price
const marker = L.marker([lat, long]).bindPopup(`BD ${price}`).addTo(map);

// Create a new Leaflet map with double-click zoom disabled, and locate the user's position
L.map('map', {doubleClickZoom: false}).locate({setView: true, maxZoom: 16});

// Call the function 'initMap' when the window finishes loading
window.onload = function() {
    initMap();
};

// Invalidate the map size when the window is resized
window.addEventListener('resize', function() {
    map.invalidateSize();
});

// Create a marker on the map with the specified UID, picture, latitude, longitude, and full name
function addMarkerOnMap(uid, pic, lat, long, fullName) {
    const marker = L.marker([lat, long]).addTo(map);
    marker.bindPopup(`username: ${fullName}<br>Price: ${price}`); //the popup
}

// Load the locations of others onto the map
function loadLocations() {
    // Make an AJAX request to get the locations data
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                const responseJSON = JSON.parse(xhr.responseText);

                // Loop through the locations data and add markers to the map
                for (let i = 0; i < responseJSON.length; i++) {
                    const location = responseJSON[i];
                    addMarkerOnMap(location.uid, location.pic, location.lat, location.long, location.fullName);
                }
            } else {
                console.error('Failed to load locations');
            }
        }
    };
    xhr.open('GET', 'locations.json');
    xhr.send();
}

// Call the 'loadLocations' function after the page has loaded
window.addEventListener('load', function() {
    loadLocations();
});