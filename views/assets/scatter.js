    // Global variables
    var data;
    var currentXParameter = "ecoli";
    var currentYParameter = "ecoli";

    // Load data from data.csv
    d3.csv("/views/maindata/data.csv").then(function (dataset) {
      data = dataset;
      updateChart();
    });

    // Function to update the scatter plot based on the selected parameters
    function updateChart() {
      var xParameter = d3.select("#x-parameter-select").node().value;
      var yParameter = d3.select("#y-parameter-select").node().value;
      currentXParameter = xParameter;
      currentYParameter = yParameter;

      // Process the data
      var processedData = processData(data, xParameter, yParameter);

      // Set up the chart dimensions
      var margin = { top: 50, right: 50, bottom: 50, left: 50 };
      var width = 900 - margin.left - margin.right;
      var height = 600 - margin.top - margin.bottom;

      // Create the SVG container
      var svg = d3.select("#scatter-plot")
        .html("") // Clear the previous content
        .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

      // Set up the x-scale
      var xScale = d3.scaleLinear()
        .domain(d3.extent(processedData, function (d) { return d.xValue; }))
        .range([0, width]);

      // Set up the y-scale
      var yScale = d3.scaleLinear()
        .domain(d3.extent(processedData, function (d) { return d.yValue; }))
        .range([height, 0]);

      // Draw x-axis
      var xAxis = d3.axisBottom(xScale);
      svg.append("g")
        .attr("class", "x-axis")
        .attr("transform", "translate(0," + height + ")")
        .call(xAxis);

      // Draw y-axis
      var yAxis = d3.axisLeft(yScale);
      svg.append("g")
        .attr("class", "y-axis")
        .call(yAxis);

      // Draw points
      var points = svg.selectAll(".point")
        .data(processedData);

      points.enter()
        .append("circle")
        .attr("class", "point")
        .merge(points)
        .attr("cx", function (d) { return xScale(d.xValue); })
        .attr("cy", function (d) { return yScale(d.yValue); })
        .attr("r", 5)
        .attr("fill", function (d) { return d.color; })
        .on("mouseover", function (event, d) {
          d3.select(this)
            .attr("opacity", 0.7)
            .attr("stroke", "black")
            .attr("stroke-width", 1);
          showTooltip(event, d);
        })
        .on("mouseout", function () {
          d3.select(this)
            .attr("opacity", 1)
            .attr("stroke", "none");
          hideTooltip();
        });

      points.exit().remove();

      // Update chart title
      var chartTitle = currentXParameter + " vs " + currentYParameter;
      d3.select("#chart-title").text(chartTitle);

      // Update x-axis label
      var xAxisLabel = currentXParameter;
      d3.select("#x-axis-label-container").text(xAxisLabel);

      // Update y-axis label
      var yAxisLabel = getAxisLabel(yParameter);
      svg.append("text")
        .attr("class", "y-axis-label")
        .attr("transform", "rotate(-90)")
        .attr("x", 0 - (height / 2))
        .attr("y", 0 - margin.left)
        .attr("dy", "1em")
        .style("text-anchor", "middle")
        .text(yAxisLabel);
    }

    // Function to process the data and return an array of objects with x and y values
    function processData(data, xParameter, yParameter) {
      return data.map(function (d) {
        return {
          xValue: +d[xParameter],
          yValue: +d[yParameter],
          color: getColor(d)
        };
      });
    }

    // Function to get the axis label based on the parameter
    function getAxisLabel(parameter) {
      switch (parameter) {
        case "ecoli":
          return "Ecoli";
        case "turbidity":
          return "Turbidity";
        case "pH":
          return "pH";
        case "sulphate":
          return "Sulphate";
        default:
          return "";
      }
    }

    // Function to get the color based on the ecoli value
    function getColor(d) {
      var ecoliValue = +d.ecoli;
      if (ecoliValue >= 0 && ecoliValue <= 1)
        return "green";
      else if (ecoliValue > 1 && ecoliValue <= 5)
        return "yellow";
      else if (ecoliValue > 5)
        return "red";
      else
        return "gray";
    }

    // Function to show the tooltip on hover
    function showTooltip(event, d) {
      var tooltip = d3.select("#scatter-plot")
        .append("div")
        .attr("class", "tooltip")
        .style("position", "absolute")
        .style("left", event.pageX + 10 + "px")
        .style("top", event.pageY - 10 + "px");

      var xValue = d.xValue.toFixed(2);
      var yValue = d.yValue.toFixed(2);

      tooltip.html("(" + xValue + ", " + yValue + ")");
    }

    // Function to hide the tooltip
    function hideTooltip() {
      d3.select(".tooltip").remove();
    }
