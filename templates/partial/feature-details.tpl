<set dms="{{ \App\Helpers::coordinateToDMS(@feature.geometry.coordinates) }}" />
<set elevation="{{ \App\Helpers::metresToFeet(@feature.geometry.coordinates[2]) }}" />

<li data-id="{{ @@feature.id }}" 
    data-lat="{{ @feature.geometry.coordinates[1] }}" 
    data-lng="{{ @feature.geometry.coordinates[0] }}">
    <div class=" name">{{ @@feature.properties.name }}</div>
    <div class="dist">{{ @@feature.properties.distance }} mi</div>
    <check if="{{ @@feature.properties.icon }}">
        <div class="material-icons">{{ @@feature.properties.icon }}</div>
    </check>
    <div class="desc">
        {{ @@feature.properties.desc }}
        <div class="extra">
            <div>
                <span class="label">Distance from previous:</span> {{ @@feature.properties.prev }} mi
            </div>
            <div>
                <span class="label">OS Grid Ref:</span> {{ @@feature.properties.osgb }}
            </div>
            <div>
                <span class="label">Latitude:</span> {{ @dms.lat }}
            </div>
            <div>
                <span class="label">Longitude:</span> {{ @dms.lng }}
            </div>
            <div>
                <span class="label">Elevation:</span> {{ @elevation }} ft
            </div>
        </div>
    </div>
</li>