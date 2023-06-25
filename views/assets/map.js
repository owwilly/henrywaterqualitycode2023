    // Global variables
    var data;
    var currentParameter = "ecoli";
    var map;
    var heatmapLayer;
    var mapTitle;
    var heatmapData;

    // Initialize the map
    function initMap() {
      // Create the Leaflet map
      map = L.map('map').setView([1.2, 32.3], 7);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
        maxZoom: 18,
      }).addTo(map);
    }

    // Load data from data.csv and generate the map
    d3.csv("/views/maindata/data.csv").then(function (dataset) {
      data = dataset;
      initMap();
      updateMap();
    });

    // Function to update the map based on the selected parameter
    function updateMap() {
      var parameter = d3.select("#parameter-select").node().value;
      currentParameter = parameter;

      // Process the data
      processData(data, parameter).then(function (processedData) {
        // Remove existing markers and heatmap layer
        map.eachLayer(function (layer) {
          if (layer instanceof L.Marker || layer instanceof L.CircleMarker || layer instanceof L.HeatLayer) {
            map.removeLayer(layer);
          }
        });

        // Remove existing map title
        if (mapTitle) {
          map.removeControl(mapTitle);
        }

        // Add markers to the map
        var promises = processedData.map(function (d) {
          if (d.latitude !== null && d.longitude !== null) {
            var marker = L.marker([d.latitude, d.longitude]).addTo(map);
            marker.bindPopup('<strong>' + d.village + '</strong><br>' + parameter + ': ' + d.value);
          }
        });

        Promise.all(promises).then(function () {
          // All markers have been added to the map

          // Create an array of latlng values for the heatmap
          heatmapData = processedData.map(function (d) {
            if (d.latitude !== null && d.longitude !== null) {
              return [parseFloat(d.latitude), parseFloat(d.longitude), d.value];
            }
          });

          // Filter out null values
          heatmapData = heatmapData.filter(function (d) {
            return d !== undefined;
          });

          // Create the heatmap layer and add it to the map
          heatmapLayer = L.heatLayer(heatmapData, { radius: 25, gradient: { 0.4: 'blue', 0.6: 'green', 1: 'red' } }).addTo(map);

          // Add title to the map
          var title = parameter.charAt(0).toUpperCase() + parameter.slice(1);
          mapTitle = L.control({ position: 'topright' });
          mapTitle.onAdd = function (map) {
            var div = L.DomUtil.create('div', 'map-title');
            div.innerHTML = '<h3>' + title + ' Quantity per Water Source</h3>';
            return div;
          };
          mapTitle.addTo(map);
        });
      });
    }

    // Function to process the raw data
    function processData(data, parameter) {
      // Process the data here and return the processed data as an array of objects
      return Promise.all(
        data.map(async function (d) {
          const village = d.village;
          const latitude = parseFloat(d.Latitude);
          const longitude = parseFloat(d.Longitude);
          let value = +d[parameter];

          if(isNaN(value)) value = 0;  // Set NaN values to 0
          if (isNaN(latitude) || isNaN(longitude)) {
            // Skip data points with invalid coordinates
            return null;
          }

          return { village, latitude, longitude, value };
        })
      ).then(function (processedData) {
        // Filter out null values
        return processedData.filter(function (d) {
          return d !== null;
        });
      });
    }
