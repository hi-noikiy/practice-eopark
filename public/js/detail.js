$(document).ready(function () {
    new detail().main();
});

var detail = function () {
    var _this = this;
    var token, commentTextarea, submitStatus, commentStatusDiv,
        pathName;
    this.main = function () {
        setListener();
        myStar();
    };
    function setListener() {
        var submitComment, commentLenObj, reply, commentLikes, commentMore,
            comment, jumpObj, jumpNotice, jumpProgress, link;
        (function __construct() {
            submitComment = $("#submit-comment");
            commentTextarea = $("#comment-textarea");
            commentLenObj = $("#comment-len");
            _this.token = $("#_token").val();
            _this.submitStatus = $("#submit-status-message");
            _this.commentStatusDiv = $(".comment-status");
            reply = $(".reply");
            commentLikes = $(".comment-likes");
            _this.pathName = window.location.pathname;
            jumpObj = $("#jump");
            jumpNotice = $("#jump-notice");
            jumpProgress = $("#jump-progress");
            link = $("#link").html().trim();
            commentMore = $('#comment-more');
        })();

        submitComment.click(function () {
            comment = commentTextarea[0].value;
            if (!comment) {
                return;
            } else if (comment.length > 140) {
                return;
            }
            console.log("开始异步提交...");
            submitCommentData();
        });

        commentTextarea.bind('input propertychange', function () {
            comment = commentTextarea[0].value;
            var commentLen = comment.length;
            if (commentLen > 140) {
                comment = comment.substring(0, 140);
                commentTextarea.val(comment);
                commentLenObj.html(140);
                commentLenObj.css("color", "red");
                setTimeout(function () {
                    commentLenObj.css("color", "black");
                    setTimeout(function () {
                        commentLenObj.css("color", "red");
                        setTimeout(function () {
                            commentLenObj.css("color", "black");
                        }, 400);
                    }, 400);
                }, 400);
                return
            }
            commentLenObj.html(commentLen);
        });


        commentLikes.click(function () {
            var presentColor = $(this).css("color");
            var likes = parseInt($(this).html().trim());
            if (presentColor == "rgb(255, 0, 0)") {
                $(this).css("color", "rgb(0, 0, 0)");
                likes--;
            } else {
                $(this).css("color", "rgb(255, 0, 0)");
                likes++;
            }
            $(this).html(likes);
            var commentId = $(this).parent("p").attr("data-comment-id");
            changeLikesStatus(this, commentId);
        });

        reply.click(function () {
            var commentId = $(this).parent().attr("data-comment-id");
            var userName = $(".user-name[data-id=" + commentId + "]").html();
            var replayText = '@' + userName + ': ';
            var replayLength = replayText.length;
            commentTextarea.val(replayText);
            commentLenObj.html(replayLength);
            commentTextarea.focus();
        });

        $('#res-feedback').click(function () {
            var __this = $(this);
            $resId = __this.attr("data-res-id");
            $.ajax({
                url: "/feedback/invalid/" + $resId,
                type: 'get',
                success: function (data) {
                    __this.tooltip('show');
                    setTimeout(function () {
                        __this.tooltip('hide');
                    }, 3000)
                }
            })
        });

        $("#collect").click(function () {
            var __this = $(this);
            $resId = __this.attr("data-res-id");
            __this.attr();
            $.ajax({
                url: "/my/collect/add/" + $resId,
                type: 'get',
                success: function () {
                    __this.tooltip('show');
                    setTimeout(function () {
                        __this.tooltip('hide');
                    }, 3000)
                }
            })
        });

    }

    function submitCommentData() {
        var data = commentTextarea[0].value;
        var url = _this.pathName + "/addComment";
        data = "comment=" + encodeURIComponent(data);
        $.ajax({
            data: data,
            type: "get",
            url: url,
            success: function (data) {
                if (data == 'NOT_LOGIN') {
                    window.location.href = "/login";
                    return;
                }
                _this.commentStatusDiv.css("background", "darkgreen");
                _this.submitStatus.html("评论成功");
                clearStatus();
            },
            error: function () {
                _this.submitStatus.css("background", "red");
                _this.submitStatus.html("评论失败,异常错误.");
                clearStatus();
            }
        });
        function clearStatus() {
            setTimeout(function () {
                _this.commentStatusDiv.css("background", "white");
                _this.submitStatus.html("");
            }, 3000);
        }
    }

    function changeLikesStatus(obj, commentId) {
        var url = _this.pathName + "/changeLikesStatus/" + commentId;
        $.ajax({
            type: "get",
            url: url,
            success: function (data) {
                if (data === "NOT_LOGIN") {
                    window.location.href = "/login";
                }
            },
        });
    }

    function myStar() {
        var oStar = document.getElementById("star");
        var aLi = oStar.getElementsByTagName("li");
//            var oUl = oStar.getElementsByTagName("ul")[0];
//            var oSpan = oStar.getElementsByTagName("span")[1];
//            var oP = oStar.getElementsByTagName("p")[0];
        var url = window.location.pathname;
        var i = iScore = iStar = 0;
//            var aMsg = [
//                "很不满意|差得太离谱，与卖家描述的严重不符，非常不满",
//                "不满意|部分有破损，与卖家描述的不符，不满意",
//                "一般|质量一般，没有卖家描述的那么好",
//                "满意|质量不错，与卖家描述的基本一致，还是挺满意的",
//                "非常满意|质量非常好，与卖家描述的完全一致，非常满意"
//            ]

        for (i = 1; i <= aLi.length; i++) {
            aLi[i - 1].index = i;
            //鼠标移过显示分数
            aLi[i - 1].onmouseover = function () {
                fnPoint(this.index);
                //浮动层显示
//                    oP.style.display = "block";
                //计算浮动层位置
//                    oP.style.left = oUl.offsetLeft + this.index * this.offsetWidth - 104 + "px";
                //匹配浮动层文字内容
//                    oP.innerHTML = "<em><b>" + this.index + "</b> 分 " + aMsg[this.index - 1].match(/(.+)\|/)[1] + "</em>" + aMsg[this.index - 1].match(/\|(.+)/)[1]
            };
            //鼠标离开后恢复上次评分
            aLi[i - 1].onmouseout = function () {
                fnPoint();
                //关闭浮动层
//                    oP.style.display = "none"
            };
            //点击后进行评分处理
            aLi[i - 1].onclick = function () {
                iStar = this.index;
                $.ajax({
                    type: "get",
                    url: url + "/changeGrade/" + iStar * 2,
                    success: function (data) {
                        if (data == 'NOT_LOGIN') {
                            window.location.href = "/login";

                        }
                    },
                    error: function () {
                    }
                });
//                    oP.style.display = "none";
//                    oSpan.innerHTML = "<strong>" + (this.index*2) + " 分</strong> ";
//                    oSpan.innerHTML = "<strong>" + (this.index) + " 分</strong> (" + aMsg[this.index - 1].match(/\|(.+)/)[1] + ")"
            }
        }
        //评分处理
        function fnPoint(iArg) {
            //分数赋值
            iScore = iArg || iStar;
            for (i = 0; i < aLi.length; i++) aLi[i].className = i < iScore ? "on" : "";
        }
    }


};