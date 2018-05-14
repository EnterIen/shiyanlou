<?php

use core\Router;


Router::get('/phpinfo',function(){
    return phpinfo();
});

Route::get('/user/info', 'UserController@getInfo');

Router::get('/home','IndexController@getIndex');

Router::post('/user/update','IndexController@postIndex');
