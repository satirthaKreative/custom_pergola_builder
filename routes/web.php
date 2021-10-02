<?php
use App\Mail\TestEmail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Authentications
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// end of Authentications


// admin routing 
Route::group(['prefix' => 'admin'], function(){

    // Config Calculation
	Route::get('/pick-a-footprint-config','Admin\Dashboard\PickUpFootPrint\PickUpFootPrintController@configPriceFx')->name('admin.show-pick-a-footprint-config');
	Route::get('/pick-a-overhead-shades-config','Admin\Dashboard\PickOverheadShades\PickOverheadShadesController@overheadFx')->name('admin.show-pick-a-overhead-shades-config');
	Route::get('/pick-a-post-length-changes-config','Admin\Dashboard\PickPostLength\PickPostLengthController@pickPostLengthFx')->name('admin.show-pick-a-post-length-changes-config');
	Route::get('/new-config-combination-panel','Admin\Dashboard\CombinationPanel\CombinationController@configCombinationFx')->name('admin.new-config-combination-panel');
	// admin log-on auth
	Route::get('/login','Admin\Dashboard\DashboardController@index')->name('admin.login');
	Route::post('/login','Admin\Dashboard\DashboardController@formSubmit')->name('admin.login.submit');
	Route::post('/logout','Auth\LoginController@adminlogout')->name('admin.logout');
	// end of admin log-on auth

	// dashboard panel
	Route::get('/dashboard','AdminController@index')->name('admin.dashboard');
		// admin change password 
		Route::get('/change-password','Admin\Dashboard\ChangePassword\ChangePasswordController@showPage')->name('admin.changePassword');
		Route::get('/change-password-submit','Admin\Dashboard\ChangePassword\ChangePasswordController@submitPassPage')->name('admin.changePasswordSubmit');
		// end of admin change password
		// unique visitors show 
		Route::get('/visitors-count','Admin\Dashboard\Visitors\VisitorController@showCountVisitors')->name('admin.showCountVisitors');
		// end of unique visitors

		// master wood
		Route::get('/master-wood','Admin\Dashboard\MasterWood\MasterWoodController@index')->name('admin.master-wood');
		Route::get('/master-wood-tbl-show','Admin\Dashboard\MasterWood\MasterWoodController@master_show_wood_fx')->name('admin.master-wood-tbl-show');
		Route::post('/master-wood-submit','Admin\Dashboard\MasterWood\MasterWoodController@master_wood_submit')->name('admin.master-wood-submit');
		Route::get('/master-wood-action-get-show','Admin\Dashboard\MasterWood\MasterWoodController@master_wood_action_get_show')->name('admin.master-wood-action-get-show');
		Route::post('/master-wood-submit-update','Admin\Dashboard\MasterWood\MasterWoodController@master_wood_submit_update')->name('admin.master-wood-submit-update');
		Route::get('/master-wood-action-change','Admin\Dashboard\MasterWood\MasterWoodController@actionP')->name('admin.master-wood-action-change');
		Route::get('/master-wood-action-del','Admin\Dashboard\MasterWood\MasterWoodController@actionDel')->name('admin.master-wood-action-del');
		// end of master-wood

		// pick-up-footprint (outside post to post)
		Route::get('/pick-a-footprint','Admin\Dashboard\PickUpFootPrint\PickUpFootPrintController@showPage')->name('admin.show-pick-a-footprint');
		Route::get('/get-posts-in-pick-a-footprint','Admin\Dashboard\PickUpFootPrint\PickUpFootPrintController@showAllPosts')->name('admin.get-posts-in-pick-a-footprint');
		Route::post('/insert-pick-a-footprint','Admin\Dashboard\PickUpFootPrint\PickUpFootPrintController@insertPickAFootprint')->name('admin.insert-pick-a-footprint');
		Route::get('/view-pick-a-footprint','Admin\Dashboard\PickUpFootPrint\PickUpFootPrintController@showViewPage')->name('admin.view-pick-a-footprint');
		Route::get('/all-data-on-view-pick-a-footprint','Admin\Dashboard\PickUpFootPrint\PickUpFootPrintController@allDataOnShowViewPage')->name('admin.all-data-on-view-pick-a-footprint');
		Route::get('/del-pick-up-footprint','Admin\Dashboard\PickUpFootPrint\PickUpFootPrintController@delParticularData')->name('admin.del-pick-up-footprint');
		Route::get('/loading-add-price-generating-value-choose','Admin\Dashboard\PickUpFootPrint\PickUpFootPrintController@add_price_range')->name('admin.loading-add-price-generating-value-choose');
			// all show --- master width
			Route::get('/show-width-pick-a-footprint','Admin\Dashboard\PickUpFootPrint\PickUpFootPrintController@masterWidthShow')->name('admin.show-width-pick-a-footprint');
			// all show --- master width
			Route::get('/show-height-pick-a-footprint','Admin\Dashboard\PickUpFootPrint\PickUpFootPrintController@masterHeightShow')->name('admin.show-height-pick-a-footprint');
			// all show --- edit Page
			Route::get('/get-all-footprint-data','Admin\Dashboard\PickUpFootPrint\PickUpFootPrintController@getAllFootprintData')->name('admin.get-all-footprint-data');
			Route::POST('/edit-page-pick-a-footprint','Admin\Dashboard\PickUpFootPrint\PickUpFootPrintController@editModalPartFx')->name('admin.edit-page-pick-a-footprint');
			// master height
			Route::get('/master-height','Admin\Dashboard\MasterHeight\MasterHeightController@index')->name('admin.master-height');
			Route::get('/master-height-show','Admin\Dashboard\MasterHeight\MasterHeightController@showPageData')->name('admin.master-height-show');
			Route::post('/master-height-submit','Admin\Dashboard\MasterHeight\MasterHeightController@submitData')->name('admin.master-height-submit');
			Route::get('/master-height-action-change','Admin\Dashboard\MasterHeight\MasterHeightController@changeActionData')->name('admin.master-height-action-change');
			Route::get('/master-height-action-del','Admin\Dashboard\MasterHeight\MasterHeightController@changeActionDel')->name('admin.master-height-action-del');
			Route::get('/master-height-action-get-edit','Admin\Dashboard\MasterHeight\MasterHeightController@getActionEdit')->name('admin.master-height-action-get-edit');
			Route::post('/master-height-action-edit/{my_data}','Admin\Dashboard\MasterHeight\MasterHeightController@changeActionEdit')->name('admin.master-height-action-edit');
			// master width
			Route::get('/master-width','Admin\Dashboard\MasterWidth\MasterWidthController@index')->name('admin.master-width');
			Route::get('/master-width-show','Admin\Dashboard\MasterWidth\MasterWidthController@showPageData')->name('admin.master-width-show');
			Route::post('/master-width-submit','Admin\Dashboard\MasterWidth\MasterWidthController@submitData')->name('admin.master-width-submit');
			Route::get('/master-width-action-change','Admin\Dashboard\MasterWidth\MasterWidthController@changeActionData')->name('admin.master-width-action-change');
			Route::get('/master-width-action-del','Admin\Dashboard\MasterWidth\MasterWidthController@changeActionDel')->name('admin.master-width-action-del');
			Route::get('/master-width-action-get-edit','Admin\Dashboard\MasterWidth\MasterWidthController@getActionEdit')->name('admin.master-width-action-get-edit');
			Route::post('/master-width-action-edit/{my_data}','Admin\Dashboard\MasterWidth\MasterWidthController@changeActionEdit')->name('admin.master-width-action-edit');
			// Master Overhead Shades 
			Route::get('/master-overhead-shades','Admin\Dashboard\MasterOverheadShades\MasterOverShadeController@index')->name('admin.master-overhead-shades-show');
			Route::get('/master-overhead-shades-show','Admin\Dashboard\MasterOverheadShades\MasterOverShadeController@showP')->name('admin.master-overhead-shades-show-actual-data');
			Route::post('/master-overhead-shades-add','Admin\Dashboard\MasterOverheadShades\MasterOverShadeController@addP')->name('admin.master-overhead-shades-show-actual-submit');
			Route::get('/master-overhead-shades-action-change-show','Admin\Dashboard\MasterOverheadShades\MasterOverShadeController@actionP')->name('admin.master-overhead-shades-show-action-change-data');
			Route::get('/master-overhead-shades-action-get-edit','Admin\Dashboard\MasterOverheadShades\MasterOverShadeController@showEditP')->name('admin.master-overhead-shades-action-get-edit');
			Route::post('/master-overhead-shades-action-edit/{my_data}','Admin\Dashboard\MasterOverheadShades\MasterOverShadeController@updateP')->name('admin.master-overhead-shades-action-edit');
			Route::get('/master-overhead-shades-action-del','Admin\Dashboard\MasterOverheadShades\MasterOverShadeController@removeP')->name('admin.master-overhead-shades-action-del');
			// master post length
			Route::get('/master-post-length','Admin\Dashboard\MasterPostLength\MasterPostLengthController@index')->name('admin.master-post-length-show');
			Route::get('/master-post-length-show','Admin\Dashboard\MasterPostLength\MasterPostLengthController@showP')->name('admin.master-post-length-show-actual-data');
			Route::post('/master-post-length-add','Admin\Dashboard\MasterPostLength\MasterPostLengthController@addP')->name('admin.master-post-length-show-actual-submit');
			Route::get('/master-post-length-action-change-show','Admin\Dashboard\MasterPostLength\MasterPostLengthController@actionP')->name('admin.master-post-length-show-action-change-data');
			Route::get('/master-post-length-action-get-edit','Admin\Dashboard\MasterPostLength\MasterPostLengthController@showEditP')->name('admin.master-post-length-action-get-edit');
			Route::post('/master-post-length-action-edit/{my_data}','Admin\Dashboard\MasterPostLength\MasterPostLengthController@updateP')->name('admin.master-post-length-action-edit');
			Route::get('/master-post-length-action-del','Admin\Dashboard\MasterPostLength\MasterPostLengthController@removeP')->name('admin.master-post-length-action-del');
			// posts
			Route::get('/add-posts','Admin\Dashboard\PillerPost\PillerPostController@showPage')->name('admin.add-posts');
			Route::get('/admin-submit-piller-posts','Admin\Dashboard\PillerPost\PillerPostController@submitPiller')->name('admin.submit-piller-posts');
			Route::get('/admin-show-piller-post','Admin\Dashboard\PillerPost\PillerPostController@showPillerPosts')->name('admin.show-piller-post');
			Route::get('/admin-piller-action-change','Admin\Dashboard\PillerPost\PillerPostController@pillerActionChange')->name('admin.piller-action-change');
			Route::get('/admin-piller-action-del','Admin\Dashboard\PillerPost\PillerPostController@changeActionDel')->name('admin.piller-action-del');
			Route::get('/admin-piller-action-get-edit','Admin\Dashboard\PillerPost\PillerPostController@getActionEdit')->name('admin.piller-action-get-edit');
			Route::get('/admin-piller-action-edit','Admin\Dashboard\PillerPost\PillerPostController@changeActionEdit')->name('admin.piller-action-edit');
			// Pick Overhead Shades
			Route::get('/pick-overhead-shades-height-width-first-load','Admin\Dashboard\PickOverheadShades\PickOverheadShadesController@showActualData')->name('admin.pick-overhead-shades-height-width-first-load');
			Route::get('/pick-overhead-shades-post-first-load','Admin\Dashboard\PickOverheadShades\PickOverheadShadesController@showPostLoadfx')->name('admin.pick-overhead-shades-post-first-load');

			Route::get('/add-pick-overhead-shades','Admin\Dashboard\PickOverheadShades\PickOverheadShadesController@showPage')->name('admin.add-pick-overhead-shades');
			Route::post('/admin-submit-pick-overhead-shades','Admin\Dashboard\PickOverheadShades\PickOverheadShadesController@submitOverheadShades')->name('admin.submit-pick-overhead-shades');
			Route::get('/admin-show-pick-overhead-shades','Admin\Dashboard\PickOverheadShades\PickOverheadShadesController@showOverheadShades')->name('admin.show-pick-overhead-shades');
			Route::get('/admin-pick-overhead-shades-change','Admin\Dashboard\PickOverheadShades\PickOverheadShadesController@changeActionOverheadShades')->name('admin.change-action-pick-overhead-shades');

			Route::get('/admin-pick-overhead-shades-del','Admin\Dashboard\PickOverheadShades\PickOverheadShadesController@delActionOverheadShades')->name('admin.del-action-pick-overhead-shades');
			Route::get('/admin-pick-overhead-shades-edit-view','Admin\Dashboard\PickOverheadShades\PickOverheadShadesController@viewEditActionOverheadShades')->name('admin.view-edit-action-pick-overhead-shades');
			Route::post('/admin-pick-overhead-shades-edit/{id}','Admin\Dashboard\PickOverheadShades\PickOverheadShadesController@editActionOverheadShades')->name('admin.edit-action-pick-overhead-shades');
			// 3D view
			Route::get('/panel-for-3D-view','Admin\Dashboard\Video3D\Video3DController@showPage')->name('admin.panel-for-3d-view');
			Route::get('/get-data-for-3D-view','Admin\Dashboard\Video3D\Video3DController@getDataPageFx')->name('admin.get-data-for-3D-view');
			Route::get('/get-table-data-for-3D-view','Admin\Dashboard\Video3D\Video3DController@getTableDataPageFx')->name('admin.get-table-data-for-3D-view');
			Route::post('/submit-3D-data','Admin\Dashboard\Video3D\Video3DController@submit_video3D_fx')->name('admin.submit-3D-data');
			Route::get('/change-action-data-for-3D-view','Admin\Dashboard\Video3D\Video3DController@getChangeActionFx')->name('admin.change-action-data-for-3D-view');
			Route::get('/del-action-data-for-3D-view','Admin\Dashboard\Video3D\Video3DController@delActionFx')->name('admin.del-action-data-for-3D-view');
			Route::get('/edit-view-action-data-for-3D-view','Admin\Dashboard\Video3D\Video3DController@editViewChangeActionFx')->name('admin.edit-view-action-data-for-3D-view');
			Route::post('/edit-action-data-for-3D-view/{id}','Admin\Dashboard\Video3D\Video3DController@editActionFx')->name('admin.edit-action-data-for-3D-view');
			// Pick Post Length 
			Route::get('/pick-master-post-length-height-width-first-load','Admin\Dashboard\PickPostLength\PickPostLengthController@showMasterPostLength')->name('admin.pick-master-post-length-height-width-first-load');
			Route::get('/pick-overhead-postLength-shades-post-first-load','Admin\Dashboard\PickPostLength\PickPostLengthController@showPostLoadfx')->name('admin.pick-overhead-postLength-shades-post-first-load');

			Route::get('/add-pick-post-length','Admin\Dashboard\PickPostLength\PickPostLengthController@showPage')->name('admin.add-pick-post-length');
			Route::post('/admin-submit-pick-post-length','Admin\Dashboard\PickPostLength\PickPostLengthController@submitOverheadShades')->name('admin.submit-pick-post-length');
			Route::get('/admin-show-pick-post-length','Admin\Dashboard\PickPostLength\PickPostLengthController@showOverheadShades')->name('admin.show-pick-post-length');
			Route::get('/admin-pick-post-length-change','Admin\Dashboard\PickPostLength\PickPostLengthController@overheadShadesActionChange')->name('admin.pick-post-length-action-change');

			Route::get('/admin-pick-post-length-del','Admin\Dashboard\PickPostLength\PickPostLengthController@delActionChange')->name('admin.pick-post-length-action-del');
			Route::get('/admin-pick-post-length-view-edit','Admin\Dashboard\PickPostLength\PickPostLengthController@viewEditActionChange')->name('admin.pick-post-length-action-view-edit');
			Route::post('/admin-pick-post-length-edit/{id}','Admin\Dashboard\PickPostLength\PickPostLengthController@editActionChange')->name('admin.pick-post-length-action-edit');

			Route::get('/admin-pick-post-length-wood-type','Admin\Dashboard\PickPostLength\PickPostLengthController@wood_types_fx')->name('admin.pick-post-length-wood-type');
			// Pick Post Slap
			Route::get('/add-pick-post-slap','Admin\Dashboard\PickPostMountBracket\PickPostMountBracketController@showPage')->name('admin.add-pick-post-slap');
			Route::post('/admin-submit-pick-post-slap','Admin\Dashboard\PickPostMountBracket\PickPostMountBracketController@submitOverheadShades')->name('admin.submit-pick-post-slap');
			Route::get('/admin-show-pick-post-slap','Admin\Dashboard\PickPostMountBracket\PickPostMountBracketController@showOverheadShades')->name('admin.show-pick-post-slap');
			Route::get('/admin-pick-post-slap-change','Admin\Dashboard\PickPostMountBracket\PickPostMountBracketController@overheadShadesActionChange')->name('admin.pick-post-slap-action-change');

			Route::get('/admin-pick-post-slap-del','Admin\Dashboard\PickPostMountBracket\PickPostMountBracketController@delActionChange')->name('admin.pick-post-slap-action-del');
			Route::get('/admin-pick-post-slap-view-edit','Admin\Dashboard\PickPostMountBracket\PickPostMountBracketController@viewEditActionChange')->name('admin.pick-post-slap-action-view-edit');
			Route::post('/admin-pick-post-slap-edit/{id}','Admin\Dashboard\PickPostMountBracket\PickPostMountBracketController@editActionChange')->name('admin.pick-post-slap-action-edit');
			// Pick canopy
			Route::get('/add-pick-canopy','Admin\Dashboard\PickCanopy\PickCanopyController@showPage')->name('admin.add-pick-canopy');
			Route::post('/admin-submit-pick-canopy','Admin\Dashboard\PickCanopy\PickCanopyController@submitOverheadShades')->name('admin.submit-pick-canopy');
			Route::get('/admin-show-pick-canopy','Admin\Dashboard\PickCanopy\PickCanopyController@showOverheadShades')->name('admin.show-pick-canopy');
			Route::get('/admin-pick-canopy-change','Admin\Dashboard\PickCanopy\PickCanopyController@overheadShadesActionChange')->name('admin.pick-canopy-action-change');

			Route::get('/admin-pick-canopy-del','Admin\Dashboard\PickCanopy\PickCanopyController@changeActionDel')->name('admin.pick-canopy-action-del');
			Route::get('/admin-pick-canopy-view-edit','Admin\Dashboard\PickCanopy\PickCanopyController@getActionEdit')->name('admin.pick-canopy-action-view-edit');
			Route::post('/admin-pick-canopy-edit/{id}','Admin\Dashboard\PickCanopy\PickCanopyController@changeActionEdit')->name('admin.pick-canopy-action-edit');
			// Pick Louvered Panel
			Route::get('/add-pick-panel','Admin\Dashboard\PickLouveredPanel\PickLouveredPanelController@showPage')->name('admin.add-pick-panel');
			Route::post('/admin-submit-pick-panel','Admin\Dashboard\PickLouveredPanel\PickLouveredPanelController@submitOverheadShades')->name('admin.submit-pick-panel');
			Route::get('/admin-show-pick-panel','Admin\Dashboard\PickLouveredPanel\PickLouveredPanelController@showOverheadShades')->name('admin.show-pick-panel');
			Route::get('/admin-pick-panel-change','Admin\Dashboard\PickLouveredPanel\PickLouveredPanelController@overheadShadesActionChange')->name('admin.pick-panel-action-change');

			Route::get('/admin-pick-panel-del','Admin\Dashboard\PickLouveredPanel\PickLouveredPanelController@changeActionDel')->name('admin.pick-panel-action-del');
			Route::get('/admin-pick-panel-view-edit','Admin\Dashboard\PickLouveredPanel\PickLouveredPanelController@getActionEdit')->name('admin.pick-panel-action-view-edit');
			Route::post('/admin-pick-panel-edit/{id}','Admin\Dashboard\PickLouveredPanel\PickLouveredPanelController@changeActionEdit')->name('admin.pick-panel-action-edit');
			
			// combination panel
			Route::get('/combination-panel','Admin\Dashboard\CombinationPanel\CombinationController@index')->name('admin.combination-panel');
			Route::get('/combination-panel-show','Admin\Dashboard\CombinationPanel\CombinationController@showActualData')->name('admin.combination-panel-show');
			Route::post('/combination-panel-add','Admin\Dashboard\CombinationPanel\CombinationController@addActualData')->name('admin.combination-panel-add');
			Route::get('/combination-panel-show-tbl','Admin\Dashboard\CombinationPanel\CombinationController@show_l_panel_data_fx')->name('admin.combination-panel-show-tbl');
			Route::get('/combination-panel-edit','Admin\Dashboard\CombinationPanel\CombinationController@edit_combination_panel')->name('admin.combination-panel-edit');
			Route::post('/combination-panel-edit-submit/{my_data}','Admin\Dashboard\CombinationPanel\CombinationController@submit_combination_panel')->name('admin.combination-panel-edit-submit');
			Route::get('/combination-panel-action-change','Admin\Dashboard\CombinationPanel\CombinationController@edit_combination_action_change')->name('admin.combination-panel-action-change');
			Route::get('/combination-panel-del','Admin\Dashboard\CombinationPanel\CombinationController@del_combination_panel')->name('admin.combination-panel-del');

			// Pick Final Product
			Route::get('/add-final-product','Admin\Dashboard\FinalProduct\FinalProductController@showPage')->name('admin.add-final-product');
			Route::post('/admin-submit-final-product','Admin\Dashboard\FinalProduct\FinalProductController@submitOverheadShades')->name('admin.submit-final-product');
			Route::get('/admin-show-final-product','Admin\Dashboard\FinalProduct\FinalProductController@showOverheadShades')->name('admin.show-final-product');
			Route::get('/admin-final-product-change','Admin\Dashboard\FinalProduct\FinalProductController@overheadShadesActionChange')->name('admin.final-product-action-change');

			Route::get('/admin-final-product-del','Admin\Dashboard\FinalProduct\FinalProductController@delActionFx')->name('admin.final-product-action-del');
			Route::get('/admin-final-product-view-edit','Admin\Dashboard\FinalProduct\FinalProductController@viewEditActionFx')->name('admin.final-product-action-view-edit');
			Route::post('/admin-final-product-edit/{id}','Admin\Dashboard\FinalProduct\FinalProductController@editActionFx')->name('admin.final-product-action-edit');
				// choose footprint
				Route::get('/choose-footprint-final-product','Admin\Dashboard\FinalProduct\FinalProductController@choose_footprint_fx')->name('admin.choose-footprint-final-product');
				// choose Posts length
				Route::get('/choose-post-length-final-product','Admin\Dashboard\FinalProduct\FinalProductController@choose_post_length_fx')->name('admin.choose-post-length-final-product');
				// choose Posts length
				Route::get('/choose-overhead-shades-final-product','Admin\Dashboard\FinalProduct\FinalProductController@choose_overhead_shades_fx')->name('admin.choose-overhead-shades-final-product');
		// end of pick-up-footprint (outside post to post)

		// dashboard all panel counts
			Route::get('/dashboard-all-count','AdminController@dashboard_all_count_fx')->name('admin.final-total-product-lists');
		// end of dashboard all panel counts
		/// order details
		Route::get('/order-details','Admin\Dashboard\Payment\PaymentController@showpage')->name('admin.order-details');
		Route::get('/order-details-data','Admin\Dashboard\Payment\PaymentController@showActionPage')->name('admin.order-details-actual');
		Route::get('/order-details-change-status','Admin\Dashboard\Payment\PaymentController@changeAction')->name('admin.order-details-change-status');
		Route::get('/payment-show','Admin\Dashboard\Payment\PaymentController@order_full_details_fx')->name('admin.order_full_details');
		/// order details

		// post wish 

			// canopy
			Route::get('/post-wish-canopy-view','Admin\Dashboard\PostWish\PostWishCanopyController@showPage')->name('admin.post-wish-canopy');
			Route::get('/load-canopy-post-wish-full-data','Admin\Dashboard\PostWish\PostWishCanopyController@fullDataFx')->name('admin.load-canopy-post-wish-fx');
			Route::get('/load-piller-post-for-wish-canopy','Admin\Dashboard\PostWish\PostWishCanopyController@pillerPostFx')->name('admin.load-piller-post-for-wish-canopy');
			Route::post('/postwish-canopy-video-submit','Admin\Dashboard\PostWish\PostWishCanopyController@postwish_canopy_submit')->name('admin.postwish-canopy-submit-new');
			Route::get('/canopy-edit-fx','Admin\Dashboard\PostWish\PostWishCanopyController@canopy_edit_fx')->name('admin.canopy-edit-fx');
			Route::get('/canopy-del-fx','Admin\Dashboard\PostWish\PostWishCanopyController@canopy_del_fx')->name('admin.canopy-del-fx');
			Route::post('/postwish-canopy-video-update-submit','Admin\Dashboard\PostWish\PostWishCanopyController@postwish_canopy_update_submit')->name('admin.postwish-canopy-submit-update');

			// lpanel
			Route::get('/post-wish-louvered-view','Admin\Dashboard\PostWish\PostWishLpanelController@showPage')->name('admin.post-wish-lpanel');
			Route::get('/load-lpanel-post-wish-full-data','Admin\Dashboard\PostWish\PostWishLpanelController@fullDataFx')->name('admin.load-lpanel-post-wish-fx');
			Route::post('/postwish-lpanel-video-submit','Admin\Dashboard\PostWish\PostWishLpanelController@postwish_lpanel_submit')->name('admin.postwish-lpanel-submit-new');
			Route::get('/lpanel-edit-fx','Admin\Dashboard\PostWish\PostWishLpanelController@lpanel_edit_fx')->name('admin.lpanel-edit-fx');
			Route::get('/lpanel-del-fx','Admin\Dashboard\PostWish\PostWishLpanelController@lpanel_del_fx')->name('admin.lpanel-del-fx');
			Route::post('/postwish-lpanel-video-update-submit','Admin\Dashboard\PostWish\PostWishLpanelController@postwish_lapnel_update_submit')->name('admin.postwish-lpanel-submit-update');


			Route::get('/load-lpanel-type-text','Admin\Dashboard\PostWish\PostWishLpanelController@load_lpanel_type_text_fx')->name('admin.load-lpanel-type-text');
			Route::post('/postwish-lpanel-type-text-submit','Admin\Dashboard\PostWish\PostWishLpanelController@louvered_type_text_fx')->name('admin.postwish-lpanel-type-text-submit');
			Route::get('/choose-lpanel-type-text','Admin\Dashboard\PostWish\PostWishLpanelController@choose_lpanel_type_text_fx')->name('admin.choose-lpanel-type-text');
			Route::get('/lpanel-type-text-del-fx','Admin\Dashboard\PostWish\PostWishLpanelController@del_lpanel_type_text_fx')->name('admin.lpanel-type-text-del-fx');
			
		// end of post wish 
		
		/// config panel

		Route::get('/config-panel','Admin\Dashboard\Config\ConfigController@showPage')->name('admin.admin-config-page-show');
		 	// pick a footprint config
			Route::get('/config-pick-footprint-load','Admin\Dashboard\Config\ConfigController@showConfigPickFootprint')->name('admin.admin-config-page-show-load');
			Route::get('/submit-4post-config','Admin\Dashboard\Config\ConfigController@config_post4_submit')->name('admin.submit-4post-config');
			Route::get('/submit-6post-config','Admin\Dashboard\Config\ConfigController@config_post6_submit')->name('admin.submit-6post-config');
			Route::get('/submit-4double-post-config','Admin\Dashboard\Config\ConfigController@config_post4double_submit')->name('admin.submit-4double-post-config');
			Route::get('/submit-8post-config','Admin\Dashboard\Config\ConfigController@config_post8_submit')->name('admin.submit-8post-config');
			// overhead shades config
			Route::get('/submit-regular-config','Admin\Dashboard\Config\ConfigController@submit_regular_config_fx')->name('admin.submit-regular-config');
			Route::get('/submit-open-config','Admin\Dashboard\Config\ConfigController@submit_open_config_fx')->name('admin.submit-open-config');
			Route::get('/submit-sunblocker-config','Admin\Dashboard\Config\ConfigController@submit_sunblocker_config_fx')->name('admin.submit-sunblocker-config');
			// Config Post Length
			Route::get('/submit-post9length-config','Admin\Dashboard\Config\ConfigController@submit_post9length_config_fx')->name('admin.submit-post9length-config');
			Route::get('/submit-post12length-config','Admin\Dashboard\Config\ConfigController@submit_post12length_config_fx')->name('admin.submit-post12length-config');
			// Config Canopy
			Route::get('/submit-canopy-config','Admin\Dashboard\Config\ConfigController@submit_canopy_config_fx')->name('admin.submit-canopy-config');
			// Config Mount Brackets
			Route::get('/submit-mount4-brackets-config','Admin\Dashboard\Config\ConfigController@submit_mount4_config_fx')->name('admin.submit-mount4-config');
			Route::get('/submit-mount6-brackets-config','Admin\Dashboard\Config\ConfigController@submit_mount6_config_fx')->name('admin.submit-mount6-config');
			Route::get('/submit-mount8-brackets-config','Admin\Dashboard\Config\ConfigController@submit_mount8_config_fx')->name('admin.submit-mount8-config');
			// Config Louvered Panel
			Route::get('/submit-louvered-panel-config','Admin\Dashboard\Config\ConfigController@submit_lpanel_config_fx')->name('admin.submit-louvered-panel-config');
			// Config Wood Type
			Route::get('/config-wood-load','Admin\Dashboard\Config\ConfigController@load_config_wood_fx')->name('admin.config.config-wood-load');
			Route::get('/config-wood-load-all-config-data','Admin\Dashboard\Config\ConfigController@load_all_config_wood_fx')->name('admin.config.load-all-config-data');	
			Route::get('/config-data-update-insert','Admin\Dashboard\Config\ConfigController@update_config_fx')->name('admin.config.config-data-update-insert');		
		/// end of config panel

		/// setup 
			// 1. setup mount bracket 
			Route::get('/mount-bracket-all','Admin\Dashboard\SetUp\MountBracketController@index')->name('admin.setup.mount-bracket-all');
			Route::get('/mount-bracket-show-data','Admin\Dashboard\SetUp\MountBracketController@fullDataFx')->name('admin.setup.mount-bracket-show-data');
			Route::post('/mount-bracket-setup_submit','Admin\Dashboard\SetUp\MountBracketController@postwish_mount_submit')->name('admin.setup.mount-bracket-submit');
			Route::get('/mount-bracket-setup-edit','Admin\Dashboard\SetUp\MountBracketController@mount_edit_fx')->name('admin.setup.mount-bracket-edit');
			Route::post('/mount-bracket-setup-update','Admin\Dashboard\SetUp\MountBracketController@mount_update_fx')->name('admin.setup.mount-bracket-update');
			Route::get('/mount-bracket-setup-update','Admin\Dashboard\SetUp\MountBracketController@mount_delete_fx')->name('admin.setup.mount-bracket-del');
			Route::get('/mount-bracket-setup-update-img-del','Admin\Dashboard\SetUp\MountBracketController@mount_img_delete_fx')->name('admin.setup.mount-bracket-img-del');
			Route::get('/mount-bracket-setup-update-video-del','Admin\Dashboard\SetUp\MountBracketController@mount_video_delete_fx')->name('admin.setup.mount-bracket-video-del');
			// 2. setup louvered panel
			Route::get('/lpanel-img-for-post-del-fx','Admin\Dashboard\PostWish\PostWishLpanelController@lpanel_img_delete_fx')->name('admin.lpanel-img-for-post-del-fx');
			Route::get('/lpanel-video-for-post-del-fx','Admin\Dashboard\PostWish\PostWishLpanelController@lpanel_video_delete_fx')->name('admin.lpanel-video-for-post-del-fx');
			// 3. setup canopy panel
			Route::get('/canopy-img-for-post-del-fx','Admin\Dashboard\PostWish\PostWishCanopyController@canopy_img_delete_fx')->name('admin.canopy-img-for-post-del-fx');
			Route::get('/canopy-video-for-post-del-fx','Admin\Dashboard\PostWish\PostWishCanopyController@canopy_video_delete_fx')->name('admin.canopy-video-for-post-del-fx');
		/// end of setup


		/// popup 
			/// 1. mount bracket
			Route::post('/popup-edit-mount-bracket-submit','Admin\Dashboard\SetUp\MountBracketController@editPopUpfx')->name('admin.setup.popup.edit-mount-bracket-submit');
			Route::post('/popup-add-mount-bracket-submit','Admin\Dashboard\SetUp\MountBracketController@addPopUpfx')->name('admin.setup.popup.add-mount-bracket-submit');
			Route::get('/popup-mount-bracket-window-edit-data','Admin\Dashboard\SetUp\MountBracketController@editWindowfx')->name('admin.popup.mount-bracket-window-edit-data');
			/// 2. canopy
			Route::post('/popup-edit-post-canopy-submit','Admin\Dashboard\PostWish\PostWishCanopyController@editPopUpfx')->name('admin.setup.popup.edit-post-canopy-submit');
			Route::post('/popup-add-post-canopy-submit','Admin\Dashboard\PostWish\PostWishCanopyController@addPopUpfx')->name('admin.setup.popup.add-post-canopy-submit');
			Route::get('/popup-post-canopy-window-edit-data','Admin\Dashboard\PostWish\PostWishCanopyController@editWindowfx')->name('admin.popup.post-canopy-window-edit-data');
			/// 3. louvered
			Route::post('/popup-edit-post-louvered-submit','Admin\Dashboard\PostWish\PostWishLpanelController@editPopUpfx')->name('admin.setup.popup.edit-post-louvered-submit');
			Route::post('/popup-add-post-louvered-submit','Admin\Dashboard\PostWish\PostWishLpanelController@addPopUpfx')->name('admin.setup.popup.add-post-louvered-submit');
			Route::get('/popup-post-louvered-window-edit-data','Admin\Dashboard\PostWish\PostWishLpanelController@editWindowfx')->name('admin.popup.post-louvered-window-edit-data');
		/// end of popup

		
		
	// end of dashboard panel
});
// end of admin routing

// user panel routing
Route::group(['prefix' => '/'], function(){
    
    Route::get('send-my-mail','FinalPageOneController@mailsending')->name('satirtha.send-my-mail');    Route::get('send-my-mail-footprint','FinalPageOneController@mailsendingFootprint')->name('satirtha.send-my-mail-footprint');
	// first page
	Route::get('/','Front\MainHomeController@index')->name('satirtha.home');
	Route::get('/get-master-wood-choose','Front\MainHomeController@choose_master_wood_fx')->name('satirtha.choose-master-wood');
	Route::get('/choose-master-wood-change','Front\MainHomeController@choose_master_wood_data_change_fx')->name('satirtha.choose-master-wood-change');

	Route::get('/get-master-width-choose','Front\MainHomeController@choose_master_width_fx')->name('satirtha.choose-master-width');
	Route::get('/get-master-width-new-choose','Front\MainHomeController@choose_master_width_new_session_fx')->name('satirtha.choose-master-new-width');
	Route::get('/get-master-height-choose','Front\MainHomeController@choose_master_height_fx')->name('satirtha.choose-master-height');
	Route::get('/get-master-height-new-choose','Front\MainHomeController@choose_master_height_new_session_fx')->name('satirtha.choose-master-new-height');
	Route::get('/get-master-post-choose','Front\MainHomeController@choose_master_post_fx')->name('satirtha.choose-master-post');
	Route::get('/get-master-post-new-choose','Front\MainHomeController@choose_master_post_new_session_fx')->name('satirtha.choose-master-new-session-post');

	Route::get('/get-master-width-change','Front\MainHomeController@change_master_width_fx')->name('satirtha.change-master-width');
	Route::get('/get-master-height-change','Front\MainHomeController@change_master_height_fx')->name('satirtha.change-master-height');

	Route::get('/choose-master-post-wish-price-frame','Front\MainHomeController@choose_master_post_wish_price_fx')->name('satirtha.choose-master-post-wish-price-frame');

	// master wood (Pick a footprint)
	Route::get('/pick-a-footprint-choose-wood-type','Front\MainHomeController@choose_master_wish_wood_fx')->name('satirtha.pick-a-footprint-choose-wood-type');

	// second page
	Route::get('/show-second-page-data','Front\MainHomeController@show_overheads_fx2')->name('satirtha.show-second-page-data');
	Route::get('/choose-second-page-data','Front\MainHomeController@choose_overheads_fx2')->name('satirtha.choose-second-page-data');

	// third page
	Route::get('/show-third-page-data','Front\MainHomeController@show_3d_video_fx3')->name('satirtha.show-third-page-data');

	// fourth page
	Route::get('/show-fourth-page-data','Front\MainHomeController@show_pick_post_length_fx4')->name('satirtha.show-fourth-page-data');
	Route::get('/choose-fourth-page-data','Front\MainHomeController@choose_pick_post_length_fx4')->name('satirtha.choose-fourth-page-data');

	// fifth page
	Route::get('/show-fifth-page-data','Front\MainHomeController@show_pick_post_mount_fx5')->name('satirtha.show-fifth-page-data');
	Route::get('/choose-fifth-page-data','Front\MainHomeController@choose_pick_post_mount_fx5')->name('satirtha.choose-pick-slap-fx5');
	Route::get('/choose-fifth-page-image-video','Front\MainHomeController@choose_pick_post_mount_video_image_fx5')->name('satirtha.bracket-mount-img-video');

	// sixth page
	Route::get('/show-sixth-page-data','Front\MainHomeController@show_pick_canopy_fx6')->name('satirtha.show-sixth-page-data');
	Route::get('/choose-sixth-page-image-video','Front\MainHomeController@choose_pick_post_canopy_video_image_fx6')->name('satirtha.post-canopy-img-video');

	// seventh page
	Route::get('/show-seventh-page-data','Front\MainHomeController@show_pick_lpanel_fx7')->name('satirtha.show-seventh-page-data');
	Route::get('/choose-seventh-page-image-video','Front\MainHomeController@choose_pick_post_lpanel_video_image_fx7')->name('satirtha.post-lpanel-img-video');
	
	// louvered panel pricing & details
	Route::get('/louvered-panel-yes-shown','Front\MainHomeController@show_louvered_panel_yes_fx')->name('satirtha.louvered-panel-yes-shown');
	
	// final page
	Route::get('/show-final-page-data','Front\MainHomeController@showFinalPage')->name('satirtha.show-final-page-data');

	// payment page
	Route::get('/payment','Front\PaymentHomeController@showPage')->name('satirtha.show-payment');
	Route::get('/payment-submit-panel','Front\PaymentHomeController@getDataFx')->name('satirtha.payment-submit-panel');
	Route::get('/payment-load-price-panel','Front\PaymentHomeController@get_final_pricelist')->name('satirtha.payment-load-price-panel');
	Route::get('/BeforeCheckoutFinalProduct','Front\BeforeCheckoutFinalProductController@saveData')->name('satirtha.BeforeCheckoutFinalProduct');

	// generate pdf
	Route::get('/generate-pdf','Front\BeforeCheckoutFinalProductController@generate_pdf')->name('satirtha.generate-pdf');
	
	Route::get('/generate-last-pdf','Front\BeforeCheckoutFinalProductController@generate_pdf_load')->name('satirtha.generate-last-pdf');
	
	// mail sending
    // Route::get('/send-my-mail','SendMailCOntroller@index')->name('satirtha.send-my-mail');
	Route::get('/email-form','SendMailCOntroller@show_send_mail_form_fx')->name('satirtha.email-form');


	/// paypal pay
	Route::get('/paypal-payment', 'PayPalController@index');
	// route for processing payment
	Route::post('paypal', 'PayPalController@payWithpaypal');
	// route for check status of the payment
	Route::get('status', 'PayPalController@getPaymentStatus');

	/// end of paypal pay
	/// back to home 
	Route::get('back-to-home-page','Front\backtohome\BackToHomeController@index')->name('satirtha.backToHomePage');
	Route::get('back-to-home-page-forget-session','Front\backtohome\BackToHomeController@forget_s_fx')->name('satirtha.forget-new-session-back-to-home');
	Route::get('show-page-loading-after-back','Front\backtohome\BackToHomeController@showPageRequest')->name('satirtha.show-page-loading-after-back');
	// back to home session panel show
	Route::get('main_pass_load_back_home_panel_session','Front\backtohome\BackToHomeController@backingRequestQuery')->name('satirtha.main_pass_load_back_home_panel_session');

	/// back to thank you
	Route::get('/thank-you','Front\backtohome\BackToHomeController@show_thankyou_fx')->name('satirtha.show-thank-you-page');
	/// thank you --- order details
	Route::get('/payment-order-admin','Front\backtohome\BackToHomeController@payment_order_admin_fx')->name('satirtha.payment-order-admin');

	/// error page --- order details
	Route::get('/error-page','Front\backtohome\BackToHomeController@show_errorpage_fx')->name('satirtha.show-error-page');


	/// wood page --- wood types
	Route::get('/wood-page','Front\MainHomeController@showWoodPage')->name('satirtha.final-wood-product-type');
	
	/// all length * width post
	Route::get('/master-panel-upper-view-fx','Front\MainHomeController@panel_upper_view_fx')->name('satirtha.master-panel-upper-view-fx');


});
