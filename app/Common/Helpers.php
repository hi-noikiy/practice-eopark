<?php
//获取资源类型名
function getResourceType($typeId) {
    switch ($typeId) {
        case 0:
            return Config::get("set.resourceType.0");
        case 1:
            return Config::get("set.resourceType.1");
        case 2:
            return Config::get("set.resourceType.2");
        case 3:
            return Config::get("set.resourceType.3");
        default:
            return "";
    }
}

//设置操作返回信息,提示失败或成功
function setReturnMessage($message) {
    session()->flash('showStatus', true);
    if (is_array($message)) {
        session()->flash('status', $message['status'] ? true : false);
        if (isset($message['success'])) {
            session()->flash('statusSuccess', $message['success']);
        }
        if (isset($message['error'])) {
            session()->flash('statusError', $message['error']);
        }
    } else {
        session()->flash('status', $message ? true : false);
    }
}

//上传图片
function upLoadImg($file, $folderName, $fileName = false) {
    $resultPath = null;
    if ($file && $file->isValid()) {
        $realPath = $file->getRealPath();    //这个表示的是缓存在tmp文件夹下的文件的绝对路径
        $fileName = $fileName ? $fileName : date("YmdHms") . "_" . rand(10, 99) . ".jpg";
        $savePath = public_path("img/" . $folderName . "/");
        if (!is_dir($savePath)) {
            @mkdir($savePath);
        }
        move_uploaded_file($realPath, $savePath . $fileName);
        $resultPath = "/img/" . $folderName . "/" . $fileName;
    }
    return $resultPath;
}

//http url适配
function httpAdapter($url) {
    if (!preg_match("/^http:\/\//i", $url) && !preg_match("/^https:\/\//i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

//获取所有分类数据缓存
function getCategoryCache() {
    return unserialize(file_get_contents(config("path.categories")));
}

//获取所有分类数据缓存
function getCategoryAllCache() {
    return unserialize(file_get_contents(config("path.categories_all")));
}


function getCatePropRelationCache() {
    return unserialize(file_get_contents(config("path.category_properties")));
}

//设置后台导航栏选中session
function setAdminNavigation($page) {
    session()->forget('category_active');
    session()->forget('resource_active');
    session()->forget('member_active');
    session()->flash($page, 'active');
}

//设置前台导航栏选中session
function setFacadeNavigation($page) {
    session()->forget('index_active');
    session()->forget('thanksgiving_active');
    session()->forget('category_active');
    session()->flash($page, 'active');
}

//赋值或为0
function valueOr($value, $or = 0) {
    return $value ? $value : $or;
}

//获取所有属性名
function getPropertyGroups() {
    return App\Repositories\Models\PropertiesModel::where([
        "status" => 1
    ])->get();
}

function numberAdapter($number) {
    if ($number > 999) {
        if ($number > 9999) {
            $number = floor($number / 1000) / 10 . "W+";
        } else {
            $number = floor($number / 100) / 10 . "K+";
        }
    }
    return $number;
}

/**
 * @param $name
 * @param $value
 * @return mixed|string
 * 添加参数到url中,如果url已包含需要赋值的参数名,则可写逻辑替换原URL中的键值
 */
function addParaToUrl($name, $value) {
    $return = '';
    if (!$name || $value === "") {
        return $return;
    }
    $currentUrl = url()->full();

    if ($name == "order") {
        $types = [
            "order=views",
            "order=score",
            "order=created_at",
            "order=comment_numbers"
        ];
        foreach ($types as $type) {
            if (strpos($currentUrl, $type) !== false) {
                $replacedUrl = str_replace($type, "$name=$value", $currentUrl);
            }
        }
    }

    if ($name == "type") {
        $types = [
            "type=1",
            "type=2",
            "type=3",
            "type=0",
        ];
        foreach ($types as $type) {
            if (strpos($currentUrl, $type) !== false) {
                $replacedUrl = str_replace($type, "$name=$value", $currentUrl);
            }
        }
    }

    // if( name=....){}

    if (isset($replacedUrl)) {
        $return = $replacedUrl;
    } else {
        if (strpos($currentUrl, "?") === false) {
            $connectType = "?";
        } else {
            $connectType = "&";
        }
        $return = $currentUrl . $connectType . "$name=$value";
    }
    return $return;
}

/**
 * @param $id
 * @param $brothers
 * @return mixed|string
 * 单选筛选时,判断是否已选择其他同组成员
 * 若已经选择同组成员,则修改URL为选择自己
 * 若选择自己,则从筛选条件中取消自己
 */
function alterFilter($id, $brothers) {
    $current = url()->current();
    $urls    = explode("/", $current);
    $filter  = end($urls);
    foreach ($brothers as $brother) {
        //filter中有自己所属组的某id值
        if (strpos($filter, (string)$brother) !== false) {
            //自己已被选中
            if ($brother == $id) {
                //重新组装filter筛选器,删除自己和-
                $filterIds = explode("-", $filter);
                $remixed   = '';
                foreach ($filterIds as $filterId) {
                    if ($filterId != $id) {
                        if ($remixed) {
                            $remixed .= "-$filterId";
                        } else {
                            $remixed = $filterId;
                        }
                    }
                }
                $result = str_replace($filter, $remixed, $current);
                break;
            } else {
                $replaced = str_replace($brother, $id, $filter);
                $result   = str_replace($filter, $replaced, $current);
                break;
            }
        }
    }
    if (isset($result)) {
        return $result;
    } else {
        return $filter ? $current . "-" . $id : $current . "/$id";
    }
}

/**
 * @param $brothers
 * @return mixed|string
 * resource 页面 不限按钮,清空同组成员属性id
 */
function clearBrother($brothers) {
    $current = url()->current();
    $urls    = explode("/", $current);
    $end     = end($urls);
    $filters = explode('-', $end);
    $remix   = '';
    foreach ($filters as $filter) {
        if (!in_array($filter, $brothers)) {
            $remix = $remix ? $remix . "-" . $filter : $filter;
        }
    }
    return str_replace($end, $remix, $current);
}


function dateAdapter($date) {
    $thisTime       = strtotime($date);
    $timeDifference = time() - $thisTime;
    if ($timeDifference < 86400) {
        $result = "";
    } else {
        if ($timeDifference < 172800) {
            $result = "昨天 ";
        } else {
            if ($timeDifference < 259200) {
                $result = "前天 ";
            }else{
                $result = date("Y-m-d ", $thisTime);
            }
        }
    }
    return $result . date("H:i", $thisTime);
}