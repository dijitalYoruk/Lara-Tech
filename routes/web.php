<?php

Route::group(["prefix" => "admin", "middleware" => "admin_guest"], function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\LoginController@login')->name('admin.login');
    Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');

});



Route::group(["prefix" => "admin",  "middleware" => "admin_auth"], function () {

    Route::post('/logout', 'Auth\LoginController@logout')->name('admin.logout');

    // |--------------------------------------------------------------------
    // | TOTP Routes
    // |--------------------------------------------------------------------

    Route::get('TOTP/verify-TOTP',  'VerifyTOTPController@index')->name('admin.TOTP.index');
    Route::post('TOTP/verify-TOTP', 'VerifyTOTPController@check')->name('admin.TOTP.check');
    Route::post('TOTP/resend-TOTP', 'VerifyTOTPController@resend')->name('admin.TOTP.resend');


    // |--------------------------------------------------------------------
    // | Category Routes
    // |--------------------------------------------------------------------

    Route::get('/categories/uncategorised', 'CategoryController@admin_show_uncategorised')->name('admin.category.show_uncategorised');
    Route::get('/categories/{main_category}', 'CategoryController@admin_show')->name('admin.category.show');
    Route::get('/categories', 'CategoryController@admin_index')->name('admin.category.index');
    Route::get('/categories/create', 'CategoryController@admin_create')->name('admin.category.create');
    Route::post('/categories/{main_category}', 'CategoryController@admin_store_sub_category')->name('admin.category.store_sub_category');
    Route::post('/categories', 'CategoryController@admin_store')->name('admin.category.store');
    Route::delete('/main_categories/{main_category}', 'CategoryController@admin_destroy_main_category')->name('admin.category.destroy_main_category');
    Route::delete('/sub_categories/{sub_category}', 'CategoryController@admin_destroy_sub_category')->name('admin.category.show_sub_category');
    Route::get('/sub_categories/{sub_category}', 'CategoryController@admin_show_sub_category')->name('admin.category.destroy_sub_category');

    // |--------------------------------------------------------------------
    // | Product Routes
    // |--------------------------------------------------------------------

    Route::get('/products', 'ProductController@admin_index')->name('admin.products.index');
    Route::delete('/product_images/{product_image}', 'ProductController@admin_destroy_product_image')->name('admin.product_images.destroy');
    Route::delete('/products/{product}', 'ProductController@admin_destroy')->name('admin.products.destroy');
    Route::get('/products/create', 'ProductController@admin_create')->name('admin.products.create');
    Route::get('/products/{product}', 'ProductController@admin_edit')->name('admin.products.edit');
    Route::put('/products/{product}', 'ProductController@admin_update')->name('admin.products.update');
    Route::post('/products', 'ProductController@admin_store')->name('admin.products.store');

    // |--------------------------------------------------------------------
    // | Home Route
    // |--------------------------------------------------------------------

    Route::get('/home',  'HomeController@admin_index')->name('admin.home');

    // |--------------------------------------------------------------------
    // | User Routes
    // |--------------------------------------------------------------------

    Route::get('/users', 'UserController@admin_index')->name('admin.users.index');
    Route::get('/users/{user}', 'UserController@admin_show')->name('admin.users.show');
    Route::put('/users/{user}', 'UserController@admin_update')->name('admin.users.update');

    // |--------------------------------------------------------------------
    // | Order Routes
    // |--------------------------------------------------------------------

    Route::get('/orders/edit/{order}', 'OrderController@admin_edit')->name('admin.orders.edit');
    Route::get('/orders/{user}', 'OrderController@show_user_orders')->name('admin.orders.show_user_orders');

    Route::delete("/comments/{product_comment}", "CommentController@destroy")->name('admin.comments.destroy');
});


Route::group(["middleware" => "client_guest"], function () {
    Route::get('/', function () {
        return redirect(route('login'));
    });
});

Route::group(["prefix" => "client", "middleware" => "client_guest"], function () {
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email Verification Routes...
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

});

Route::group(["prefix" => "client", "middleware" => "client_auth"], function () {

    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/account_detail', 'UserController@client_account_detail')->name('client.account_detail.index');
    Route::put('/account_detail', 'UserController@client_account_update')->name('client.account_detail.update');

    // |--------------------------------------------------------------------
    // | TOTP Routes
    // |--------------------------------------------------------------------

    Route::get('TOTP/verify-TOTP', 'VerifyTOTPController@index')->name('client.TOTP.index');
    Route::post('TOTP/verify-TOTP', 'VerifyTOTPController@check')->name('client.TOTP.check');
    Route::post('TOTP/resend-TOTP', 'VerifyTOTPController@resend')->name('client.TOTP.resend');

    // |--------------------------------------------------------------------
    // | Home Route
    // |--------------------------------------------------------------------

    Route::get('/home', 'HomeController@index')->name('client.home');

    // |--------------------------------------------------------------------
    // | Category Routes
    // |--------------------------------------------------------------------

    Route::get('/categories/{main_category}', 'CategoryController@index')->name('client.category');
    Route::get('/categories/{main_category}/{sub_category}', 'CategoryController@show')->name('client.category.show');


    // |--------------------------------------------------------------------
    // | Search Route
    // |--------------------------------------------------------------------

    Route::get('/search', 'ProductController@index')->name('client.search');


    // |--------------------------------------------------------------------
    // | Products Routes
    // |--------------------------------------------------------------------

    Route::get('/products/featured', 'ProductController@client_show_featured')->name('client.product.client_show_featured');
    Route::get('/products/discount', 'ProductController@client_show_discount')->name('client.product.client_show_discount');
    Route::get('/products/best_seller', 'ProductController@client_show_best_seller')->name('client.product.client_show_best_seller');
    Route::get('/products/{product}', 'ProductController@show')->name('client.product.show');


    // |--------------------------------------------------------------------
    // | Cart Routes
    // |--------------------------------------------------------------------

    Route::post('/cart', 'CartController@store')->name('client.cart.store');
    Route::get('/cart',  'CartController@index')->name('client.cart.index');
    Route::post('/cart/increment/{cart_product}', 'CartController@updateProductIncrement')->name('client.cart.update.increment');
    Route::post('/cart/decrement/{cart_product}', 'CartController@updateProductDecrement')->name('client.cart.update.decrement');
    Route::delete('/cart/{cart_product}', 'CartController@destroy')->name('client.cart.destroy');


    // |--------------------------------------------------------------------
    // | Order Routes
    // |--------------------------------------------------------------------

    Route::get('/order-cart', 'OrderController@orderCart')->name('client.orders.order_cart');
    Route::post('/order', 'OrderController@store')->name('client.orders.store');
    Route::get('/order', 'OrderController@index')->name('client.orders.index');
    Route::get('/order/{order}', 'OrderController@show')->name('client.orders.show');



    Route::post("/comments", "CommentController@client_store")->name('client.comments.store');
    Route::delete("/comments/{product_comment}", "CommentController@destroy")->name('client.comments.destroy');


});
