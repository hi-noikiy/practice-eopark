$(document).ready(function () {
    new resources().main();
});
var resources = function () {
    var _this = this;

    this.main = function () {
        setSelectLogo();
        setSelectedFilter();
    };
    function setSelectedFilter() {
        var filterData = $("#filter-selected");
        if (filterData.length <= 0) {
            return;
        }
        var selected = JSON.parse(filterData.html().trim());
        var filterWarp = $(".filter-warp");
        var selectedLi;
        for (var x in selected) {
            selectedLi = filterWarp.find("li[data-id=" + selected[x] + "]");
            selectedLi.parent(".filter-warp").find(".no-select").attr("class", '');
            selectedLi.attr("class", "active");
        }
    }

    function setSelectLogo() {
        var href = location.href;
        if (href.indexOf('brand=') > 0) {
            $(".selector-value-item").css("border","2px solid #428bca");
        }

    }
};