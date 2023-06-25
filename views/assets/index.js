// Global variables
var data;
var currentParameter = "ecoli";

// Load data from data.csv 
d3.csv("/views/maindata/data.csv").then(function (dataset) {
  data = dataset;
  updateChart();
});

// Function to update the chart based on the selected parameter
function updateChart() {
  var parameter = d3.select("#parameter-select").node().value;
  currentParameter = parameter;

  // Process the data
  var processedData = processData(data, parameter);

  // Set up chart dimensions
  var margin = { top: 20, right: 20, bottom: 50, left: 50 };
  var width = 1000 - margin.left - margin.right;
  var height = 500 - margin.top - margin.bottom;

  // Remove existing SVG element
  d3.select("#bar-chart").select("svg").remove();

  // Create SVG element
  var svg = d3.select("#bar-chart")
    .append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
    .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

  // Define scales
  var xScale = d3.scaleBand()
    .domain(processedData.map(function (d) { return d.district; }))
    .range([0, width])
    .padding(0.1);

  var yScale = d3.scaleLinear()
    .domain([0, d3.max(processedData, function (d) { return d.value; })])
    .range([height, 0]);

  // Draw bars
  var bars = svg.selectAll(".bar")
    .data(processedData);

  bars.enter()
    .append("rect")
    .attr("class", "bar")
    .merge(bars)
    .attr("x", function (d) { return xScale(d.district); })
    .attr("y", height)
    .attr("width", xScale.bandwidth())
    .attr("height", 0)
    .attr("fill", function (d) { return d.color; })
    .on("mouseover", function (d) {
      d3.select(this)
        .transition()
        .duration(200)
        .attr("fill", "orange");
      showBarValue(d);
    })
    .on("mouseout", function (d) {
      d3.select(this)
        .transition()
        .duration(200)
        .attr("fill", function (d) { return d.color; });
      hideBarValue();
    })
    .transition()
    .duration(1000)
    .attr("y", function (d) { return yScale(d.value); })
    .attr("height", function (d) { return height - yScale(d.value); });

  bars.exit().remove();

  // Add x-axis
  svg.append("g")
    .attr("transform", "translate(0," + height + ")")
    .call(d3.axisBottom(xScale))
    .selectAll("text")
    .style("text-anchor", "end")
    .attr("dx", "-.8em")
    .attr("dy", ".15em")
    .attr("transform", "rotate(-90)");

  // Add y-axis
  svg.append("g")
    .call(d3.axisLeft(yScale));

  // Add constant line for the target value
  var targetValue = getTargetValue(currentParameter);
  svg.append("line")
    .attr("class", "target-line")
    .attr("x1", 0)
    .attr("x2", width)
    .attr("y1", yScale(targetValue))
    .attr("y2", yScale(targetValue));

  // Update chart title
  var chartTitle = getChartTitle(currentParameter);
  d3.select("#chart-title")
    .text(chartTitle);

  // Update y-axis label
  var yAxisLabel = getYAxisLabel(currentParameter);
  svg.selectAll(".y-axis-label").remove();
  svg.append("text")
    .attr("class", "y-axis-label")
    .attr("transform", "rotate(-90)")
    .attr("y", 0 - margin.left)
    .attr("x", 0 - (height / 2))
    .attr("dy", "1em")
    .style("text-anchor", "middle")
    .text(yAxisLabel);
}

// Function to process the raw data
function processData(data, parameter) {
  // Process the data here and return an array of objects with district, value, and color properties
  return data.map(function (d) {
    return {
      district: d.District,
      value: +d[parameter],
      color: "#3498db" // Change the color as needed
    };
  });
}

// Function to get the target value based on the parameter
function getTargetValue(parameter) {
  // Return the target value based on the parameter
  // Modify as needed
  switch (parameter) {
    case "ecoli":
      return 1;
    case "turbidity":
      return 25;
    case "sulphate":
      return 400;
    case "pH":
      return 5.5;
    default:
      return 0;
  }
}

// Function to get the chart title based on the parameter
function getChartTitle(parameter) {
  // Return the chart title based on the parameter
  // Modify as needed
  switch (parameter) {
    case "ecoli":
      return "Average Ecoli concentration in water bodies per district";
    case "turbidity":
      return "Average Turbidity in water bodies per district";
    case "sulphate":
      return "Average Sulphate concentration in water bodies per district";
    case "pH":
      return "Average pH level in water bodies per district";
    default:
      return "";
  }
}

// Function to get the y-axis label based on the parameter
function getYAxisLabel(parameter) {
  // Return the y-axis label based on the parameter
  // Modify as needed
  switch (parameter) {
    case "ecoli":
      return "Average Ecoli concentration";
    case "turbidity":
      return "Average Turbidity";
    case "sulphate":
      return "Average Sulphate concentration";
    case "pH":
      return "Average pH level";
    default:
      return "";
  }
}

// Function to show bar value on hover
function showBarValue(data) {
  var tooltip = d3.select("#tooltip");
  tooltip.select("#district").text(data.district);
  tooltip.select("#value").text(data.value);
  tooltip.style("display", "block");
}

// Function to hide bar value
function hideBarValue() {
  d3.select("#tooltip")
    .style("display", "none");
}
