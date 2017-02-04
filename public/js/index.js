/**
 * Created by Qskane_Thinkpad on 2016/10/9.
 */

$(document).ready(function () {
    setTime();
    var isMoving = false;
    var modalShowing = false;

    ko.components.register('dashboard-grid', {
        viewModel: {
            createViewModel: function (controller, componentInfo) {
                var ViewModel = function (controller, componentInfo) {
                    var grid = null;
                    this.widgets = controller.widgets;
                    this.afterAddWidget = function (items) {
                        if (grid == null) {
                            grid = $(componentInfo.element).find('.grid-stack').gridstack({
                                auto: false
                            }).data('gridstack');
                        }
                        var item = _.find(items, function (i) {
                            return i.nodeType == 1
                        });
                        grid.addWidget(item);
                        grid.movable('.grid-stack-item', false);
                        ko.utils.domNodeDisposal.addDisposeCallback(item, function () {
                            grid.removeWidget(item);
                        });
                    };
                };
                return new ViewModel(controller, componentInfo);
            }
        },
        template: [
            '<div class="grid-stack" data-bind="foreach: {data: widgets, afterRender: afterAddWidget}" >',
            '   <div class="grid-stack-item my-grid-stack-item"  data-gs-no-resize="true"  data-gs-max-height="4" data-gs-min-width="2"  data-bind="attr: {\'data-gs-x\': $data.x, \'data-gs-y\': $data.y, \'data-gs-width\': $data.width, \'data-gs-height\': $data.height, \'data-gs-auto-position\': $data.auto_position, \'data-gs-href\': $data.url,\'data-gs-id\': $data.id,\'data-gs-name\': $data.url_name}">',
            '     <div class="grid-stack-item-content" data-bind="click:$root.jump"><div class="function"><i data-bind="click:$root.edit_widget,clickBubble: false"    class="glyphicon glyphicon-edit grid-edit"  title="更改"></i><i class="glyphicon glyphicon-remove grid-delete" data-bind="click: $root.delete_widget" title="删除"></i></div><div class="grid-title"><img  onerror=\'this.src="/img/onError.ico"\' class="grid-icon" data-bind="attr:{\'src\': \'http://favicon.byi.pw/?url=\'+$data.url}" ><span class="grid-name" data-id="$data.id" data-bind="text:$data.url_name"></span></div></div>',
            // '     <div class="grid-stack-item-content" data-bind="click:$root.jump"><div class="function"><i data-bind="click:$root.edit_widget,clickBubble: false"    class="glyphicon glyphicon-edit grid-edit"  title="更改"></i><i class="glyphicon glyphicon-remove grid-delete" data-bind="click: $root.delete_widget" title="删除"></i></div><div class="grid-title"><img  onerror=\'this.src="/img/onError.ico"\' class="grid-icon" data-bind="attr:{\'src\': \'http://www.google.com/s2/favicons?domain=\'+$data.url}" ><span class="grid-name" data-id="$data.id" data-bind="text:$data.url_name"></span></div></div>',
            '   </div>',
            '</div> '
        ].join('')
    });
    $(function () {
        var Controller = function (widgets) {
            var self = this;
            var inputId = $("#input-id");
            var inputName = $("#input-name");
            var inputHref = $("#input-href");
            var myModalLabel = $("#myModalLabel");
            var endMoveBtn = $("#endMoveBtn");
            var myModal = $("#myModal");
            var prepareDeleteIds = '';
            var widgetId, widgetName, widgetHref, grid, gridFunction, gridItemContent, gridItem;
            var nameError = false;
            var urlError = false;
            this.widgets = ko.observableArray(widgets);
            this.submit = function (item) {
                modalShowing = false;
                if (inputName.val().length > 32) {
                    nameError = true;
                    var popoverName = $("#popover-name");
                }
                // if (inputHref.val().length > 1) {
                //     urlError = true;
                //     var popoverUrl = $("#popover-url");
                // }
                if (nameError && urlError) {
                    clearPopoverError();
                    popoverName.popover('show');
                    popoverUrl.popover('show');
                    setTimeout(function () {
                        popoverName.popover('hide');
                        popoverUrl.popover('hide');
                    }, 3000);
                    return;
                } else if (nameError && !urlError) {
                    clearPopoverError();
                    popoverName.popover('show');
                    setTimeout(function () {
                        popoverName.popover('hide');
                    }, 3000);
                    return;
                } else if (!nameError && urlError) {
                    clearPopoverError();
                    popoverUrl.popover('show');
                    setTimeout(function () {
                        popoverUrl.popover('hide');
                    }, 3000);
                    return;
                }
                function clearPopoverError() {
                    nameError = false;
                    urlError = false;
                }

                myModal.modal("hide");
                var formData = $("#myModal form").serialize();
                var id = inputId.val();
                if (id != 0) {
                    var currentItem = $(".my-grid-stack-item[data-gs-id=" + id + "]");
                    currentItem.attr("data-gs-name", inputName.val());
                    currentItem.attr("data-gs-href", inputHref.val());
                    currentItem.find("span").last().html(inputName.val());
                    console.log(formData);
                    $.ajax({
                        url: "/index/edit/",
                        data: formData,
                        type: 'get',
                        success: function (url) {
                            currentItem.attr("data-gs-href", url);
                        }
                    });
                } else {
                    $.ajax({
                        url: "/index/add",
                        data: formData,
                        type: 'get',
                        success: function (data) {
                            console.log(data);
                            self.widgets.push({
                                x: 0,
                                y: 0,
                                width: 2,
                                height: 1,
                                auto_position: true,
                                id: data.id,
                                url_name: data.url_name,
                                url: data.url
                            });
                            var newGrid = $(".my-grid-stack-item[data-gs-id=" + data.id + "]");
                            $.ajax({
                                url: '/index/updatePosition/' + data.id + "/" +
                                newGrid.attr("data-gs-x") + "/" + newGrid.attr("data-gs-y"),
                                type: "get",
                            });
                        }
                    });
                }
            };
            this.add_new_widget = function () {
                myModalLabel.html("添加");
                inputId.val('0');
                inputName.val('');
                inputHref.val('');
                inputName.focus();
                modalShowing = true;
            };
            this.edit_widget = function (item) {
                myModalLabel.html('更改');
                widgetId = self.getCurrentGrid(item, ".my-grid-stack-item").attr('data-gs-id');
                widgetName = self.getCurrentGrid(item, ".my-grid-stack-item").attr('data-gs-name');
                widgetHref = self.getCurrentGrid(item, ".my-grid-stack-item").attr('data-gs-href');
                inputId.val(widgetId);
                inputName.val(widgetName);
                inputHref.val(widgetHref);
                myModal.modal("show");
                modalShowing = true;

            };
            this.delete_widget = function (item) {
                if (prepareDeleteIds == '') {
                    prepareDeleteIds += item.id;
                } else {
                    prepareDeleteIds += '_' + item.id;
                }

                self.widgets.remove(item);
            };

            this.startMove = function () {
                gridFunction = $(".function");
                grid = $('.grid-stack').gridstack({
                    auto: false
                }).data('gridstack');
                grid.resizable('.grid-stack-item', true);

                grid.movable('.grid-stack-item', true);
                gridFunction.show();
                gridItemContent = $('.grid-stack-item-content');
                gridItemContent.css({'cursor': 'move', 'box-shadow': '10px 10px 3px rgba(142,142,142,0.5)'});


                $(".function i").css('cursor', 'pointer');
                endMoveBtn.show();
                isMoving = true;
                console.log("startMove");

            };
            this.endMove = function () {
                gridItemContent.css({'cursor': 'pointer', 'box-shadow': 'none'});
                grid.movable('.grid-stack-item', false);
                var myGridItems = $(".my-grid-stack-item");
                grid.resizable('.grid-stack-item', false);
                if (myGridItems.length > 0) {
                    var doneData = {};
                    for (var i = 0; i < myGridItems.length; i++) {
                        var itemData = {};
                        var itemObj = $(myGridItems[i]);
                        itemData.id = itemObj.attr("data-gs-id");
                        itemData.x = itemObj.attr("data-gs-x");
                        itemData.y = itemObj.attr("data-gs-y");
                        itemData.width = itemObj.attr("data-gs-width");
                        itemData.height = itemObj.attr("data-gs-height");
                        doneData[i] = itemData;
                    }
                    doneData["_token"] = $("#_token").val();
                    console.log(doneData);
                    $.ajax({
                        url: "/index/move",
                        data: $.parseJSON(JSON.stringify(doneData)),
                        type: "post",
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                        }
                    });

                }

                if (prepareDeleteIds != '') {
                    $.ajax({
                        type: "get",
                        url: "/index/delete/" + prepareDeleteIds,
                        success: function () {
                            prepareDeleteIds = '';
                        }
                    });
                }
                gridFunction.hide();
                endMoveBtn.hide();
                isMoving = false;
            };
            this.jump = function (item) {
                if (!isMoving) {
                    var url = self.getCurrentGrid(item, ".my-grid-stack-item").attr('data-gs-href');
                    console.log(url);
                    window.open(url);
                }
            };

            this.getCurrentGrid = function (item, className) {
                var index = ko.contextFor(event.target).$index();
                return $($(className)[index]);
            }
        };
        var jsonData = $("#json-data");
        var widgets = JSON.parse(jsonData.html().trim());
        var controller = new Controller(widgets);
        ko.applyBindings(controller);
    });

    $('#myModal').on('shown.bs.modal', function (e) {
        $("#input-name").focus();
    });


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
            if (modalShowing) {
                $("#modal-submit").trigger("click");
            } else {
                keyword = inputBaidu.val();
                if (keyword != '' && baiduEnable) {
                    window.open("https://www.baidu.com/s?wd=" + keyword);
                    baiduEnable = false;
                }
                window.event.returnValue = false;
            }
        }
    }
});


function setTime() {
    var today = new Date();
    var h = 23 - today.getHours();
    var m = 59 - today.getMinutes();
    h = checkTime(h);
    m = checkTime(m);
    $('#day-left').html("今日剩余:" + h + "时" + m + "分");
    var percent = countTimeLeftPercent();
    $("#bg-have").css("width", percent * 100 + "%");
    $("#bg-pass").css("width", (1 - percent) * 100 + "%");
    var secondLeft = (today.getSeconds() + 1) / 60;
    $("#bg-pass-pass").css("width", (secondLeft.toFixed(2)) * 100 + "%");
    setTimeout('setTime()', 1000);
    function checkTime(i) {
        if (i < 10) {
            i = "0" + i
        }
        return i
    }
    function countTimeLeftPercent() {
        var left = parseInt(h) * 60 + parseInt(m);
        var per = left / 1440;
        return per.toFixed(4);
    }
}


