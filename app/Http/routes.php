<?php
    /*Route::get('/', function () {
        $a = 1;
        return view('welcome', ['a' => $a]);
    });*/

    Route::get('admin','AdminController@index');
    //Project Route
    Route::resource('admin/project','ProjectController');
    Route::resource('admin/cat','CatController');
    Route::post('admin/cat/store','CatController@store');
    Route::post('admin/cat/remove','CatController@remove');
    Route::post('admin/project/store','ProjectController@store');
    Route::post('admin/project/remove','ProjectController@remove');
    Route::post('admin/project/important','ProjectController@important');
    Route::post('admin/project/image/remove','ProjectController@img_remove');

    Route::get('admin/project/create/images','ProjectController@image_info');
    Route::post('admin/project/image_update','ProjectController@img_update');
    //News Route
    Route::resource('admin/news','NewsController');
    Route::post('admin/news/store','NewsController@store');
    Route::post('admin/news/remove','NewsController@remove');
    Route::post('admin/news/important','NewsController@important');
    //Video Route
    Route::resource('admin/video','VideoController');
    Route::post('admin/video/store','VideoController@store');
    Route::post('admin/video/remove','VideoController@remove');
    //cm Route
    Route::resource('admin/cm','CmController');
    Route::post('admin/cm/store','CmController@store');
    Route::post('admin/cm/remove','CmController@remove');
    Route::post('admin/cm/taeed','CmController@taeed');

    //pdfacc Route
    Route::get('admin/pdfacc','PdfaccController@index');
    Route::post('admin/pdfacc/store','PdfaccController@store');
    Route::get('admin/pdfacc/remove','PdfaccController@remove');
    Route::get('admin/pdfacc/taeed','PdfaccController@taeed');

    //Video Route
    Route::resource('admin/cm','CmController');
    Route::post('admin/cm/store','CmController@store');
    Route::post('admin/cm/remove','CmController@remove');
    Route::post('admin/cm/taeed','CmController@taeed');


    //user_post Route
    Route::get('admin/up','UpController@index');
    Route::post('admin/up/store','UpController@store');
    Route::get('admin/up/remove','UpController@remove');
    Route::get('admin/up/taeed','UpController@taeed');

    //Pages Route
    Route::resource('admin/pages','PagesController');
    Route::post('admin/pages/store','PagesController@store');
    Route::post('admin/pages/remove','PagesController@remove');
    //front-end

    //Event Route
    Route::resource('admin/event','EventController');
    Route::post('admin/event/create/member/sendsm','EventController@sendsm');
    Route::get('admin/event/create/members','EventController@members');
    Route::post('admin/event/important','EventController@important');


    Route::post('admin/event/members/rem','EventController@memremove');
    Route::post('admin/event/store','EventController@store');
    Route::post('admin/event/remove','EventController@remove');
    //Users Route
    Route::resource('admin/users','UsersController');
    Route::post('admin/users/update','UsersController@update');
    //Newsletter Route
    Route::get('admin/newsletter','NewsletterController@index');
    Route::post('admin/newsletter/send','NewsletterController@send');
    //Auth Routes
    Route::auth();

    //site Routes
    Route::get('/', 'SiteController@index');
    Route::get('/newad', 'SiteController@newad');


