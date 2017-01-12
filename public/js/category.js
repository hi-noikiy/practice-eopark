$(document).ready(function () {
    new category().categoryListener();
});

window.onload = function () {
    new loadData().main();
};
var category = function () {
    var _this = this;
    (function () {
        _this.categoryContainer = $('.sub-container');
    })();
    this.categoryListener = function () {
        var depthDiv1, depthDiv2, depthDiv3,
            depthUls1, depthUls2, depthUls3,
            videoUls, textUls, downloadUls, uls,
            lastClick1, lastClick2, lastClick3,
            typeNames;
        var depth1Color = "#808080";
        var depth2Color = "#b3b3b3";
        var depth3Color = "#e6e6e6";

        depthDiv1 = $(".subclass-one");
        depthDiv2 = $(".subclass-two");
        depthDiv3 = $(".subclass-three");
        depthUls2 = $(".subclass-two>ul");
        depthUls3 = $(".subclass-three>ul");

        typeNames = ['video', 'text', 'download'];
        _this.categoryContainer.click(function (e) {
            var clickObj = $(e.target);
            var pid = clickObj.attr("id");
            var pDiv = clickObj.closest(".subclass");
            var depth = pDiv.attr("data-depth");
            var nextUl = _this.categoryContainer.find("ul[data-pid=" + pid + "]");
            if (depth == 1) {

                reset([depthDiv2, depthDiv3], [depthUls2, depthUls3], nextUl);
                setLastClick(1, pid);
                showNextDiv(depthDiv1, depthDiv2, 24);
                showResource(pid);
            } else if (depth == 2) {
                reset(depthDiv3, depthUls3, nextUl);
                setLastClick(2, pid);
                showNextDiv(depthDiv2, depthDiv3, 22);
                showResource(pid);
            } else if (depth == 3) {
                setLastClick(3, pid);
                showResource(pid);
            }
            function reset(divs, uls, nextUl) {
                for (var i = 0; i < uls.length; i++) {
                    $(uls[i]).hide();
                }
                for (var j = 0; j < divs.length; j++) {
                    $(divs[j]).hide();
                    if (j == 0) {
                        $(divs[j]).show();
                    }
                    $(divs[j]).css({"opacity": 0, "margin-top": "-10px"});
                }
                nextUl.show();
            }

            function setLastClick(depth, id) {
                var clicked = $(".sub-container li[id=" + id + "]");
                console.log(clicked);
                switch (depth) {
                    case 1:
                        clear([lastClick1, lastClick2, lastClick3], [depth1Color, depth2Color, depth3Color]);
                        lastClick1 = clicked;
                        lastClick1.css("background", depth2Color);

                        break;
                    case 2:
                        clear([lastClick2, lastClick3], [depth2Color, depth3Color]);
                        lastClick2 = clicked;
                        lastClick2.css('background', depth3Color);
                        break;
                    case 3:
                        clear([lastClick3], [depth3Color]);
                        lastClick3 = clicked;
                        lastClick3.css('background', "white");
                        break;
                }
                function clear(lastClicks, colors) {
                    for (var x in lastClicks) {
                        if (lastClicks[x] != undefined) {
                            lastClicks[x].css('background', colors[x]);
                        }
                    }
                }
            }


            function showNextDiv(lastDepth, nextDiv, number) {
                lastDepth.animate({"padding-left": number + "%", "padding-right": number + "%"});
                nextDiv.show();
                nextDiv.animate({"margin-top": "10px", "opacity": 1});
            }

            function showResource(id) {
                if (uls == undefined) {
                    videoUls = $('.video-container');
                    textUls = $('.text-container');
                    downloadUls = $('.download-container');
                    uls = [videoUls, textUls, downloadUls];
                }
                for (var x in uls) {
                    uls[x].animate({"opacity": 0});
                    uls[x].hide();
                }

                for (var y in typeNames) {
                    var typeUl = $('.' + typeNames[y] + '-container[data-id=' + id + ']');
                    typeUl.show();
                    typeUl.animate({"opacity": 1});
                }
            }
        })
    };
};


var loadData = function () {
    var _this = this;
    var MAX_NUMBER = 8;
    this.main = function () {

        _this.getData();
    };
    this.getData = function () {
        $.ajax({
            url: "/category/getResources",
            type: 'get',
            success: function (data) {
                console.log(data);
                var videoContainer = $(".category-video");
                var textContainer = $(".category-text");
                var downloadContainer = $(".category-download");
                var imgOnError = "/img/onError.jpg";
                var x, y, z, currentCategory, score;

                for (x in data) {
                    currentCategory = data[x].id;
                    var depth2 = data[x].next;
                    setType1Resource(data[x].resource.type1, data[x].id);
                    setType2Resource(data[x].resource.type2, data[x].id);
                    setType3Resource(data[x].resource.type3, data[x].id);
                    for (y in depth2) {
                        currentCategory = depth2[y].id;
                        var depth3 = depth2[y].next;
                        setType1Resource(depth2[y].resource.type1, depth2[y].id);
                        setType2Resource(depth2[y].resource.type2, depth2[y].id);
                        setType3Resource(depth2[y].resource.type3, depth2[y].id);
                        for (z in depth3) {
                            currentCategory = depth3[z].id;
                            setType1Resource(depth3[z].resource.type1, depth3[z].id);
                            setType2Resource(depth3[z].resource.type2, depth3[z].id);
                            setType3Resource(depth3[z].resource.type3, depth3[z].id);
                        }
                    }
                }
                function setType1Resource(resources, id) {
                    var resource;
                    var ulStr = '<ul class="video-container" data-id="' + id + '" style="display:none">';
                    if (resources.length > 0) {
                        for (var i in resources) {
                            resource = resources[i];
                            score = resource.score != 0 ? resource.score : "\\";
                            ulStr += '<li>' +
                                '<a href="/detail/' + resource.id + '">' +
                                '<img src="' + resource.cover + '" onerror="this.src=\'' + imgOnError + '\'">' +
                                '<div class="video-introduce">' +
                                '<h4>' + resource.title + '</h4>' +
                                '<p class="video-introduce-text">' + resource.introduce + '</p>' +
                                '<p><i class="glyphicon glyphicon-eye-open ">' + resource.views + '</i>' +
                                '<i class="glyphicon glyphicon-star other">' + score + '</i>' +
                                '<i class="glyphicon glyphicon-comment other">'+resource.comment_numbers+'</i>' +
                                '<i class="glyphicon glyphicon-time other">' + resource.updated_at.substring(0, 10) + '</i>' +
                                '</p></div></a></li>';
                        }
                        console.log(resources.length);

                        ulStr += addViewMoreBtn(resources.length);
                    } else {
                        ulStr += '<li><p class="not-found-resource">暂无资源</p></li>';
                    }
                    ulStr += '</ul>';
                    videoContainer.append(ulStr);
                }

                function setType2Resource(resources, id) {
                    var resource;
                    var ulStr = '<ul class="text-container" data-id="' + id + '" style="display:none">';
                    if (resources.length > 0) {
                        for (var i in resources) {
                            resource = resources[i];
                            score = resource.score != 0 ? resource.score : "\\";
                            ulStr += '<li>' +
                                '<a href="/detail/' + resource.id + '">' +
                                '<h4>' + resource.title + '</h4>' +
                                '<p><i class="glyphicon glyphicon-eye-open">' + resource.views + '</i>' +
                                '<i class="glyphicon glyphicon-star other">' + score + '</i>' +
                                '<i class="glyphicon glyphicon-comment other">'+resource.comment_numbers+'</i>' +
                                '<i class="glyphicon glyphicon-time other">' + resource.updated_at.substring(0, 10) + '</i>' +
                                '</p></a></li>';
                        }
                        ulStr += addViewMoreBtn(resources.length);
                    } else {
                        ulStr += '<li><p class="not-found-resource">暂无资源</p></li>';
                    }
                    ulStr += '</ul>';
                    textContainer.append(ulStr);
                }

                function setType3Resource(resources, id) {
                    var resource;

                    var ulStr = '<ul class="download-container category-download-introuduce" data-id="' + id + '" style="display:none">';
                    if (resources.length > 0) {
                        for (var i in resources) {
                            resource = resources[i];
                            score = resource.score != 0 ? resource.score : "\\";
                            ulStr += '<li>' +
                                '<a href="/detail/' + resource.id + '">' +
                                '<h4><span><img src="' + resource.cover + '" onerror="this.src=\'' + imgOnError + '\'">' +
                                '</span>' + resource.title + '</h4><p>' +
                                '<i class="glyphicon glyphicon-eye-open">' + resource.views + '</i>' +
                                '<i class="glyphicon glyphicon-star other">' + score + '</i>' +
                                '<i class="glyphicon glyphicon-comment other">'+resource.comment_numbers+'</i>' +
                                '<i class="glyphicon glyphicon-time other">' + resource.updated_at.substring(0, 10) + '</i>' +
                                '</p></a></li>';
                        }
                        ulStr += addViewMoreBtn(resources.length);
                    } else {
                        ulStr += '<li><p class="not-found-resource">暂无资源</p></li>';
                    }
                    ulStr += '</ul>';
                    downloadContainer.append(ulStr);
                }

                function addViewMoreBtn(dataLen) {
                    if (dataLen == MAX_NUMBER) {
                        return '<li class="more"><a href="/resources/' + currentCategory + '"><h4>查看更多</h4></a></li>';
                    } else {
                        return "";
                    }
                }
            }
        })
    }
};