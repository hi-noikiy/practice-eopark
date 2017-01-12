<?php
return [
    //所有显示状态分类
    "categories" => base_path('database/helpers/category.php'),
    //所有状态分类
    "categories_all" => base_path('database/helpers/category_all.php'),
    //图片加载失败替换图片
    "img_error" => "/img/onError.jpg",
    //各分类热门资源
    "resources" => base_path('database/helpers/resources.php'),
    //分类包含属性集
    "category_properties" => base_path('database/helpers/categoryProperties.php'),
];