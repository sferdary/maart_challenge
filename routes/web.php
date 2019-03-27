<?php
require_once(ROUTE);
require_once(VIEW);

//PAGES
Route::createView('', function(){
    View::get('index');
});
Route::createView('index', function(){
    require_once(REALESTATE);
    View::get('index');
});


//ADMIN PAGES
Route::createView('dashboard', function(){
    View::get('Admin/dashboard');
});
Route::createView('create-real-estate', function(){
    View::get('Admin/essentials/create-real-estate');
});


//USER AUTHENTICATION
Route::createView('register', function(){
    View::get('Auth/register');
});
Route::createView('logout', function(){
    View::get('Auth/logout');
});
Route::createView('login', function(){
    View::get('Auth/login');
});
Route::createView('verify', function(){
    View::get('Auth/verify');
});
Route::createView('forgot-password', function(){
    View::get('Auth/forgot-password');
});
Route::createView('reset-password', function(){
    View::get('Auth/reset-password');
});