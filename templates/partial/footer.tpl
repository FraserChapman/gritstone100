<include if="{{ @@footer }}" href="{{ @footer }}" />
<footer>
    © GRITSTONE100 2021-{{ date('Y') }} | <a data-active="{{ @id === 'disclaimer' }}" href="/disclaimer">DISCLAIMER</a>
</footer>
<script src="{{ @JS . 'scripts.js' }}"></script>
</body>

</html>