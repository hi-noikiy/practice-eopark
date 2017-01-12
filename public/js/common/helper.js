var helper = function () {
    this.baiduSearch = function () {
        var inputBaidu = $("#input-baidu");
        var keyword = '';
        var btnBaidu = $("#btn-baidu");
        var baiduEnable = false;
        btnBaidu.click(function () {
            window.open("https://www.baidu.com/s?wd=" + keyword);
        });
        inputBaidu.focus(function () {
            baiduEnable = true;
        });
        document.onkeydown = function () {
            if (window.event && window.event.keyCode == 13) {
                keyword = inputBaidu.val();
                if (keyword != '' && baiduEnable) {
                    window.open("https://www.baidu.com/s?wd=" + keyword);
                    baiduEnable = false;
                }
                window.event.returnValue = false;
            }
        }
    }
};



