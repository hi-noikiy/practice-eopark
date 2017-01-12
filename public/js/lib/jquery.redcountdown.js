(function ($) {
    $.fn.redCountdown = function (Options, Callback) {
        var Element = $(this);
        var SecondsLeft;
        var OnlySecondsLeft;
        var Fired = false;

        // Default settings
        var Settings = {
            end: undefined,
            now: $.now(),
            labels: true,
            labelsOptions: {
                lang: {
                    seconds: 'Seconds'
                },
                style: 'font-size:0.5em;'
            },
            style: {
                element: "",
                labels: false,
                textResponsive: .5,
                secondsElement: {
                    gauge: {
                        thickness: .02,
                        bgColor: "rgba(0,0,0,0)",
                        fgColor: "rgba(0,0,0,1)",
                        lineCap: 'butt'
                    },
                    textCSS: ''
                }

            },
            onEndCallback: function () {
            }
        };

        // If preset is set
        if (Options.preset) {
            Settings = $.extend(true, Settings, getPreset(Options.preset));
        }

        // Get custom settings
        Settings = $.extend(true, Settings, Options);

        prepareCountdown();
        Ticking();
        var tickInterval = setInterval(Ticking, 1000);
        Responsive();


        function getPreset(presetName) {
            switch (presetName) {
                case 'black-very-fat':
                    return {
                        labels: true,
                        style: {
                            element: "",
                            textResponsive: .5,
                            secondsElement: {
                                gauge: {thickness: .17, bgColor: "rgba(0,0,0,0.05)", fgColor: "#222"},
                                textCSS: 'font-family:\'Open Sans\';font-weight:300;color:#34495e;'
                            }
                        }
                    };
            }
        }

        function prepareCountdown() {
            // Inject basic styles
            if ($("#redCountdownCSS").length <= 0) {
                $("body").append("<style id='redCountdownCSS'>.redCountdownWrapper > div { display:inline-block; position:relative; width:calc(25% - 20px); margin:10px; } .redCountdownWrapper .redCountdownValue {  width:100%; line-height:1em; position:absolute; top:50%; text-align:center; left:0; display:block;}</style>");
            }

            // Create HTML elements
            Element.append('<div class="redCountdownWrapper"><div class="redCountdownSeconds"><input type="text" /><span class="redCountdownValue"><div></div><span></span></span></div></div>');

            Element.find(".redCountdownSeconds input").knob($.extend({
                width: '100%',
                displayInput: false,
                readOnly: true,
                max: 60
            }, Settings.style.secondsElement.gauge));

            // Style
            Element.find(".redCountdownWrapper > div").attr("style", Settings.style.element);
            Element.find(".redCountdownSeconds .redCountdownValue").attr("style", Settings.style.secondsElement.textCSS);
            Element.find(".redCountdownValue").each(function () {
                $(this).css("margin-top", Math.floor(0 - (parseInt($(this).height()) / 2)) + "px");
            });

            // Labels
            if (Settings.labels) {
                Element.find(".redCountdownSeconds .redCountdownValue > span").html(Settings.labelsOptions.lang.seconds);
                Element.find(".redCountdownValue > span").attr("style", Settings.labelsOptions.style);
            }

            // Calculate seconds left and split into readable DHMS
            OnlySecondsLeft = Settings.end - Settings.now;
            SecsToDHMS();
        }

        /* Converts seconds to DHMS */
        function SecsToDHMS() {
            SecondsLeft = Math.floor(( ( ( OnlySecondsLeft % 86400 ) % 3600 ) % 60 ) % 60);
        }

        /* Tick function */
        function Ticking() {
            // Decrease seconds left
            OnlySecondsLeft--;

            // Convert seconds to DHMS
            SecsToDHMS();

            // When it's over...
            if (OnlySecondsLeft <= 0) {
                if (!Fired) {
                    Fired = true;
                    Settings.onEndCallback();
                }
                DaysLeft = 0;
                HoursLeft = 0;
                MinutesLeft = 0;
                SecondsLeft = 0;
            }

            // Replace DOM values
            Element.find(".redCountdownSeconds input").val(60 - SecondsLeft).trigger('change');
            Element.find(".redCountdownSeconds .redCountdownValue > div").html(SecondsLeft);

        }

        /* Handles resizing */
        function Responsive() {

            // Keep it square
            Element.find(".redCountdownWrapper > div").each(function () {
                $(this).css("height", $(this).width() + "px");
            });

            // Responsive font size
            if (Settings.style.textResponsive) {
                Element.find(".redCountdownValue").css("font-size", Math.floor(Element.find("> div").eq(0).width() * Settings.style.textResponsive / 10) + "px");
                Element.find(".redCountdownValue").each(function () {
                    $(this).css("margin-top", Math.floor(0 - (parseInt($(this).height()) / 2)) + "px");
                });
            }

            $(window).trigger("resize");
            $(window).resize($.throttle(50, ResponsiveOnResize));
        }

        function ResponsiveOnResize(TriggerAfter) {
            // Keep it square
            Element.find(".redCountdownWrapper > div").each(function () {
                $(this).css("height", $(this).width() + "px");
            });

            // Responsive font size
            if (Settings.style.textResponsive) {
                Element.find(".redCountdownValue").css("font-size", Math.floor(Element.find("> div").eq(0).width() * Settings.style.textResponsive / 10) + "px");
            }

            // Text vertical center
            Element.find(".redCountdownValue").each(function () {
                $(this).css("margin-top", Math.floor(0 - (parseInt($(this).height()) / 2)) + "px");
            });
            Element.find(".redCountdownSeconds input").trigger('change');
        }
    }
})(jQuery);