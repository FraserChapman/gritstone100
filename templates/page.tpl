<include href="partial/header.tpl" />

<include href="partial/splash.tpl" />

<check if="{{ @@content }}">
    <section id="content">
        <include href="{{ @content }}" />
    </section>
</check>

<include href="partial/footer.tpl" />