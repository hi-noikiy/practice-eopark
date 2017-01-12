/**
 * Created by Qskane_Thinkpad on 2016/10/1.
 */
$(document).ready(function () {
    new Thanksgiving().main();
});
var Thanksgiving = function () {
    var _this = this;
    this.main = function () {
        setListener();
        setPropData();
    };

    function setListener() {
        var uploader,
            thanksForm, givingForm,
            givingCategory1, givingCategory2, givingCategory3,introduce,coverLink,
            title, link, author, introuduce, imgPrivew,
            isSelectImg,
            thanksFlip, givingFlip,
            thanksHeightTable, thanksPieTable,
            givingHeightTable, givingPieTable,
            fontIcon,
            propOk, propTheadTr, noProp, formProperty;
        (function _construct() {
            asynUploadImg();
            givingForm = $("#giving-form");
            thanksForm = $("#thanks-form");
            givingCategory1 = $("#category1");
            givingCategory2 = $('#category2');
            givingCategory3 = $('#category3');
            introduce = $("#introduce");
            imgPrivew = $("#filelist");
            title = $("input[name=title]");
            link = $("input[name=link]");
            coverLink = $("#cover_link");
            author = $("input[name=author]");
            introuduce = $("textarea[name=introuduce]");
            isSelectImg = 0;
            thanksFlip = $(".thanks-flip");
            givingFlip = $(".giving-flip");
            thanksHeightTable = $('#thanks-height-container');
            thanksPieTable = $('#thanks-pie-container');
            givingHeightTable = $('#giving-height-container');
            givingPieTable = $('#giving-pie-container');
            fontIcon = $("#giving-more i");
            propTheadTr = $("#prop-thead-tr");
            propOk = $(".prop-ok");
            noProp = $("#no-prop");
            formProperty = $("#form-property");
        })();
        $("#thanks-submit").click(function () {
            if (checkThanksForm()) {
                var url = "/thanksgiving/addThanks";
                var data = decodeURIComponent(thanksForm.serialize());
                ajaxSubmitThanks(url, data);
            }
        });
        $("#giving-more").click(function () {
            if (fontIcon.attr("class") == "glyphicon glyphicon-chevron-up") {
                fontIcon.attr("class", "glyphicon glyphicon-chevron-down");
            } else {
                fontIcon.attr("class", "glyphicon glyphicon-chevron-up");
            }
        });

        $("#giving-submit").click(function () {
            if (checkGivingForm()) {
                if (isSelectImg) {
                    uploader.start();
                } else {
                    var data = decodeURIComponent(givingForm.serialize()) + "&cover=0";
                    var url = "/thanksgiving/addResource";
                    ajaxSubmitGiving(url, data);
                }
            }
        });

        $("#btn-add-prop").click(function () {
            var category1, category2, category3,
                categoryName1, categoryName2, categoryName3,
                categoryId, radioTr;
            var propRadio = $('.prop_radio');
            var propRadios = propRadio.parents("tr");
            noProp.hide();
            propTheadTr.hide();
            category1 = $(".category-depth-1[name=category_1] option:selected");
            categoryName1 = category1.html();
            var categoryChain = '';
            if (categoryName1 != '未选择') {
                categoryChain += categoryName1;
                categoryId = category1.val();
                category2 = $(".category-depth-2[name=category_2] option:selected");
                categoryName2 = category2.html();
                if (categoryName2 != '未选择') {
                    categoryChain += ' / ' + categoryName2;
                    categoryId = category2.val();
                    category3 = $(".category-depth-3[name=category_3] option:selected");
                    categoryName3 = category3.html();
                    if (categoryName3 != '未选择') {
                        categoryChain += ' / ' + categoryName3;
                        categoryId = category3.val();
                    }
                }
            }
            if (categoryId != undefined) {
                $("#propModalLabel").html(categoryChain);
                resetRadio();
            } else {
                noProp.show();
            }
            function resetRadio() {
                propRadios.hide();

                radioTr = propRadio.parent("div[data-cate-id=" + categoryId + "]").parents('tr');
                radioTr.show();
                if (radioTr.length > 0) {
                    propTheadTr.show();
                } else {
                    noProp.show();
                }
                var tempRadio;
                for (var x in propRadios) {
                    tempRadio = propRadios[x];
                    if (tempRadio.checked) {
                        tempRadio.checked = false;
                    }
                }
            }

        });

        $("#modal-submit").click(function () {
            var checkBoxes = $("input[class=prop_radio]");
            var checkedIds = "";
            for (var k in checkBoxes) {
                if (checkBoxes[k].checked) {
                    checkedIds = checkedIds ? checkedIds + '-' + checkBoxes[k].value : checkBoxes[k].value;
                }
            }
            formProperty.val(checkedIds);
            propOk.show();
            $('#propModal').modal('hide');
        });

        function checkThanksForm() {
            var errorDom = $("#thanks-error");
            var gratitude = $("textarea[name=gratitude]").val().trim();
            var message;
            if (!gratitude) {
                errorDom.html("请至少填写一项");
                errorDom.show();
                setTimeout(function () {
                    errorDom.hide();
                }, 5000);
                return false;
            } else if (gratitude.length > 140) {
                message = "感谢寄语";
            }
            if (message) {
                message = "错误:您的" + message + "超过140字";
                errorDom.html(message);
                errorDom.show();
                setTimeout(function () {
                    errorDom.hide();
                }, 5000);
                return false;
            }
            return true;
        }

        function checkGivingForm() {
            var errorDom = $("#giving-error");
            errorDom.html("");
            var errorMessage = "";
            var titleLen = $("input[name=title]").val().trim().length;
            if (titleLen == 0) {
                errorMessage += " <标题为空> ";
            }
            if (titleLen > 50) {
                errorMessage += " <标题大于50个字符> "
            }
            if ($("input[name=link]").val().trim().length == 0) {
                errorMessage += " <链接为空> ";
            }
            // if ($("select[name=category1]").val() == 0) {
            //     errorMessage += " <分类> ";
            // }
            // if(isSelectImg == 0 ){
            //     errorMessage += "封面";
            // }
            if (errorMessage != "") {
                errorDom.html("错误:" + errorMessage);
                errorDom.show();
                return false
            } else {
                errorDom.hide();
                return true
            }
        }

        function ajaxSubmitThanks(url, data) {
            $.ajax({
                data: data,
                type: "get",
                url: url,
                success: function (tableData) {
                    var successDom = $("#thanks-success");
                    successDom.html("提交成功");
                    successDom.show();
                    heightCharts(givingHeightTable, tableData);
                    pieChart(givingPieTable, tableData);
                    setTableStyle("#60aff4");
                    flip(givingFlip);
                    setTimeout(function () {
                        successDom.hide();
                    }, 5000);
                }
            });
        }

        function ajaxSubmitGiving(url, data) {
            $.ajax({
                data: data,
                type: "get",
                url: url,
                success: function (tableData) {
                    console.log(tableData);
                    title.val("");
                    link.val("");
                    coverLink.val("");
                    $("#category-null").attr("selected", true);
                    givingCategory2.html("");
                    givingCategory2.hide();
                    givingCategory3.html("");
                    givingCategory3.hide();
                    introduce.val("");
                    var successDom = $("#giving-success");
                    successDom.html("提交成功,感谢你的贡献.");
                    successDom.show();
                    setTimeout(function () {
                        successDom.hide();
                    }, 5000);
                    heightCharts(thanksHeightTable, tableData);
                    pieChart(thanksPieTable, tableData);
                    setTableStyle("tomato");
                    flip(thanksFlip);
                }
            });
        }


        function flip(aFlip) {
            var i = 0;

            function flipFn(arg1, arg2) {
                aFlip.eq(i).toggleClass('card-flipped');
                i++;
                if (i == 1) {
                    return 0;
                }
            }

            setInterval(flipFn, 500);
        }

        //异步上传图片
        function asynUploadImg() {
            var _token = $("#_token").val();
            uploader = new plupload.Uploader({
                runtimes: 'html5,flash,silverlight,html4',
                browse_button: 'a-upload', // you can pass an id...
                // container: document.getElementById('container'), // ... or DOM Element itself
                url: '/thanksgiving/uploadImg?_token=' + _token,
                flash_swf_url: '/public/js/lib/plupload//Moxie.swf',
                silverlight_xap_url: '/public/js/lib/plupload/Moxie.xap',
                init: {
                    PostInit: function () {
                        console.log("PostInit");
                        document.getElementById('giving-submit').onclick = function () {
                            console.log("startUpload");
                            return false;
                        };
                    },
                    FilesAdded: function (up, files) {
                        isSelectImg = 1;
                        var img = new o.Image();
                        img.onload = function () {
                            var li = document.createElement('li');
                            li.id = this.uid;
                            $("#filelist").html(li);
                            this.embed(li.id, {
                                width: 30,
                                height: 30,
                                crop: true,
                                swf_url: o.resolveUrl(up.getOption('swf_url'))
                            });
                        };
                        img.onerror = function () {
                            alert('Error');
                        };
                        console.log(files[0].getSource());
                        img.load(files[0].getSource());
                    },

                    // UploadProgress: function(up, file) {
                    //     document.getElementById("a-upload").innerHTML = '<span>' + file.percent + "%</span>";
                    // },
                    FileUploaded: function (up, file, result) {
                        var data = decodeURIComponent(givingForm.serialize()) + "&cover=" + result.response;
                        var url = "/thanksgiving/addResource";
                        ajaxSubmitGiving(url, data);
                    },

                    Error: function (up, err) {
                        document.getElementById('showImgName').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
                    }
                }
            });
            uploader.init();
        }//asynUploadImg()

        function setTableStyle(bgColor) {
            $("rect[class=highcharts-background]").attr("fill", bgColor);
            $("tspan").attr("fill", "white");
            $(".highcharts-yaxis text").css("fill", "white");
            $("text[class=highcharts-credits]").hide();
        }
    }

    function setPropData() {
        var propData = $("#prop_data").html().trim();
        propData = JSON.parse(propData);
        console.log(propData);
        var propHtml = '';
        var values;
        for (var x in propData) {
            values = propData[x].values;
            propHtml += '<tr ><td>' + propData[x].prop_name + '</td><td class="td-value">';
            for (var y in values) {
                propHtml += '<div class="radio" data-cate-id="' + values[y].category_id + '">' +
                    '<input class="prop_radio" type="radio" name="prop_group_' + values[y].prop_id + '" id="radio' + values[y].prop_value_id + '" value="' + values[y].prop_value_id + '">' +
                    '<label for="radio' + values[y].prop_value_id + '">' + values[y].prop_value_name + '</label></div>';
            }
            propHtml += '</td></tr>';
        }
        $("#properties-warp tbody").append(propHtml);
    }

    //柱状图
    function heightCharts(container, data) {
        var chart = {
            type: 'column'
        };
        var title = {
            text: '资源规模Top10(测试)'
        };
        var subtitle = {
            text: 'Source: eopark.com'
        };
        var xAxis = {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            crosshair: true
        };
        var yAxis = {
            min: 0,
            title: {
                text: '资源量/个'
            }
        };
        var tooltip = {
            headerFormat: '<span style="font-size:20px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0; font-size:10px">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        };
        var plotOptions = {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        };
        var credits = {
            enabled: false
        };

        var series = [{
            name: '截止上月数据',
            data: [86, 71.5, 70, 68, 63, 62, 60, 58, 55, 52],
            color: 'rgb(228, 211, 84)'
        }, {
            name: '本月新增数据',
            data: [50, 45, 44, 40, 38, 35, 35, 20, 10, 5],
            color: 'rgb(144, 237, 125)'
        }];
        var json = {};
        json.chart = chart;
        json.title = title;
        json.subtitle = subtitle;
        json.tooltip = tooltip;
        json.xAxis = xAxis;
        json.yAxis = yAxis;
        json.series = series;
        json.plotOptions = plotOptions;
        json.credits = credits;
        container.highcharts(json);
    }

    //饼状图
    function pieChart(container, data) {
        var chart = {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        };
        var title = {
            text: '该分类用户贡献比例(测试)'
        };
        var tooltip = {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        };
        var plotOptions = {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}%</b>: {point.percentage:.1f} %',
                    style: {
                        color: "white" || 'white'
                        //color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        };
        var series = [{
            type: 'pie',
            name: 'Browser share',
            data: [
                ['Firefox', 15],
                ['IE', 18],
                {
                    name: 'Chrome',
                    y: 10,
                    sliced: true,
                    selected: true
                },
                ['Safari', 17],
                ['Opera', 10],
                ['Others', 10],
                ['Others', 10],
                ['Others', 5],
                ['Others', 18],
                ['Others', 8]
            ]
        }];
        var json = {};
        json.chart = chart;
        json.title = title;
        json.tooltip = tooltip;
        json.series = series;
        json.plotOptions = plotOptions;
        container.highcharts(json);
    }


};



