      // We first load the data from your data source
      d3.csv("/views/maindata/data_new.csv").then(data => {

        // We then need to prepare the data
        let districtData = {};
        let maxTurbidity = 0;
        let maxSources = 0;
        data.forEach(d => {
          if (!districtData[d.District]) {
            districtData[d.District] = {turbidity: 0, sources: 0};
          }
          let turbidity = +d.Turbidity;
          if (isNaN(turbidity)) turbidity = 0;
          districtData[d.District].turbidity += turbidity;
          districtData[d.District].sources++;
          if (districtData[d.District].turbidity > maxTurbidity) maxTurbidity = districtData[d.District].turbidity;
          if (districtData[d.District].sources > maxSources) maxSources = districtData[d.District].sources;
        });

        // Scale for the bubbles
        let radiusScale = d3.scaleSqrt().domain([0, maxSources]).range([0, 50]);

        // X scale
        let x = d3.scaleBand()
          .domain(Object.keys(districtData))
          .range([50, 900]);

        // Y scale
        let y = d3.scaleLinear()
          .domain([0, maxTurbidity])
          .range([550, 50]);

        // Select the SVG
        let svg = d3.select("#myvisualization");

        // Add the x-axis
        svg.append("g")
          .attr("transform", "translate(0,550)")
          .call(d3.axisBottom(x));

        // Add the y-axis
        svg.append("g")
          .attr("transform", "translate(50,0)")
          .call(d3.axisLeft(y));

        // Add one bubble per district to the SVG
        svg.selectAll("circle")
          .data(Object.entries(districtData))
          .join("circle")
            .attr("class", "bubble")
            .attr("cx", d => x(d[0]))
            .attr("cy", d => y(d[1].turbidity))
            .attr("r", d => radiusScale(d[1].sources))
            .append("title")  // Tooltip to show value for each bubble
            .text(d => `District: ${d[0]}, Average Turbidity: ${d[1].turbidity/d[1].sources.toFixed(2)}, Number of Sources: ${d[1].sources}`);

        // Add labels for the axes
        svg.append("text")
            .attr("transform", "translate(300,590)")
            .style("text-anchor", "middle")
            .text("District");

        svg.append("text")
            .attr("transform", "rotate(-90)")
            .attr("y", 10)
            .attr("x", -300)
            .attr("dy", "1em")
            .style("text-anchor", "middle")
            .text("Average Turbidity");
      });
