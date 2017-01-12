// $(document).ready(function () {
//     new common().topMessage('info',"abdasdfasd")
// });

var helper = function () {
    var _this = this;
    this.topMessage = function (type, message) {
        var warp = $(".top-message.alert-" + type);
        warp.html(message);
        warp.show();
        setTimeout(function () {
            warp.hide();
        }, 5000)
    };

    this.ladder = function () {
        var glyphicon = $(".glyphicon");
        var current, id, __this, next;
        glyphicon.click(function () {
            __this = $(this);
            current = __this.attr("class");
            id = __this.attr("data-id");
            next = $("tr[data-pid=" + id + "]");
            if (current == "glyphicon glyphicon-chevron-up") {
                next.show();
                __this.attr("class", "glyphicon glyphicon-chevron-down");
            } else {
                next.hide();
                __this.attr("class", "glyphicon glyphicon-chevron-up");
            }
        });
    };

    this.isShowProperties = function (defaultStatus) {
        var checkbox = $("input[data-type=prop]");
        if (defaultStatus) {
            checkbox.attr("name", "value[]");
        } else {
            var isClose = true;
            $("#btn-assign-prop").click(function () {
                if (isClose) {
                    checkbox.attr("name", "value[]");
                    isClose = false;
                } else {
                    checkbox.attr("name", "");
                    isClose = true;
                }
            })
        }
    }
};