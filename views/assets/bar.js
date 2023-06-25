d3.csv("/views/maindata/data_new.csv").then((data) => {
    const dataset = d3.group(data, d => d.District);
    const districts = Array.from(dataset.keys());

    const width = 900;
    const height = 600;
    const margin = { top: 20, right: 20, bottom: 30, left: 40 };
    const innerWidth = width - margin.left - margin.right;
    const innerHeight = height - margin.top - margin.bottom;

    const x = d3.scaleBand()
      .domain(districts)
      .range([0, innerWidth])
      .padding(0.1);

    const y = d3.scaleLinear()
      .domain([0, d3.max(dataset, d => d[1].length)])
      .range([innerHeight, 0]);

    const svg = d3.select("#myvisualization")
      .append("svg")
      .attr("width", width)
      .attr("height", height)
      .append("g")
      .attr("transform", `translate(${margin.left},${margin.top})`);

    svg.selectAll(".bar")
      .data(dataset)
      .enter()
      .append("rect")
      .attr("class", "bar")
      .attr("x", d => x(d[0]))
      .attr("y", d => y(d[1].length))
      .attr("width", x.bandwidth())
      .attr("height", d => innerHeight - y(d[1].length))
      .append("title")
      .text(d => `District: ${d[0]}\nTotal Water Sources: ${d[1].length}`);

    svg.selectAll(".label")
      .data(dataset)
      .enter()
      .append("text")
      .attr("class", "label")
      .attr("x", d => x(d[0]) + x.bandwidth() / 2)
      .attr("y", d => y(d[1].length) - 5)
      .attr("text-anchor", "middle")
      .text(d => d[1].length);

    svg.append("g")
      .attr("transform", `translate(0,${innerHeight})`)
      .call(d3.axisBottom(x));

    svg.append("g")
      .call(d3.axisLeft(y));
  });
