<section>
    <div class="sidebar">
        <div>
            <span id="toggle" title="Toggle menu" class="material-icons">menu_open</span>
            <input type="text" id="search" placeholder="Search markers...">
        </div>
        <ul>
            <repeat group="{{ @geojson.features }}" value="{{ @feature }}">
                <check if="{{ @@feature.id > 0 }}">
                    <include href="partial/feature-details.tpl" />
                </check>
            </repeat>
        </ul>
    </div>
    <div id="map"></div>
    <div id="elevation"></div>
    <div id="links">
        <div>
            <img src="/assets/img/gpx-logo.png">
            <a href="/assets/gpx/gritstone100-trkpt.gpx" download>GPX track</a>
            <a href="/assets/gpx/gritstone100-rtept.gpx" download>GPX route</a>
        </div>
        <div>
            <img src="/assets/img/hiiker-logo.png">
            <a
                href="https://www.google.com/url?q=https%3A%2F%2Fhiiker.app%2Ftrails%2Fengland%2Fsheffield%2Fgritstone-100&sa=D">Route
                on HiiKER</a>
        </div>
        <div>
            <img src="/assets/img/osmap-logo.png">
            <a href="https://explore.osmaps.com/route/9147343/gritstone100">Route on OS Maps</a>
        </div>
    </div>
</section>

<section class="card">
    <img src="/assets/img/map-ol1.jpg">
    <div>
        <h3>OS Explorer OL1</h3>
        <p>
            The 1:25,000 OS Explorer map of The Peak District is a must-have when visiting the Dark Peak Area.
        </p>
        <p>
            <a href="https://shop.ordnancesurvey.co.uk/map-of-the-peak-district-dark-peak-area/">OL1 Dark Peak Area</a>
        </p>
    </div>
</section>

<section class="card">
    <img src="/assets/img/map-harvey.jpg">
    <div>
        <h3>Harvey Superwalker XT25 | BMC Dark Peak</h3>
        <p>
            Also Great maps for anyone wanting to complete this route. The Superwalker XT25 maps are 1:25,000 and the
            BMC is 1:40,000.
            The BMC is ideal if you are more familiar with the area or are more confident working with reduced
            information, if sticking to
            the route it should be more than adequate.
        </p>
        <p>
            <a href="https://www.harveymaps.co.uk/acatalog/Peak-District-North-YHSWPEN.html#SID=5">Harvey Superwalker
                XT25 - Peak District North</a>
            <br>
            <a href="https://www.harveymaps.co.uk/acatalog/Peak-District-Central-YHSWPEC.html#SID=5">Harvey Superwalker
                XT25 - Peak District Central</a>
            <br>
            <a href="https://shop.thebmc.co.uk/product/dark-peak-mountain-map/">BMC Dark Peak</a>
        </p>
    </div>
</section>

<section class="card">
    <img src="/assets/img/book-sym.jpg">
    <div>
        <h3>The South Yorkshire Moors</h3>
        <p>
            A great book for anyone wanting to explore, or know more about, the Dark Peak.
            All Chris Goddard's books are beautiful, rich, and interesting reads and I found 
            this volume in particular a superb reference when planning the route. 
            The local knowledge really brings a light to the Dark Peak!
        </p>
        <p>
            <a href="https://christophergoddard.net/product/the-south-yorkshire-moors/">
                The South Yorkshire Moors by Christopher Goddard
            </a>
        </p>
    </div>
</section>

<script src="/assets/js/elevation-chart.min.js"></script>
<script src="/assets/js/map.min.js"></script>
