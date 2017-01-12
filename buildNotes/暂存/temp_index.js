
//
// function setClickListener() {
//     var tools = new Tools();
//     var folderId;
//     var editFolderId;
//     var nevUlId;
//     var folderChildren;
//     var isRefresh = false;
//     var formData;
//
//     tools.showHideNev($(".folder-name .fa-caret-down"));
//     tools.showHideNev($(".folder-name .fa-caret-right"));
//     dialog();
//
//     $("#dialog-submit").click(function () {
//         editFolderId = tools.editFolderId;
//         dialogSubmit()
//     });
//     $('#myModal').on('hidden.bs.modal', function () {
//         $(".modal-footer h4").hide();
//         var modalInputs = $("#myModal input");
//         modalInputs.each(function (i) {
//             modalInputs[i].value = "";
//         })
//     });
//
//
//     function dialogSubmit() {
//
//         var addHid = !$(".dialog-add").is(":hidden");
//         var editHid = !$(".dialog-edit").is(":hidden");
//         var folderHid = !$(".dialog-folder").is(":hidden");
//         var remind = $(".modal-footer h4");
//
//         if (addHid && !editHid && !folderHid) {
//             var formData = $(".dialog-add form").serialize();
//             $.ajax({
//                 type: 'get',
//                 url: "/index/addNev",
//                 data: formData,
//                 success: function (data) {
//                     console.log(data);
//                     var copyLi = "<li  data-id='" + data.id + "' class='nev-ul-li' data-href='" + data.url + "' data-title='" + data.url_name + "'><a href='" + data.url + "' target='_blank'><p>" + data.url_name + "</p></a></li>";
//                     $("#nev-ul-" + data["folder_id"]).append(copyLi);
//                     remind.html("<i class='fa fa-smile-o fa-lg'></i> 提交成功,您可以继续添加或关闭");
//                     remind.show();
//                     setTimeout(function () {
//                         remind.hide();
//                     }, 2400);
//                 },
//                 error: function () {
//                     remind.html("<i class='fa fa-frown-o fa-lg'></i> 提交失败,您的网络或服务器故障.");
//                     remind.show();
//                 }
//             });
//         } else if (!addHid && editHid && !folderHid) {
//
//             formData = tools.getEditFormData();
//
//             // formData = tools.getFormData(".dialog-edit");
//             // console.log(formData);
//             // return;
//             formData.folderId = parseInt(editFolderId);
//
//             console.log(formData);
//             $.ajax({
//                 type: 'POST',
//                 url: "/index/editNev",
//                 data: formData,
//                 dataType: "json",
//                 success: function (data) {
//                     console.log('-----------');
//                     console.log(data);
//                     for (var i = 0; i < data.createIds.length; i++) {
//                         var urlName = data.createIds[i].url_name;
//                         var eachLiObj = $(folderChildren[i]);
//                         eachLiObj.attr({
//                             "data-href": data.createIds[i].url,
//                             "data-id": data.createIds[i].id,
//                             "data-title": urlName
//                         });
//                         eachLiObj.find("a").attr("href", data.createIds[i].url);
//                         eachLiObj.find("p").html(urlName);
//                     }
//                     if (data.movedIds.length != 0) {
//                         for (var key in data.movedIds) {
//                             $("#nev-ul-" + data.movedIds[key]).append(folderChildren[key]);
//                         }
//                     }
//                     remind.html("<i class='fa fa-smile-o fa-lg'></i> 提交成功");
//                     remind.show();
//                     setTimeout(function () {
//                         remind.hide();
//                     }, 2400);
//                 },
//                 error: function () {
//                     remind.html("<i class='fa fa-frown-o fa-lg'></i> 提交失败,您的网络或服务器故障.");
//                     remind.show();
//                 }
//             });
//
//         } else if (!addHid && !editHid && folderHid) {
//             formData = tools.getFormData(".dialog-folder");
//             console.log(formData);
//             $.ajax({
//                 type: 'post',
//                 url: "/index/folder",
//                 data: formData,
//                 success: function (data) {
//                     console.log(data);
//                     var folderNames = $(".folder-div .folder-name");
//                     // for (var i = 0; i < Object.keys(data).length; i++) {
//                     //     $(folderNames[i]).attr("data-folder-name", data[i].id.folder_name);
//                     //     $(folderNames[i]).html("<i class='fa fa-caret-down fa-lg'></i><i class='fa fa-caret-right fa-lg'></i>" + data[i].id.folder_name);
//                     // }
//                     var folderDiv = $(".folder-div");
//                     var parentDiv = $(".user-nev");
//                     for (var i = 0; i < Object.keys(data).length; i++) {
//
//                         var cloneDiv = $(folderDiv).first().clone(true);
//                         var folderId = data[i].id.id;
//                         var folderNameText = data[i].id.folder_name;
//                         parentDiv.append(cloneDiv);
//                         var folderNameDiv = $(".folder-div .folder-name").last();
//                         folderNameDiv.html("<i class='fa fa-caret-down fa-lg'></i><i class='fa fa-caret-right fa-lg'></i>" + folderNameText);
//                         folderNameDiv.attr({"data-folder-id": folderId, "data-folder-name": folderNameText});
//                         var menuLis = $(folderNameDiv).parent().find(".dropdown-menu li");
//                         var setId = "nev-ul-" + folderId;
//                         for (var j = 0; j < menuLis.length; j++) {
//                             $(menuLis[j]).attr("data-ul-id", setId);
//                         }
//                         $(".folder-div >ul").last().attr("id", setId);
//                         var ulLis = $("#" + setId + " li");
//                         for (var k = 0; k < ulLis.length; k++) {
//                             ulLis[k].remove();
//                         }
//                         $("#" + setId).append("<li class='first-add' data-toggle='modal' data-target='#myModal'> <p><i class='fa fa-plus-square fa-2x'> </i></p> </li> ");
//                         $("#" + setId + " li").click(function () {
//                             var clickId = parseInt($(this).parent().attr("id").replace(/[^0-9]+/g, ''));
//                             tools.clear();
//                             tools.addHandler(clickId);
//                         });
//
//                         var option = "<option value='" + folderId + "'>" + folderNameText + "</option>";
//                         var selects = $("select[name=groupId]");
//                         for (var m = 0; m < selects.length; m++) {
//                             $(selects[m]).append(option);
//                         }
//                     }
//                     tools.showHideNev($(".folder-name .fa-caret-down"));
//                     tools.showHideNev($(".folder-name .fa-caret-right"));
//                     remind.html("<i class='fa fa-smile-o fa-lg'></i> 提交成功");
//                     remind.show();
//                     setTimeout(function () {
//                         remind.hide();
//                     }, 2400);
//                 },
//                 error: function (data) {
//                     console.log(data)
//                     remind.html("<i class='fa fa-frown-o fa-lg'></i> 提交失败,请检查网络后重新提交");
//                     remind.show();
//                 }
//             });
//         }
//     }
//
//     function dialog() {
//         var editNativeNodes = $(".dialog-edit .form-group");
//         var folderNativeNodes = $(".dialog-folder .form-group");
//
//         $('.add').click(function () {
//             tools.clear();
//             tools.addHandler($(this));
//             nevUlId = $(this).attr("data-ul-id");
//         });
//         $(".first-add ").click(function () {
//                 var clickId = parseInt($(this).parent().attr("id").replace(/[^0-9]+/g, ''));
//                 tools.clear();
//                 tools.addHandler(clickId);
//                 isRefresh = true;
//             }
//         );
//
//         $('.edit').click(function () {
//             tools.clear();
//             editHandler($(this));
//         });
//         $('.folder').click(function () {
//             tools.clear();
//             folderHandler();
//         });
//
//         $("#create-folder").click(function () {
//             tools.createNewline($(".dialog-folder form"), folderNativeNodes);
//             tools.hideNewIcon([".dialog-folder .fa-arrow-circle-o-up", ".dialog-folder .fa-arrow-circle-o-down"]);
//             tools.changeNewName(".dialog-folder", ["folderName", "folderId"]);
//             var newTimes = $(".dialog-folder .fa-times-circle-o");
//             newTimes.last().click(function () {
//                 var wapper = $(".dialog-folder  .form-group");
//                 wapper.last().remove();
//             })
//         });
//
//         function editHandler(clickObj) {
//             $('#myModalLabel').html("编辑");
//             var editData = tools.getFolderData("#" + $(clickObj).attr("data-ul-id") + " >li[class='nev-ul-li']", ["data-href", "data-title", "data-id"]);
//             var dataArr = {
//                 "wrapper": ".dialog-edit .form-group",
//                 "parent": ".dialog-edit form",
//                 "data": editData,
//                 "nativeNode": editNativeNodes
//             };
//             tools.nodeHandler(dataArr);
//             tools.changeNameValue(".dialog-edit", ["groupId", "webname", "weburl", "webid"]);
//             tools.setData(editData, [".weburl", ".webname", ".webid"]);
//             folderChildren = $("#" + $(clickObj).attr("data-ul-id") + " >li[class='nev-ul-li']");
//             tools.iconListener($(".dialog-edit form"), $(".dialog-edit .form-group"), folderChildren);
//             tools.setOption(clickObj, "edit");
//             $('.dialog-edit').show();
//         }//end of showEdit()
//
//         function folderHandler() {
//             $('#myModalLabel').html("分组管理");
//             //获取数据
//             var folderDatas = tools.getFolderData($(".folder-name"), ["data-folder-id", "data-folder-name"]);
//             var dataArr = {
//                 "wrapper": ".dialog-folder .form-group",
//                 "parent": ".dialog-folder form",
//                 "data": folderDatas,
//                 "nativeNode": folderNativeNodes
//             };
//             tools.nodeHandler(dataArr);
//             tools.changeNameValue(".dialog-folder ", ["folderName", "folderId"]);
//             tools.setData(folderDatas, [".folderId", ".folderName"]);
//             tools.iconListener($(".dialog-folder form"), $(".dialog-folder  .form-group"), $(".folder-div"));
//             var iconButton = $(".icon-button");
//             if (iconButton.length == 1) {
//                 iconButton.hide();
//             }
//             $('.dialog-folder').show();
//         }// end of folderHandler
//
//     }
//
// }
// // 工具类
// var Tools = function () {
//     var _this = this;
//     var _token;
//     var editFolderId;
//     var constuct = new __construct();
//
//     function __construct() {
//         _this._token = $("input[class=_token]").attr("value");
//     }
//
//
//     // this.jumpHref = function (objs) {
//     //     for (var i = 0; i < objs.length; i++) {
//     //         $(objs[i]).click(function () {
//     //             var href = $(this).attr("data-href");
//     //             if (!href.match(/^http:\/\//i) && !href.match(/^https:\/\//i)) {
//     //                 href = "http://" + href;
//     //             }
//     //             window.open(href);
//     //         });
//     //     }
//     // };
//
//     this.clear = function () {
//         $('.dialog-add').hide();
//         $('.dialog-edit').hide();
//         $('.dialog-folder').hide();
//     };
//     this.addHandler = function (clickObj) {
//         console.log(clickObj);
//         $('#myModalLabel').html("添加");
//         $('.dialog-add').show();
//         _this.setOption(clickObj, "add");
//     };
//
//
//     this.setOption = function (clickObj, className) {
//
//         if (typeof clickObj == "object") {
//             _this.editFolderId = clickObj.attr("data-ul-id").replace(/[^0-9]+/g, '');
//         } else {
//             _this.editFolderId = clickObj;
//         }
//         $(".dialog-" + className + " .groupId option[value=" + _this.editFolderId + "]").attr("selected", "selected");
//     };
//
//     this.showHideNev = function (objs) {
//         for (var i = 0; i < objs.length; i++) {
//             $(objs[i]).click(function () {
//                 var id = $(this.parentNode).attr("data-folder-id");
//                 var ul = $("#nev-ul-" + id);
//                 var display = ul.css("display");
//                 $(this).css("visibility", "hidden");
//                 if (display == "none") {
//                     $(".folder-name[data-folder-id=" + id + "] .fa-caret-down").css("visibility", "visible");
//                     display = "block";
//                 } else {
//                     $(".folder-name[data-folder-id=" + id + "] .fa-caret-right").css("visibility", "visible");
//                     display = "none";
//                 }
//
//                 ul.css("display", display);
//             });
//         }
//
//     };
//
//     this.getFormData = function (formName) {
//         var dataStr = decodeURIComponent($(formName + " form").serialize());
//         var dataArr = dataStr.split("&");
//         var groupedDataArr = {};
//         var groupCount = dataArr.length / $(formName + " .form-group").length;
//         var myI = -1;
//         for (var i = 0; i < dataArr.length; i++) {
//             var start = dataArr[i].indexOf("_");
//             var end = dataArr[i].indexOf("=");
//             var key = dataArr[i].substr(0, start);
//             var value = dataArr[i].substr(end + 1, dataArr[i].length);
//             if ((i + 1) % groupCount == 1) {
//                 myI++;
//                 var temp = {};
//                 temp[key] = value;
//                 groupedDataArr[myI] = temp;
//             } else {
//                 groupedDataArr[myI][key] = value;
//             }
//         }
//         groupedDataArr["_token"] = _this._token;
//         return $.parseJSON(JSON.stringify(groupedDataArr));
//     };
//
//     this.getEditFormData = function () {
//         var editObj = $(".dialog-edit .form-group");
//         var length = editObj.length;
//         var resultData = {};
//         var webIdObj = $(".dialog-edit .webid");
//         for (var i = 0; i < length; i++) {
//             var tempArr = {};
//             tempArr['groupId'] = $(".dialog-edit .groupId:eq(" + i + ")").val();
//             tempArr['webid'] = $(".dialog-edit .webid:eq(" + i + ")").val();
//             tempArr['webname'] = $(".dialog-edit .webname:eq(" + i + ")").val();
//             tempArr['weburl'] = $(".dialog-edit .weburl:eq(" + i + ")").val();
//             resultData[i] = tempArr;
//         }
//         resultData['_token'] = _this._token;
//         console.log(resultData);
//         debugger
//         // resultData = $.parseJSON(JSON.stringify(resultData))
//         return resultData;
//         // console.log(resultData);
//         // debugger
//     };
//
//
//     this.nodeHandler = function (dataArr) {
//         var wrapper = $(dataArr.wrapper);
//         var parent = $(dataArr.parent);
//         var data = dataArr.data;
//         var nativeNode = dataArr.nativeNode;
//         for (var i = 0; i < wrapper.length; i++) {
//             $(wrapper[i]).remove();
//         }
//         for (var i = 0; i < data.length; i++) {
//             parent.append($(nativeNode).clone());
//         }
//     };
//
//     this.changeNameValue = function (divName, dataArr) {
//         for (var i = 0; i < dataArr.length; i++) {
//             var objs = $(divName + " ." + dataArr[i]);
//             for (var j = 0; j < objs.length; j++) {
//                 $(objs[j]).attr("name", dataArr[i] + "_" + j);
//             }
//         }
//     };
//
//     this.createNewline = function (parent, nativeNode) {
//         parent.append($(nativeNode).clone());
//     };
//     this.hideNewIcon = function (objs) {
//         for (var i = 0; i < objs.length; i++) {
//             $(objs[i]).last().hide();
//         }
//     };
//
//     /*
//      修改新增div的name
//      arr ["className","className"]
//      */
//     this.changeNewName = function (parentDiv, arr) {
//         for (var i = 0; i < arr.length; i++) {
//             var obj = $(parentDiv + " ." + arr[i]);
//             obj.last().attr("name", arr[i] + "_" + (obj.length - 1));
//         }
//     };
//
//     this.setData = function (data, nameArr) {
//         var name;
//         for (var i = 0; i < nameArr.length; i++) {
//             name = $(nameArr[i]);
//             for (var j = 0; j < name.length; j++) {
//                 name[j].value = data[j][i];
//             }
//         }
//     };
//
//     this.getFolderData = function (className, attrName) {
//         var dataArr = [];
//         $(className).each(function () {
//             var dataEach = [];
//             var thisObj = $(this);
//             for (var i = 0; i < attrName.length; i++) {
//                 dataEach.push(thisObj.attr(attrName[i]));
//             }
//             dataArr.push(dataEach);
//         });
//         return dataArr;
//     };
//
//
//     this.iconListener = function (parentDiv, lines, blocks) {
//
//         parentDiv.unbind('click').click(function (e) {
//             var eParent = $(e.target).closest('.form-group');
//             var index = $(eParent).index();
//             if (e.target.nodeName == "I" && e.target.className.indexOf("fa-arrow-circle-o-up") > 0 && index > 0 && index < lines.length) {
//                 upObj(lines);
//                 upObj(blocks);
//             } else if (e.target.nodeName == "I" && e.target.className.indexOf("fa-arrow-circle-o-down") > 0 && index < lines.length - 1) {
//                 downObj(lines);
//                 downObj(blocks);
//             } else if (e.target.nodeName == "I" && e.target.className.indexOf("fa-times-circle-o") > 0) {
//                 var bodyClass = $(eParent).closest('.modal-body').attr("class");
//                 var remind = $(".modal-footer h4");
//                 if (bodyClass.match("dialog-edit") && confirm("确认删除吗?")) {
//                     deleteUrl(index);
//                 } else if (bodyClass.match("dialog-folder")) {
//                     var dialogLines = $(".dialog-folder  .form-group");
//                     if (dialogLines.length > 1 && confirm("确认删除吗?")) {
//                         deleteFolder(index);
//                     }
//                 }
//             }
//
//             function upObj(obj) {
//                 $(obj[index - 1]).before(obj[index]);
//                 obj.splice(index - 1, 2, obj[index], obj[index - 1]);
//             }
//
//             function downObj(obj) {
//                 $(obj[index + 1]).after(obj[index]);
//                 obj.splice(index, 2, obj[index + 1], obj[index]);
//             }
//
//             function delObj(obj) {
//                 $(obj[index]).remove();
//                 obj.splice(index, 1);
//             }
//
//
//             function deleteUrl(index) {
//                 var webIdObjs = $(".dialog-edit .webid");
//                 var urlid = webIdObjs[index].value;
//                 doDelete("/index/deleteUrl", "urlid=" + urlid + "&_token=" + _this._token);
//             }
//
//             function deleteFolder() {
//                 var folderObjs = $(".dialog-folder .folderId");
//                 var folderId = folderObjs[index].value;
//                 doDelete("/index/deleteFolder", "id=" + folderId + "&_token=" + _this._token);
//             }
//
//             function doDelete(url, data) {
//                 $.ajax({
//                     type: 'POST',
//                     url: url,
//                     data: data,
//                     success: function (data) {
//                         delObj(lines);
//                         delObj(blocks);
//                         var newlines = $(".dialog-folder  .form-group");
//                         if (newlines.length == 1) {
//                             $(newlines.children(".icon-button")).hide();
//                         }
//                         remind.html("<i class='fa fa-smile-o fa-lg'></i> 操作成功.");
//                         remind.show();
//                         setTimeout(function () {
//                             remind.hide();
//                         }, 1500);
//                     },
//                     error: function () {
//                         remind.html("<i class='fa fa-frown-o fa-lg'></i> 提交失败,请检查网络后重新提交");
//                         remind.show();
//                     }
//                 });
//
//             }
//
//         });
//     };//end iconListener()
// };//end of tools
