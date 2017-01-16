<?php
Route::group([
    'middleware' => [
        'device',
        'web'
    ]
], function () {
    Route::auth();
    Route::get('/category', "CategoryController@index");
    Route::get('/category/getResources', 'CategoryController@getResources');

    /*index*/
    Route::get('/', "IndexController@index");
    Route::get('/index', "IndexController@index");
    Route::get('/index/add', "IndexController@add");
    Route::get('/index/updatePosition/{id}/{x}/{y}', "IndexController@updatePosition");
    Route::get('/index/edit', "IndexController@edit");
    Route::get('/index/delete/{ids}', "IndexController@delete");
    Route::post('/index/move', "IndexController@move");

    /*detail*/
    Route::get('/detail/{id}', "DetailController@index");
    Route::get('/detail/{id}/addComment', 'DetailController@addComment');
    Route::get('/detail/{id}/changeLikesStatus/{commentId}', 'DetailController@changeLikesStatus');
    Route::get('/detail/{id}/changeGrade/{grade}', 'DetailController@changeGrade');

    /*thanksgiving*/
    Route::get('/thanksgiving', "ThanksgivingController@index");
    Route::post('/thanksgiving/uploadImg', 'ThanksgivingController@uploadImg');
    Route::get('/thanksgiving/uploadImg', 'ThanksgivingController@uploadImg');
    Route::get('/thanksgiving/addResource', 'ThanksgivingController@addResource');
    Route::get('/thanksgiving/addThanks', 'ThanksgivingController@addThanks');
//    Route::get('/thanksgiving/property', 'ThanksgivingController@getProperties');


    /*resources*/
    Route::get("/resources/{categoryId}", "ResourcesController@index")->where('categoryId', '[0-9]+');
    Route::get("/resources/{categoryId}/filter/{filterStr}", "ResourcesController@filter")
         ->where('categoryId', '[0-9]+');
    Route::get("/resources/{categoryId}/filter", function ($categoryId) { return redirect("resources/{$categoryId}"); });

    /*feedback*/
    Route::get('/feedback/invalid/{resourceId}', 'FeedbackController@invalid')->where('resourceId', '[0-9]+');
    Route::get('/feedback/opinion', 'FeedbackController@opinion');

    /* My-* */
    Route::get('/my/collect', 'MyCollectController@index');
    Route::get('/my/collect/add/{resourceId}', 'MyCollectController@add');
    Route::get('/my/collect/delete/{collectId}', 'MyCollectController@delete');

    Route::get('/my/letter', 'MyLetterController@index');
    Route::get('/my/letter/new', 'MyLetterController@index');
    Route::get('/my/letter/view/{fromUserId}', 'MyLetterController@viewByFrom');
    Route::get('/my/letter/all', 'MyLetterController@all');
    Route::post('/my/letter/send/{toUserId}', 'MyLetterController@send');
});

Route::group([
    'namespace' => 'Mobile',
    'prefix' => 'mobile',
    'middleware' => [
        'device',
        'web'
    ]
], function () {
    Route::get('/', "IndexController@index");
});

Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'middleware' => 'web'
], function () {

    //登录页面
    Route::get('login', "AuthController@getLogin");
    //提交登录
    Route::post('login', "AuthController@postLogin");
    //退出登录
    Route::get('logout', "AuthController@logout");

    Route::get('transfer', function () { return view('admin.transfer'); });
    Route::group([
        'middleware' => 'adminAuth'
    ], function () {
        Route::get('/', "AuthController@index");
        Route::get('/header', "AuthController@header");
        Route::get('/menu', "AuthController@menu");
        //后台的主要部分,欢迎页面,或者是系统状态.
        Route::get('/main', "AuthController@main");

        //category
        Route::get('/category', "CategoryController@index");
        Route::get('/category/add/{pid}', "CategoryController@add");
        Route::get('/category/edit/{id}', "CategoryController@edit");

        Route::group([
            'middleware' => 'updateCache:category'
        ], function () {
            Route::get('/category/update', function () { return; });
            Route::get('/category/editSave', "CategoryController@editSave");
            Route::get('/category/delete/{id}', "CategoryController@delete");
            Route::get('/category/addSave', "CategoryController@addSave");
        });


        //resources
        Route::get('/resource', "ResourcesController@index");
        Route::get('/resource/edit/{id}', "ResourcesController@edit");
        Route::get('/resource/add', "ResourcesController@add");
        Route::get('/resource/updateCache', "ResourcesController@updateCache");
        Route::group([
            'middleware' => 'updateCache:category'
        ], function () {
            Route::get('/resource/changeStatus/{id}', "ResourcesController@changeStatus");
            Route::get('/resource/edit-save/{id}', "ResourcesController@editSave");
            Route::get('/resource/delete/{id}', "ResourcesController@delete");
            Route::post('/resource/add-save', "ResourcesController@addSave");
        });

        //property
        Route::get('/property', "PropertyController@all");
        Route::get('/property/addProp', function () { return view("admin.property_add"); });
        Route::get('/property/addProp/save', "PropertyController@addPropSave");
        Route::get('/property/addValue/{propId}', function ($propId) { return view("admin.property_value_add", ["propId" => $propId]); });
        Route::get('/property/addValue/{propId}/save', "PropertyController@addValueSave");
        Route::get('/property/deleteProp/{propId}', "PropertyController@deleteProp");
        Route::get('/property/deletePropValue/{valueId}', "PropertyController@deletePropValue");
        Route::get('/property/edit/{id}', "PropertyController@edit");
        Route::get('/property/edit/{id}/save', "PropertyController@editSave");
        Route::get('/property/editValue/{id}', "PropertyController@editValue");
        Route::get('/property/editValue/{id}/save', "PropertyController@editValueSave");
        Route::get('/property/assignCategory/{id}', "PropertyController@assignCategory");
        Route::get('/property/assignCategory/{id}/save', "PropertyController@assignCategorySave")
             ->middleware('updateCache:category_properties');


        //member
        Route::get('/member', 'MemberController@index');
        Route::get('/member/add', 'MemberController@add');
        Route::get('/member/add', 'MemberController@add');
        Route::get('/member/delete/{id}', "MemberController@delete");
        Route::get('/member/edit/{id}', "MemberController@edit");
        Route::get('/member/editSave/{id}', "MemberController@editSave");

        //brand
        Route::get('/brand', 'BrandController@index');
        Route::get('/brand/add', function () { return view("admin.brand_add"); });
        Route::post('/brand/add/save', 'BrandController@addSave');
        Route::get('/brand/edit/{id}', 'BrandController@edit');
        Route::post('/brand/edit/{id}/save', 'BrandController@editSave');
        Route::get('/brand/addCateRelation/{id}', function () {
            return view('admin.brand_edit_cate');
        });
        Route::get('/brand/addCateRelation/{id}/save', 'BrandController@addCateRelationSave');
        Route::get('/brand/showCategories/{brandId}', 'BrandController@showCategories');
        Route::get('/brand/editCategory/{id}', function ($id) {
            return view('admin.brand_edit_cate', ["id" => $id]);
        });
        Route::get('/brand/editCategory/{id}/save', 'BrandController@editCategorySave');
        Route::get('/brand/delete/{id}', 'BrandController@delete');
        Route::get('/brand/deleteCateRelation/{relationId}', 'BrandController@deleteCateRelation');
    });
});
