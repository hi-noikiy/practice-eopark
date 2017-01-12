$(document).ready(function () {
    setListener();
});

function setListener() {
    var whichForm;
    var formData;
    var url;
    var formType;
    var submitBtn = ".login-footer button";
    $(submitBtn).click(
        function () {
            submit()
        }
    );

    $("#register input[type=checkbox]").change(function () {
        //判断两次密码是否输入一致
        if (!$(this).is(':checked')) {
            $(submitBtn).unbind();
            $(submitBtn).css("background", "darkgray");

        } else {
            $(submitBtn).css("background", "#428bca");
            $(submitBtn).bind("click", function () {
                submit();
            });
        }
    });

    function submit() {
        //获取当前是注册还是登录
        whichForm = $("#myTab li[class=active]");
        formType = whichForm.attr("data-id");

        if (formType == "login") {
            formData = $("#login form").serialize();
            url = "/auth/1";

        } else if (formType == "register") {
            formData = $("#register form").serialize();
            url = "/auth/0";
        }
        postData(url, formData);
    }

    function postData(url, postData) {
        $.ajax({
            type: 'POST',
            url: url,
            data: postData,
            success: function (data) {
                console.log(data);
            },
            error: function (data) {
                console.log(data);
            }
        });
    }


}