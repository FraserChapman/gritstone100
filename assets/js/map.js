const apiKey = "u2gXrMQDPW5Zpr0pzCZppgxxbl48kkXc",
    sourceId = "gs100",
    round = n => Math.round((n + Number.EPSILON) * 100) / 100,
    convert = {
        metresToFeet: n => round(n * 3.28084),
        feetToMetres: n => round(n / 3.28084),
        milesToKilometres: n => round(n * 1.609),
        KilometresToMiles: n => round(n / 1.609),
        ddToDMS: d => {
            const absolute = Math.abs(d),
                degrees = Math.floor(absolute),
                minutesNotTruncated = (absolute - degrees) * 60,
                minutes = Math.floor(minutesNotTruncated),
                seconds = Math.floor((minutesNotTruncated - minutes) * 60);
            return `${degrees}\u00B0 ${minutes}\u2032 ${seconds}\u2033`;
        },
        coordinateToDMS: c => ({
            lat: convert.ddToDMS(c[1]) + (c[1] >= 0 ? " N" : " S"),
            lng: convert.ddToDMS(c[0]) + (c[0] >= 0 ? " E" : " W")
        })
    },
    map = new mapboxgl.Map({
        container: "map",
        minZoom: 9,
        maxZoom: 15,
        style: "assets/geojson/style.min.json",
        maxBounds: [
            [-10.76418, 49.528423],
            [1.9134116, 61.331151]
        ],

        center: [-1.69, 53.35],
        zoom: 9.5,
        transformRequest: url =>
            url.includes("?key=") ?
                { url: url + "&srs=3857" } :
                { url: url + "?key=" + apiKey + "&srs=3857" }
    }),
    infoPopup = new mapboxgl.Popup({
        className: "info-popup",
        closeButton: false,
        closeOnClick: false
    }),
    elevationPopup = new mapboxgl.Popup({
        className: "elevation-popup",
        closeButton: false,
        closeOnClick: false
    });


/**
 * Draws the elevation chart with the given data
 * @param {*} data 
 * @returns 
 */
function drawElevationChart(data) {
    const elevationChart = new ElevationChart(data.features, {
        width: document.querySelector("#content section").clientWidth,
        height: 120,
        x: d => d.properties.distance, // mi
        y: d => convert.metresToFeet(d.geometry.coordinates[2]), // ft
        markerText: "\u25EC",
        markerFilter: d => d.properties.name
            && d.properties.name
                .toUpperCase()
                .indexOf("TRIG POINT") > -1
    });

    elevationChart.addEventListener("brush", e => {
        const bounds = new mapboxgl.LngLatBounds();
        e.detail.forEach(f => bounds.extend(f.geometry.coordinates));
        map.fitBounds(bounds, { padding: 8 });
    });
    elevationChart.addEventListener("out", elevationPopup.remove);
    elevationChart.addEventListener("move", e =>
        elevationPopup
            .setLngLat(e.detail.geometry.coordinates)
            .setHTML(`${e.detail.properties.distance} mi<br>
            ${convert.metresToFeet(e.detail.geometry.coordinates[2])} ft`)
            .addTo(map)
    );

    return elevationChart;
}
// Elevation chart
fetch("/assets/geojson/gs100.min.geojson")
    .then(r => r.json())
    .then(json => {
        const elevationDiv = document.getElementById("elevation");
        elevationDiv.appendChild(drawElevationChart(json));
        window.addEventListener("resize", () => {
            elevationDiv.innerHTML = "";
            elevationDiv.appendChild(drawElevationChart(json));
        });

    })
    .catch(console.error.bind(console));


map.dragRotate.disable();
map.touchZoomRotate.disableRotation();
map.addControl(new mapboxgl.FullscreenControl());
map.addControl(new mapboxgl.NavigationControl({ showCompass: false }));
map.on("load", () => {
    map.on("mouseenter", "points", ev => {
        const point = ev.features[0];
        while (Math.abs(ev.lngLat.lng - point.geometry.coordinates[0]) > 180) {
            point.geometry.coordinates[0] +=
                (ev.lngLat.lng > point.geometry.coordinates[0]) ?
                    360 :
                    -360;
        }
        map.getCanvas().style.cursor = "pointer";
        infoPopup.setLngLat(point.geometry.coordinates)
            .setHTML(`<h1>${point.properties.name}</h1><p>${point.properties.desc ?? ""}</p>`)
            .addTo(map);
    });
    map.on("mouseleave", "points", ev => {
        map.getCanvas().style.cursor = "";
        infoPopup.remove();
    });
});

// sidebar POI clicks
document.querySelectorAll(".sidebar li").forEach(a =>
    a.addEventListener("click", ev => {
        const id = +ev.currentTarget.dataset.id,
            active = !!map.getFeatureState({
                source: sourceId,
                id: id
            }).active;
        map.setFeatureState(
            { source: sourceId, id: id },
            { active: !active }
        );
        ev.currentTarget.querySelector("div.desc").style.display = active ? "none" : "block";
        !active && map.flyTo({
            center: [+ev.currentTarget.dataset.lng, +ev.currentTarget.dataset.lat],
            zoom: 15
        });
    })
);

// sidebar filter
document.getElementById("search").addEventListener(
    "keyup",
    ev => document
        .querySelectorAll(".sidebar ul li")
        .forEach(
            x => x.style.display =
                x.textContent.toUpperCase().indexOf(ev.currentTarget.value.toUpperCase()) > -1 ?
                    "" :
                    "none"
        )
);

// sidebar toggle
const toggle = document.getElementById("toggle");
toggle.addEventListener(
    "click",
    ev => {
        document.querySelector(".sidebar").classList.toggle("closed");
        toggle.classList.toggle("closed");
        map.resize();
    }
);