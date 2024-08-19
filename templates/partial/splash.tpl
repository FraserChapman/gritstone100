<figure id="splash">
    <check if="{{@@content}}">
        <div class="showmore">V</div>
    </check>
    <figcaption>
        <check if="{{@@caption}}">
            <h1>{{ @caption }}</h1>
        </check>
        <check if="{{@@byline}}">
            <p>{{ @byline | raw }}</p>
        </check>
    </figcaption>
</figure>