$(document).ready(function () {
    new Category().main();
});
window.onbeforeunload = function () {
    $.ajax({
        url: '/admin/category/update',
        type: "get",
    })
};

var Category = function () {

    this.main = function () {
        listener();
    };

    function listener() {
        var nameInputNode, nameNode, oldNameText,
            id, idName, index,
            presentObj,
            brotherClone, childColne,
            brotherParent, childParent,
            BASE_URL = "/admin/category/";

        $(".category-name").click(function () {
            nameNode = $(this);
            nameInputNode = $(this).next().children("input");
            oldNameText = nameNode.html().trim();
            nameInputNode.val(oldNameText);
            nameNode.hide();
            nameInputNode.show();
            nameInputNode.focus();
        });

        $(".name-input").blur(function () {
            setDataId(this);
            idName = $(this).val();
            nameNode.html(idName);
            dataHandler(BASE_URL + 'changeName/' + id + "/" + encodeURIComponent(idName), "name");
        });

        $(".operation .fa-times-circle-o").click(function () {
            if (confirm("确认删除该栏目及其子栏目吗?")) {
                setDataId(this);
                presentObj = $("li[data-id=" + id + "]");
                dataHandler(BASE_URL + 'delete/' + id, "delete");
            }
        });
        $(".operation .fa-arrow-circle-o-up").click(function () {
            setDataId(this);
            presentObj = $("li[data-id=" + id + "]");
            index = presentObj.index();
            if (index > 0) {
                dataHandler(BASE_URL + 'up/' + id, "up");
            }
        });

        $(".operation .fa-arrow-circle-o-down").click(function () {
            setDataId(this);
            presentObj = $("li[data-id=" + id + "]");
            dataHandler(BASE_URL + 'down/' + id, "down");
        });

        $(".operation .fa-plus-square-o").click(function () {
            var addChildInput = $(this).parent().find(".add-child-input");
            addChildInput.val("");
            addChildInput.show();
        });
        $(".operation .fa-plus-square").click(function () {
            var addInput = $(this).parent().find(".add-input");
            addInput.val("");
            addInput.show();
        });

        $(".add-input").blur(function () {
            $(this).hide();
            idName = $(this).val();
            if (idName) {
                setDataId(this);
                brotherParent = presentObj.parents("ul").first();
                brotherClone = presentObj.clone();
                brotherClone.find("ul").first().html("");
                brotherClone.find(".category-name").first().html(idName);
                // presentUlObj.append(cloned);
                dataHandler(BASE_URL + "addBrother/" + id + "/" + encodeURIComponent(idName), "addBrother");
            }
        });
        $(".add-child-input").blur(function () {
            $(this).hide();
            idName = $(this).val();
            if (idName) {
                setDataId(this);
                childParent = presentObj.find("ul").first();
                childColne = $(".copy").last().clone();
                childColne.find(".category-name").first().html(idName);
                childColne.removeAttr("class");
                dataHandler(BASE_URL + "addChild/" + id + "/" + encodeURIComponent(idName), "addChild");
            }
        });

        $("#update").click(function () {
            $.ajax({
                url: '/admin/category/update',
                type: "get",
                success: function (data) {
                    var notice = $("#status-notice");
                    notice.show();
                    notice.html("更新成功");
                    setTimeout(function () {
                        notice.hide();
                        notice.html("");
                    }, 3000);
                }
            })
        });

        function setDataId(objName) {
            id = $(objName).parents("li").first().attr("data-id").trim();
            presentObj = $("li[data-id=" + id + "]");
        }

        function dataHandler(url, type) {
            $.ajax({
                url: url,
                type: "get",
                success: function (data) {
                    switch (type) {
                        case "name":
                            nameInputNode.hide();
                            nameNode.show();
                            break;
                        case "up":
                            presentObj.prev().before(presentObj);
                            break;
                        case "down":
                            presentObj.next().after(presentObj);
                            break;
                        case "delete":
                            console.log(data);
                            presentObj.hide();
                            break;
                        case "addBrother":
                            console.log(data);
                            brotherClone.attr("data-id", data.id);
                            brotherParent.append(brotherClone);
                            break;
                        case "addChild":
                            console.log(data);
                            childColne.attr("data-id", "300");
                            childParent.append(childColne);
                            break;
                        default:
                            break
                    }
                    window.location.reload();
                }
            });
        }
    }

};