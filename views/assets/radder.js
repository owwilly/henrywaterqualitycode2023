    // Global variables
    var data;
    var currentParameter = "ecoli";
    var currentDistrict = "all";
    var chart;

    // Load data from data.csv and target.csv
    d3.csv("/views/maindata/data.csv").then(function(dataset) {
      data = dataset;
      populateDistrictOptions(data);
      updateChart();
    });

    // Function to populate district options
    function populateDistrictOptions(data) {
      var districtOptions = Array.from(new Set(data.map(d => d.District)));
      var select = d3.select("#district-select");
    
      // Log the array of districts to the console
      console.log("Districts:", districtOptions);
    
      select.selectAll("option")
        .data(districtOptions)
        .enter()
        .append("option")
        .text(function(d) { return d; })
        .attr("value", function(d) { return d; });
    }

    // Function to update the chart based on the selected parameter and district
    function updateChart() {
      var parameter = d3.select("#parameter-select").node().value;
      var district = d3.select("#district-select").node().value;
      currentParameter = parameter;
      currentDistrict = district;

      // Process the data
      var processedData = processData(data, parameter, district);

      // Prepare data for radar chart
      var chartData = {
        series: [
          {
            name: parameter,
            data: processedData.map(function(d) { return d.value; })
          }
        ],
        labels: processedData.map(function(d) { return d.district; })
      };

      // Set up chart options
      var chartOptions = {
        chart: {
          animations: {
            enabled: true, // Enable animations
            dynamicAnimation: {
              speed: 500 // Set the animation speed
            }
          },
          height: 600
        },
        series: chartData.series,
        labels: chartData.labels,
        dataLabels: {
          enabled: true,
          style: {
            fill: '#000000',
            fontSize: '12px',
            fontFamily: 'Comfortaa, cursive',
            transform: 'rotate(-90deg)', // Rotate labels by -45 degrees
            textAnchor: 'end' // Align rotated labels to the end
          }
        },
        plotOptions: {
          radar: {
            dataLabels: {
              offsetY: 5,
              formatter: function(value, { seriesIndex, dataPointIndex }) {
                if (value === Math.max(...chartData.series[seriesIndex].data))
                  return value;
                return '';
              }
            },
            polygons: {
              fill: {
                colors: ['#AA4A44', '#2979ff']
              }
            }
          }
        }
      };

      // Remove existing chart
      if (chart) {
        chart.destroy();
      }

      // Create radar chart
      chart = new ApexCharts(document.querySelector("#radar-chart"), chartOptions);
      chart.render();

      // Update chart title
      var chartTitle = getChartTitle(parameter, district);
      d3.select("#chart-title")
        .text(chartTitle);
    }

    // Function to process the raw data
    function processData(data, parameter, district) {
      // Filter the data based on the selected district
      var filteredData = data;
      if (district !== "all") {
        filteredData = data.filter(function(d) {
          return d.District === district;
        });
      }

      // Process the filtered data here and return an array of objects with district, value, and color properties
      return filteredData.map(function(d) {
        return {
          district: d.District.substring(0, 3), // Truncate label to the first 3 characters
          value: +d[parameter]
        };
      });
    }

    // Function to get the chart title based on the parameter and district
    function getChartTitle(parameter, district) {
      var title = "";
      if (district === "all") {
        title += parameter + " Concentration by District";
      } else {
        title += parameter+ " Concentration in " + district;
      }
      return title;
    }
