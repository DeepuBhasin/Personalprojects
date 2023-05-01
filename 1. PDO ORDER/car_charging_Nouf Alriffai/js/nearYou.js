// Get the user's current location using geolocation
function getLocation() {
  if (navigator.geolocation) { // check if geolocation is supported
    showSpinner(); // show the loading spinner
    navigator.geolocation.getCurrentPosition(loadLocations, showError); // get current position and call loadLocations or showError
  } else {
    showError("Geolocation is not supported by this browser."); // show an error message
  }
}

// Load locations data and display markers on the map
function loadLocations(position) {
  let lat = position.coords.latitude; // get latitude from position object
  let long = position.coords.longitude; // get longitude from position object

  const cacheKey = `${lat},${long}`;
  const cachedData = localStorage.getItem(cacheKey);
  if (cachedData) {
    const responseJSON = JSON.parse(cachedData);
    displayMap(responseJSON, lat, long);
    return;
  }

  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) { // check if the response is ready and successful
      const responseJSON = JSON.parse(xhr.responseText); // parse the response as JSON
      localStorage.setItem(cacheKey, xhr.responseText); // cache the responseJSON
      displayMap(responseJSON, lat, long);
    } else if (xhr.readyState == 4 && xhr.status != 200) { // check if the response is ready but not successful
      showError("Error loading locations."); // show an error message
    }
  };
  xhr.open("GET", `nearYou.php?nearest=1&lat=${lat}&long=${long}`, true); // open a GET request to the server with the user's location
  xhr.send(); // send the request
}

// Display the map with markers
function displayMap(responseJSON, lat, long) {
  hideSpinner(); // hide the loading spinner
  const map = L.map("map").setView([lat, long], 13); // create a Leaflet map centered on the user's location
  L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", { // add a tile layer to the map
    maxZoom: 19,
    attribution:
        '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
  }).addTo(map);
  const marker = L.marker([lat, long]).addTo(map); // add a marker at the user's location

  const allMarkers = responseJSON.allMarkers; // get the array of all markers from the response
  for (let i = 0; i < allMarkers.length; i++) { // loop through all markers and add them to the map
    const popupText = `BD ${allMarkers[i].price}, ${allMarkers[i].loc}`; // create a popup text for the marker
    L.marker([allMarkers[i].lat, allMarkers[i].long]) // create the marker
        .bindPopup(popupText) // bind the popup to the marker
        .addTo(map); // add the marker to the map
  }
}

// Show an error message
function showError(message) {
  hideSpinner(); // hide the loading spinner
  const errorBox = document.createElement("div");
  errorBox.classList.add("error-box");
  errorBox.textContent = message;
  document.body.appendChild(errorBox);
  setTimeout(() => errorBox.remove(), 5000); // remove the error message after 5 seconds
}

// Show a loading spinner
function showSpinner() {
  const spinner = document.createElement("div");
  spinner.classList.add("spinner");
  document.body.appendChild(spinner);
}

// Hide the loading spinner
function hideSpinner() {
  const spinner = document.querySelector(".spinner");
  if (spinner) {
    spinner.remove();
  }
}

// Call getLocation on window load
window.onload = function () {
  getLocation();
};