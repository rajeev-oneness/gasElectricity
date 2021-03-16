<?php 

	Route::get('dashboard',function(){
		return view('admin.dashboard');
	})->name('dashboard');
	Route::group(['prefix'=>'users'],function(){
		Route::get('/','Admin\CrudController@getUsers')->name('admin.users');
		Route::get('/create','Admin\CrudController@createUser')->name('admin.user.create');
		Route::post('/create','Admin\CrudController@saveUser')->name('admin.user.save');
		Route::post('/manage','Admin\CrudController@manageUser')->name('admin.user.manageUser');
	});

	Route::get('contact-us','Admin\CrudController@contactUs')->name('admin.contactus');

	Route::group(['prefix'=>'blog/category'],function(){
		Route::get('/','Admin\CrudController@blogsCategory')->name('admin.blogs.category');
		Route::post('/create','Admin\CrudController@saveBlogCategory')->name('admin.blogs.category.save');
		Route::post('/update','Admin\CrudController@updateBlogCategory')->name('admin.blogs.category.update');
		Route::post('/{id}/delete', 'Admin\CrudController@deleteBlogCategory')->name('admin.blogs.category.delete');
	});

	Route::group(['prefix'=>'blogs'],function(){
		Route::get('/','Admin\CrudController@blogs')->name('admin.blogs');
		Route::get('/create','Admin\CrudController@createBlog')->name('admin.blogs.create');
		Route::post('/create','Admin\CrudController@saveBlog')->name('admin.blogs.save');
		Route::get('/{id}/edit','Admin\CrudController@editBlog')->name('admin.blogs.edit');
		Route::post('/update','Admin\CrudController@updateBlog')->name('admin.blogs.update');
		Route::post('/{id}/delete', 'Admin\CrudController@deleteBlog')->name('admin.blogs.delete');
	});

	Route::group(['prefix'=>'testimonial'],function(){
		Route::get('/','Admin\CrudController@testimonials')->name('admin.testimonial');
		Route::get('/create','Admin\CrudController@createTestimonial')->name('admin.testimonial.create');
		Route::post('/create', 'Admin\CrudController@saveTestimonial')->name('admin.testimonial.save');
		Route::get('/{id}/edit','Admin\CrudController@editTestimonial')->name('admin.testimonial.edit');
		Route::post('/update','Admin\CrudController@updateTestimonial')->name('admin.testimonial.update');
		Route::post('/{id}/delete', 'Admin\CrudController@deleteTestimonial')->name('admin.testimonial.delete');
	});

	Route::group(['prefix' => 'faq'],function(){
		Route::get('/','Admin\CrudController@faq')->name('admin.faq');
		Route::get('/create','Admin\CrudController@createFaq')->name('admin.faq.create');
		Route::post('/create', 'Admin\CrudController@saveFaq')->name('admin.faq.save');
		Route::get('/{id}/edit','Admin\CrudController@editFaq')->name('admin.faq.edit');
		Route::post('/update','Admin\CrudController@updateFaq')->name('admin.faq.update');
		Route::post('/{id}/delete', 'Admin\CrudController@deleteFaq')->name('admin.faq.delete');
	});

	Route::group(['prefix'=>'setting'],function(){
		Route::get('how-it-works','Admin\CrudController@howItWorks')->name('admin.setting.how_it_works');
		Route::post('how-it-works','Admin\CrudController@updateHowItWorks')->name('admin.setting.updatehow_it_works');
		Route::get('about-us','Admin\CrudController@aboutUs')->name('admin.setting.about_us');
		Route::post('about-us','Admin\CrudController@saveaboutUs')->name('admin.setting.save_aboutUs');
	});
	
 ?>
