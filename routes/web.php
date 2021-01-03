<?php

/*
|--------------------------------------------------------------------------
| Web Routes6tyu
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });




Route::prefix('admin')->group(function() {

  //------------ ADMIN LOGIN SECTION ------------

  Route::get('/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'Admin\LoginController@login')->name('admin.login.submit');
  Route::get('/forgot', 'Admin\LoginController@showForgotForm')->name('admin.forgot');
  Route::post('/forgot', 'Admin\LoginController@forgot')->name('admin.forgot.submit');
  Route::get('/logout', 'Admin\LoginController@logout')->name('admin.logout');

  Route::get('/profile', 'Admin\AdminController@profile')->name('admin.profile');
  Route::post('/profile/update', 'Admin\AdminController@profileupdate')->name('admin.profile.update');

Route::get('/generalsettings/edit', 'Admin\AdminController@gsedit')->name('admin.gs.edit');
  Route::post('/generalsettings/update', 'Admin\AdminController@gsupdate')->name('admin-gs-update');

  Route::get('/password', 'Admin\AdminController@passwordreset')->name('admin.password');
  Route::post('/password/update', 'Admin\AdminController@changepass')->name('admin.password.update');

  Route::get('/', 'Admin\AdminController@index')->name('admin.dashboard');




  Route::get('/slider', 'Admin\SliderController@index')->name('admin-sl-index');
  Route::get('/slider/create', 'Admin\SliderController@create')->name('admin-sl-create');
  Route::post('/slider/create', 'Admin\SliderController@store')->name('admin-sl-store');
  Route::get('/slider/edit/{id}', 'Admin\SliderController@edit')->name('admin-sl-edit');
  Route::post('/slider/edit/{id}', 'Admin\SliderController@update')->name('admin-sl-update');
  Route::get('/slider/delete/{id}', 'Admin\SliderController@destroy')->name('admin-sl-delete');

  Route::get('/category/datatables', 'Admin\CategoryController@datatables')->name('admin-cat-datatables'); //JSON REQUEST

  Route::get('/category', 'Admin\CategoryController@index')->name('admin-cat-index');
  // Route::get('/category/create', 'Admin\CategoryController@create')->name('admin-cat-create');
  // Route::post('/category/create', 'Admin\CategoryController@store')->name('admin-cat-store');

  Route::get('/category/edit/{id}', 'Admin\CategoryController@edit')->name('admin-cat-edit');
  Route::post('/category/edit/{id}', 'Admin\CategoryController@update')->name('admin-cat-update');
  Route::get('/category/status/{id1}/{id2}', 'Admin\CategoryController@status')->name('admin-cat-status');
  // Route::get('/category/delete/{id}', 'Admin\CategoryController@destroy')->name('admin-cat-delete');

 
   // SUBCATEGORY SECTION ------------

  Route::get('/subcategory/datatables', 'Admin\SubCategoryController@datatables')->name('admin-subcat-datatables'); //JSON REQUEST
  Route::get('/subcategory', 'Admin\SubCategoryController@index')->name('admin-subcat-index');
  Route::get('/subcategory/create', 'Admin\SubCategoryController@create')->name('admin-subcat-create');
  Route::post('/subcategory/create', 'Admin\SubCategoryController@store')->name('admin-subcat-store');
  Route::get('/subcategory/edit/{id}', 'Admin\SubCategoryController@edit')->name('admin-subcat-edit');
  Route::post('/subcategory/edit/{id}', 'Admin\SubCategoryController@update')->name('admin-subcat-update');
  Route::get('/subcategory/delete/{id}', 'Admin\SubCategoryController@destroy')->name('admin-subcat-delete');
  Route::get('/subcategory/status/{id1}/{id2}', 'Admin\SubCategoryController@status')->name('admin-subcat-status');
  Route::get('/load/subcategories/{id}/', 'Admin\SubCategoryController@load')->name('admin-subcat-load'); //JSON REQUEST

  // SUBCATEGORY SECTION ENDS------------




   // RECIPE SECTION ------------

  Route::get('/recipe/datatables', 'Admin\RecipeController@datatables')->name('admin-recipe-datatables'); //JSON REQUEST
  Route::get('/recipe', 'Admin\RecipeController@index')->name('admin-recipe-index');
  Route::get('/recipe/create', 'Admin\RecipeController@create')->name('admin-recipe-create');
  Route::post('/recipe/create', 'Admin\RecipeController@store')->name('admin-recipe-store');
  Route::get('/recipe/edit/{id}', 'Admin\RecipeController@edit')->name('admin-recipe-edit');
  Route::post('/recipe/edit/{id}', 'Admin\RecipeController@update')->name('admin-recipe-update');
  Route::get('/recipe/delete/{id}', 'Admin\RecipeController@destroy')->name('admin-recipe-delete');
  Route::get('/recipe/status/{id1}/{id2}', 'Admin\RecipeController@status')->name('admin-recipe-status');
  Route::get('/load/recipe/{id}/', 'Admin\RecipeController@load')->name('admin-recipe-load'); //JSON REQUEST

  // RECIPE SECTION ENDS------------


   // RECIPE Reviews SECTION ------------

  Route::get('/recipe/review/datatables', 'Admin\ReviewController@datatables')->name('admin-recipe-review-datatables'); //JSON REQUEST
  Route::get('/recipe/review/', 'Admin\ReviewController@index')->name('admin-recipe-review-index');
  // Route::get('/recipe/create', 'Admin\RecipeController@create')->name('admin-recipe-create');
  // Route::post('/recipe/create', 'Admin\RecipeController@store')->name('admin-recipe-store');
  Route::get('/recipe/review/edit/{id}', 'Admin\ReviewController@edit')->name('admin-recipe-review-edit');
  Route::post('/recipe/review/edit/{id}', 'Admin\ReviewController@update')->name('admin-recipe-review-update');
  Route::get('/recipe/review/delete/{id}', 'Admin\ReviewController@destroy')->name('admin-recipe-review-delete');
  Route::get('/recipe/review/status/{id1}/{id2}', 'Admin\ReviewController@status')->name('admin-recipe-review-status');
  // Route::get('/load/review/recipe/{id}/', 'Admin\RecipeController@load')->name('admin-recipe-load'); //JSON REQUEST

  // RECIPE Reviews SECTION ENDS------------





  Route::get('/pgother/datatables', 'Admin\PgOtherController@datatables')->name('admin-pgother-datatables'); //JSON REQUEST
  Route::get('/pgother', 'Admin\PgOtherController@index')->name('admin-pgother-index');
  Route::get('/pgother/create', 'Admin\PgOtherController@create')->name('admin-pgother-create');
  Route::post('/pgother/create', 'Admin\PgOtherController@store')->name('admin-pgother-store');
  Route::get('/pgother/edit/{id}', 'Admin\PgOtherController@edit')->name('admin-pgother-edit');
  Route::post('/pgother/edit/{id}', 'Admin\PgOtherController@update')->name('admin-pgother-update');
  Route::get('/pgother/status/{id1}/{id2}', 'Admin\PgOtherController@status')->name('admin-pgother-status');
  Route::get('/pgother/delete/{id}', 'Admin\PgOtherController@destroy')->name('admin-pgother-delete');


  // Route::get('/faqs/datatables', 'Admin\PgFaqController@datatables')->name('admin-faqs-datatables'); //JSON REQUEST
  // Route::get('/faqs', 'Admin\PgFaqController@index')->name('admin-faqs-index');
  // Route::get('/faqs/create', 'Admin\PgFaqController@create')->name('admin-faqs-create');
  // Route::post('/faqs/create', 'Admin\PgFaqController@store')->name('admin-faqs-store');
  // Route::get('/faqs/edit/{id}', 'Admin\PgFaqController@edit')->name('admin-faqs-edit');
  // Route::post('/faqs/edit/{id}', 'Admin\PgFaqController@update')->name('admin-faqs-update');
  // Route::get('/faqs/status/{id1}/{id2}', 'Admin\PgFaqController@status')->name('admin-faqs-status');

  // Route::get('/faqs/delete/{id}', 'Admin\PgFaqController@destroy')->name('admin-faqs-delete');


  Route::get('/blog/datatables', 'Admin\ArticleController@datatables')->name('admin-article-datatables'); //JSON REQUEST
  Route::get('/blog', 'Admin\ArticleController@index')->name('admin-article-index');
  Route::get('/blog/create', 'Admin\ArticleController@create')->name('admin-article-create');
  Route::post('/blog/create', 'Admin\ArticleController@store')->name('admin-article-store');
  Route::get('/blog/edit/{id}', 'Admin\ArticleController@edit')->name('admin-article-edit');
  Route::post('/blog/edit/{id}', 'Admin\ArticleController@update')->name('admin-article-update');
  Route::get('/blog/status/{id1}/{id2}', 'Admin\ArticleController@status')->name('admin-article-status');
  Route::get('/blog/delete/{id}', 'Admin\ArticleController@destroy')->name('admin-article-delete');

  Route::get('/blog/category/datatables', 'Admin\BlogCategoryController@datatables')->name('admin-cblog-datatables'); //JSON REQUEST
  Route::get('/blog/category', 'Admin\BlogCategoryController@index')->name('admin-cblog-index');
  Route::get('/blog/category/create', 'Admin\BlogCategoryController@create')->name('admin-cblog-create');
  Route::post('/blog/category/create', 'Admin\BlogCategoryController@store')->name('admin-cblog-store');
  Route::get('/blog/category/edit/{id}', 'Admin\BlogCategoryController@edit')->name('admin-cblog-edit');
  Route::post('/blog/category/edit/{id}', 'Admin\BlogCategoryController@update')->name('admin-cblog-update');
  Route::get('/blog/category/delete/{id}', 'Admin\BlogCategoryController@destroy')->name('admin-cblog-delete');



  //------------ ADMIN SOCIAL SETTINGS SECTION ------------

  Route::get('/social', 'Admin\SocialSettingController@index')->name('admin-social-index');
  Route::post('/social/update/all', 'Admin\SocialSettingController@socialupdateall')->name('admin-social-update-all');

  //------------ ADMIN SOCIAL SETTINGS SECTION ENDS------------


  //------------ ADMIN SOCIAL SETTINGS SECTION ------------

  Route::get('/about', 'Admin\AboutPageController@index')->name('admin-about-index');
  Route::post('/about/update/', 'Admin\AboutPageController@update')->name('admin-about-update');

  //------------ ADMIN SOCIAL SETTINGS SECTION ENDS------------

  //------------ ADMIN PARTNER SECTION ------------

  Route::get('/partner/datatables', 'Admin\PartnerController@datatables')->name('admin-partner-datatables');
  Route::get('/partner', 'Admin\PartnerController@index')->name('admin-partner-index');
  Route::get('/partner/create', 'Admin\PartnerController@create')->name('admin-partner-create');
  Route::post('/partner/create', 'Admin\PartnerController@store')->name('admin-partner-store');
  Route::get('/partner/edit/{id}', 'Admin\PartnerController@edit')->name('admin-partner-edit');
  Route::post('/partner/edit/{id}', 'Admin\PartnerController@update')->name('admin-partner-update');
  Route::get('/partner/delete/{id}', 'Admin\PartnerController@destroy')->name('admin-partner-delete');

  //------------ ADMIN PARTNER SECTION ENDS ------------

  //------------ ADMIN SUBSCRIBERS SECTION ------------


  Route::get('/subscribers/datatables', 'Admin\SubscriberController@datatables')->name('admin-subs-datatables'); //JSON REQUEST
  Route::get('/subscribers', 'Admin\SubscriberController@index')->name('admin-subs-index');
  Route::get('/subscribers/download', 'Admin\SubscriberController@download')->name('admin-subs-download');


  //------------ ADMIN SUBSCRIBERS ENDS ------------  



  Route::get('/banner/edit/{slug}', 'Admin\BannerController@edit')->name('admin-banner-edit');
  Route::post('/banner/edit/{slug}', 'Admin\BannerController@update')->name('admin-banner-update');


  Route::get('/seotools/keywords', 'Admin\AdminController@keywords')->name('admin-seotool-keywords');
  Route::post('/seotools/keywords/update', 'Admin\AdminController@keywordsupdate')->name('admin-seotool-keywords-update');

    Route::get('/cache/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return redirect()->route('admin.dashboard')->with('cache','System Cache Has Been Removed.');
  })->name('admin-cache-clear');


});


Route::get('/', 'Front\HomeController@index')->name('front.index');
Route::get('/recipe/{slug}', 'Front\HomeController@recipedetail')->name('front.recipe');
Route::get('/recipe/{slug}/print', 'Front\HomeController@printpage')->name('recipe-print');

Route::get('/blogs/{slug?}', 'Front\HomeController@blog')->name('front.blog');

Route::get('/blog/{slug}', 'Front\HomeController@blogdetail')->name('front.blog.detail');
Route::get('/contact', 'Front\HomeController@contact')->name('front.contact');
Route::post('/contact','Front\HomeController@contactemail')->name('front.contact.submit');


Route::get('/category/recipe', 'Front\HomeController@category')->name('front.category');
Route::get('/category/cuisine', 'Front\HomeController@category')->name('front.cuisine');



Route::get('/recipes/all', 'Front\HomeController@categorydetail')->name('front.recipe.all');
Route::get('/recipes/search', 'Front\HomeController@RecipeSearch')->name('front.recipe.search');

Route::get('/category/recipe/{slug}', 'Front\HomeController@categorydetail')->name('front.category.detail');
Route::get('/category/cuisine/{slug}', 'Front\HomeController@categorydetail')->name('front.cuisine.detail');



Route::get('/about-us', 'Front\HomeController@about')->name('front.about');

  // User Review
  Route::post('/review/submit/{id}','Front\HomeController@reviewsubmit')->name('front.review.submit');
  // User Review Ends
  // Blog Comments
  Route::post('/comment/submit/{id}','Front\HomeController@commentsubmit')->name('front.comment.submit');
  // Blog Comments Ends

  // REPLY SECTION
  Route::post('/recipe/comment/reply/{id}', 'Front\HomeController@reply')->name('recipe.reply');
// Subscribe SECTION
  Route::post('recipe/subscribe', 'Front\HomeController@subscribe')->name('front.subscribe');

  Route::get('/load-more-data','Front\HomeController@more_data')->name('load-more-comments');
   Route::get('/load-more-reviews','Front\HomeController@more_reviews')->name('load-more-reviews');


// Route::get('/articles/', 'Front\FrontendController@Articleid')->name('front.article.id');

// Route::get('/articles/{slug}', 'Front\FrontendController@Article')->name('front.article');
// Route::get('/faq', 'Front\FrontendController@faq')->name('front.faq');

// Route::get('/contact/', 'Front\FrontendController@Contact')->name('front.contact');
// Route::post('/contact','Front\FrontendController@contactemail')->name('front.contact.submit');

Route::get('/{slug}/', 'Front\HomeController@page')->name('front.page');
