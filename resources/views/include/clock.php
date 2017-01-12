    <!--[if IE]>
    <script type="text/javascript" src="js/excanvas.js"></script>
    <![endif]-->

    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script src="js/jquery.knob.min.js"></script>
    <script src="js/jquery.ba-throttle-debounce.min.js"></script>
    <script src="js/jquery.redcountdown.js"></script>

    <style>
        .redCountdownDemo {
            margin: 0 auto 30px auto;
            max-width: 800px;
            width: calc(100%);
        );
            padding: 30px;
            display: block;
        }
    </style>

<div id="rC_PI" class="redCountdownDemo">
</div>

<script type="text/javascript">
    $('#rC_PI').redCountdown({
        preset: "black-very-fat", labelsOptions: {
            style: 'font-size:0.5em; text-transform:uppercase;'
        }, end: $.now() + 61
    });

</script>
</div>
