$(document).ready(function () {
    new Category().main();
});

var Category = function () {
    var _this = this;
    var one, two, three,
        oneUl, twoUl, threeUl,
        oneLi, twoLi, threeLl,
        container;

    (function _construct() {
        _this.one = $(".subclass-one");
        _this.two = $(".subclass-two");
        _this.three = $(".subclass-three");

        _this.oneUl = $(".subclass-one ul");
        _this.oneLi = $(".subclass-one li");
        _this.container = $(".sub-container");
    })();

    this.main = function () {
        // new LoadSubData();
        setListener();
    };


    function setListener() {
        var lastTwoUlId, lastThreeUlId,
            lastOneClickLi, lastTwoClickLi, lastThreeClickLi,
            videoContainer, textContainer, downloadContainer;
        (function _construct() {
            videoContainer = $("#video-container");
            textContainer = $("#text-container");
            downloadContainer = $("#download-container");
        })();

        _this.container.click(function (e) {
            var clickObj = $(e.target);
            var pid = clickObj.attr("id");

            if (!pid) {
                return;
            }
            var pDiv = clickObj.closest(".subclass");
            var depth = pDiv.attr("data-depth");
            if (depth == 1) {
                console.log("depth=1");
                changeCategory(
                    [lastTwoUlId, lastThreeUlId],
                    "#b3b3b3",
                    _this.two,
                    [[lastOneClickLi, "#808080"], [lastTwoClickLi, "#b3b3b3"], [lastThreeClickLi, "#e6e6e6"]],
                    24
                );
                // changeResource();
                lastOneClickLi = clickObj;
                lastTwoUlId = pid;
            } else if (depth == 2) {
                changeCategory([lastThreeUlId],
                    "#e6e6e6",
                    _this.three,
                    [[lastTwoClickLi, "#b3b3b3"], [lastThreeClickLi, "#e6e6e6"]],
                    22
                );
                // changeResource();
                lastThreeUlId = pid;
                lastTwoClickLi = clickObj;
            } else if (depth == 3) {
                // changeResource();
                lastThreeClickLi = clickObj;
                clickObj.css("background", "#f2f2f2");
            }

            function changeCategory(lastUls, clickColor, childObj, lastBgds, paddingNum) {
                for (var i = 0; i < lastUls.length; i++) {
                    if (lastUls[i] != undefined) {
                        _this.container.find("ul[data-pid=" + lastUls[i] + "]").hide();
                    }
                }
                for (var j = 0; j < lastBgds.length; j++) {
                    if (lastBgds[j][0]) {
                        lastBgds[j][0].css("background", lastBgds[j][1]);
                    }
                }

                clickObj.css("background", clickColor);
                pDiv.animate({
                    "padding-left": paddingNum + "%",
                    "padding-right": paddingNum + "%",
                    "margin-bottom": "30px"
                });
                _this.container.find("ul[data-pid=" + pid + "]").show();
                childObj.css({"opacity": 0.1, "margin-top": "-10px"});
                videoContainer.css({"opacity": 0.1});
                textContainer.css({"opacity": 0.1});
                downloadContainer.css({"opacity": 0.1});
                setTimeout(function () {
                    childObj.css("display", "block");
                    childObj.animate({"margin-top": "-20px", "opacity": 1});
                    videoContainer.animate({"opacity": 1});
                    textContainer.animate({"opacity": 1});
                    downloadContainer.animate({"opacity": 1});
                }, 150);
            }

            function changeResource() {
                $.ajax({
                    type: "post",
                    url: "/category/getResource",
                    data: "id=" + pid,
                    success: function (data) {
                        console.log(data);
                        var emptyli = "<li><p>该分类暂无资源</p></li>";
                        videoContainer.html('');
                        textContainer.html('');
                        downloadContainer.html('');
                        for (var j = 0; j < data.length; j++) {
                            if (data[j].length > 0) {
                                for (var i = 0; i < data[j].length; i++) {
                                    var obj = data[j][i];
                                    if (obj.type == 1) {
                                        createVideoLi(obj);
                                    } else if (obj.type == 2) {
                                        createTextLi(obj)
                                    } else if (obj.type == 3) {
                                        createDwonloadLi(obj)
                                    }
                                }
                            } else {
                                switch (j) {
                                    case 0:
                                        videoContainer.html(emptyli);
                                        break;
                                    case 1:
                                        textContainer.html(emptyli);
                                        break;
                                    case 2:
                                        downloadContainer.html(emptyli);
                                        break;
                                    default:
                                        break
                                }
                            }
                        }
                    },
                    error: function () {

                    }
                });
                function createVideoLi(obj) {
                    console.log(obj);
                    if (obj) {
                        console.log("not nul");
                    } else {
                        console.log("null");
                    }

                    var videoLi = '<li>' +
                        ' <a href="/detail/' + obj.id + '"> ' +
                        '<img src="/img/upload/u=2020968545,2014670048&fm=21&gp=0.jpg" >' +
                        ' <div class="video-introduce">' +
                        ' <h4>' + obj.title + '</h4>' +
                        // ' <p>' + obj.introduce + '</p> ' +
                        '<p><i class="fa fa-eye">' + obj.views + '</i>' +
                        '<i class="fa fa-thumbs-o-up other">1111111</i>' +
                        '<i class="fa fa-comments-o other">' + obj.likes + '</i>' +
                        '<i class="fa fa-clock-o other">' + obj.created_at.substring(0, 10) + '</i> </p>' +
                        '</div></a></li>';
                    videoContainer.append(videoLi);
                }

                function createTextLi(obj) {
                    var textLi = '<li>' +
                        '<a href="/detail">' +
                        '<h4>' + obj.title + '</h4> ' +
                        '<p><i class="fa fa-eye">' + obj.views + '</i>' +
                        '<i class="fa fa-thumbs-o-up other">' + obj.likes + '</i>' +
                        '<i class="fa fa-comments-o other">22154</i>' +
                        '<i class="fa fa-clock-o other">2016-09-06</i>' +
                        '</p></a></li>';
                    textContainer.append(textLi);
                }

                function createDwonloadLi(obj) {
                    var downloadLi = '<li><h4><span>' +
                        '<img src="/img/upload/u=2020968545,2014670048&fm=21&gp=0.jpg"></span>' +
                        obj.title + '</h4>' +
                        '<p><i class="fa fa-eye">' + obj.views + '</i>' +
                        '<i class="fa fa-download other">' + obj.likes + '</i>' +
                        '<i class="fa fa-comments-o other">' + obj.likes + '</i>' +
                        '<i class="fa fa-clock-o other">' + obj.created_at.substring(0, 10) + '</i>' +
                        '</p></li>';
                    downloadContainer.append(downloadLi);
                }
            }
        });
    }
};


