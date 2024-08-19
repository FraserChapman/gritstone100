function ElevationChart(data, {
   x = ([x]) => x,
   y = ([, y]) => y,
   defined,
   curve = d3.curveLinear,
   marginTop = 20,
   marginRight = 30,
   marginBottom = 30,
   marginLeft = 40,
   width = 220,
   height = 130,
   xDomain,
   xRange = [marginLeft, width - marginRight],
   xType = d3.scaleLinear,
   xLabel = "→ distance (mi)",
   yDomain,
   yRange = [height - marginBottom, marginTop],
   yType = d3.scaleLinear,
   yFormat,
   yLabel = "↑ height (ft)",
   color = "red",
   strokeLinecap = "round",
   strokeLinejoin = "round",
   strokeWidth = 1.5,
   strokeOpacity = 1,
   focusColor = "#323232",
   markerFilter = d => { },
   markerText = d => y(d)
} = {}) {
   // Compute values.
   const X = d3.map(data, x);
   const Y = d3.map(data, y);
   const I = d3.range(X.length);

   if (defined === undefined) {
      defined = (d, i) => !isNaN(X[i]) && !isNaN(Y[i])
   }

   const D = d3.map(data, defined);

   // Compute default domains.
   if (xDomain === undefined) xDomain = d3.extent(X);
   if (yDomain === undefined) yDomain = [0, d3.max(Y)];

   // Construct scales and axes.
   const xScale = xType(xDomain, xRange);
   const yScale = yType(yDomain, yRange);
   const xAxis = d3.axisBottom(xScale).ticks(12).tickSizeOuter(0);
   const yAxis = d3.axisLeft(yScale).ticks(height / 40, yFormat);

   // Construct a line generator.
   const line = d3.line()
      .defined(i => D[i])
      .curve(curve)
      .x(i => xScale(X[i]))
      .y(i => yScale(Y[i]));

   // Create svg
   const svg = d3.create("svg")
      .attr("width", width)
      .attr("height", height)
      .attr("viewBox", [0, 0, width, height])
      .attr("preserveAspectRatio", "xMinYMin")
      .attr("style", "max-width: 100%; height: auto; height: intrinsic;");

   // Create X axes and label
   svg.append("g")
      .attr("transform", `translate(0,${height - marginBottom})`)
      .call(xAxis)
      .call(g => g.append("text")
         .attr("fill", "currentColor")
         .attr("x", marginLeft)
         .attr("y", marginBottom)
         .text(xLabel));

   // Create Y axes
   svg.append("g")
      .attr("transform", `translate(${marginLeft},0)`)
      .call(yAxis)
      .call(g => g.select(".domain").remove())
      .call(g => g.selectAll(".tick line").clone()
         .attr("x2", width - marginLeft - marginRight)
         .attr("stroke-opacity", 0.1))
      .call(g => g.append("text")
         .attr("x", -marginLeft)
         .attr("y", 10)
         .attr("fill", "currentColor")
         .attr("text-anchor", "start")
         .text(yLabel));

   // Create indicator lines
   svg.selectAll(null)
      .data(d3.filter(data, markerFilter))
      .join(
         enter => enter.append("g")
            .attr("transform", d => `translate(${xScale(x(d))},${yScale(y(d))})`)
            .attr("font-size", 10)
            .call(g => g.append("text")
               .attr("text-anchor", "middle")
               .attr("y", -5)
               .style("fill", "#08b8e8")
               .text(markerText))
            .call(g => g.append("line")
               .attr("y2", d => height - marginBottom - yScale(y(d)))
               .attr("style", "stroke: #08b8e8; stroke-dasharray: 4"))
      );


   // Create elevation line
   svg.append("path")
      .attr("fill", "none")
      .attr("stroke", color)
      .attr("stroke-width", strokeWidth)
      .attr("stroke-linecap", strokeLinecap)
      .attr("stroke-linejoin", strokeLinejoin)
      .attr("stroke-opacity", strokeOpacity)
      .attr("d", line(I));

   // Create the circle that travels along the curve
   const focus = svg
      .append("g")
      .style("opacity", 0)
      .call(g => g.append("circle")
         .attr("r", 2)
         .style("fill", focusColor))
      .call(g => g.append("line")
         .attr("style", `stroke: ${focusColor}; stroke-dasharray: 4`));

   // Create brushx for selection
   const brush = d3.brushX()
      .extent([
         [marginLeft, 0.5],
         [width - marginRight, 120 - marginBottom + 0.5]
      ])
      .on("end", e => {
         if (e.selection) {
            const start = d3.bisector(x).left(data, xScale.invert(e.selection[0]), 1),
               end = d3.bisector(x).right(data, xScale.invert(e.selection[1]), 1);
            svg.node().dispatchEvent(new CustomEvent("brush", {
               //detail: e.selection.map(d => data[d3.bisector(x).left(data, xScale.invert(d), 1)])
               detail: data.slice(start, end)
            }));
         }
      });

   // Bind the tracking events to the brush
   svg.append("g")
      .call(brush)
      .on("touchstart", e => e.preventDefault())
      .on("mousemove touchmove", e => {
         const i = d3.bisector(x).left(
            data,
            xScale.invert(d3.pointers(e)[0][0]),
            1
         );

         if (!data[i]) {
            return; // no matching point
         }

         focus.attr("transform", `translate(${xScale(x(data[i]))},${yScale(y(data[i]))})`)
            .select("line")
            .attr("y2", height - marginBottom - yScale(y(data[i])));

         svg.node().dispatchEvent(new CustomEvent("move", { detail: data[i] }));
      })
      .on("mouseover touchstart", () => {
         svg.node().dispatchEvent(new Event("over"))
         focus.style("opacity", 1);
      })
      .on("mouseout touchend", () => {
         svg.node().dispatchEvent(new Event("out"))
         focus.style("opacity", 0);
      });

   return svg.node();
}

