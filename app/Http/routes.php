<?php

/*
  |--------------------------------------------------------------------------
  | Routes File
  |--------------------------------------------------------------------------
  |
  | Here is where you will register all of the routes in an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | This route group applies the "web" middleware group to every route
  | it contains. The "web" middleware group is defined in your HTTP
  | kernel and includes session state, CSRF protection, and more.
  |
 */
use App\User;
use App\Setting;
use App\Role;
use App\Feature;
use App\Package;
use App\Page;
use App\Menu;
use App\Order;
use App\Payment;
use App\Deposit;
use App\Exchange;
use App\Logistic;
use App\Category;

Route::model('users', User::class);
Route::model('settings', Setting::class);
Route::model('roles', Role::class);
Route::model('packages', Package::class);
Route::model('features', Feature::class);
Route::model('pages', Page::class);
Route::model('menus', Menu::class);
Route::model('orders', Order::class);
Route::model('payments', Payment::class);
Route::model('logistics', Logistic::class);
Route::model('deposits', Deposit::class);
Route::model('exchanges', Exchange::class);
Route::model('categories', Category::class);

Route::group(['middleware' => ['web']], function () {
    Route::get('/page/{slug}', 'FrontendController@staticPages');
    Route::get('admin/edit-post/{id}', 'Admin\DepositsController@editblogpost');
    Route::post('admin/edit-post-save/{id}', 'Admin\DepositsController@editsaveblogpost');

    Route::get('admin/posts/create', 'Admin\DepositsController@createnewpost');
    Route::get('admin/destroy-post/{id}', 'Admin\DepositsController@destroypost');
    Route::post('admin/save-new-post', 'Admin\DepositsController@savenewpost');

    Route::get('/clear-cache', function () {
        $exitCode = Artisan::call('cache:clear');
        // return what you want
    });

    Route::get('/', 'FrontendController@allin_enter');
    Route::get('/ondemandstorage', 'FrontendController@index');
    Route::get('/selfstorage', 'FrontendController@self_storage');
    Route::get('/updateboxnameajax', 'MemberController@updateboxnameajax');
    Route::post('/updateboximgajax', 'MemberController@updateboximgajax');

    Route::get('/booking/{step?}', 'MemberController@booking_page');
    Route::post('/booking/{step?}', 'MemberController@booking');

    Route::post('/new-user-coupon', 'Admin\CouponController@newusercoupon');
    Route::post('/normal-user-coupon', 'Admin\CouponController@normalusercoupon');

    Route::get('/pricing', 'FrontendController@pricing');

    /**
    * New MemberController
    */
    Route::get('/schedule-pickup', 'NewMemberController@schedule_pickup_get');
    Route::post('/schedule-pickup', 'NewMemberController@schedule_pickup_post');
    Route::post('/schedule-pickup-post', 'NewMemberController@schedule_pickup_post');

    Route::get('/schedule-item', 'NewMemberController@schedule_item_get');
    Route::post('/schedule-item', 'NewMemberController@schedule_item_post');
    Route::post('/schedule-item-post', 'NewMemberController@schedule_item_post');

    Route::get('/schedule-new-box', 'NewMemberController@schedule_new_box');
    Route::get('/schedule-new-box/confirm', 'NewMemberController@schedule_new_box');
    Route::post('/schedule-new-box', 'NewMemberController@schedule_new_box');
    Route::post('/schedule-new-box/confirm', 'NewMemberController@schedule_new_box');
    Route::get('checkout', 'NewMemberController@checkout');
    Route::get('/schedule-pickup-large', 'NewMemberController@schedule_pickup_get');
    //Route::post('/schedule-pickup-large', 'NewMemberController@schedule_pickup_large');

    /**
    * Orig MemberController
    */
    Route::get('/deposit', 'MemberController@deposit');

    Route::get('/components', 'FrontendController@components');

    Route::get('/contact-us', 'FrontendController@contactUs');
    //Route::get('/view-finder', 'FrontendController@viewfinder');
    Route::get('/ipano', 'FrontendController@ipano');

    Route::get('/latest-news', 'BlogController@index');
    Route::get('/blog/{id}', 'BlogController@getSingle');
    Route::post('/check-coupon-ajax', 'CouponController@couponcheckajax');

    Route::post('/contact-us', 'FrontendController@contactUsSubmit');

    Route::get('resendVerify', 'FrontendController@resendVerify');
    Route::post('resendVerify', 'FrontendController@resendVerifyAction');

    Route::get('testAlert', 'FrontendController@testAlert');

    Route::get('/blog', 'FrontendController@blog');

    Route::get('/blog/{slug}', 'FrontendController@post');

    Route::post('stripe/webhook', '\Laravel\Cashier\WebhookController@handleWebhook');

    Route::get('package/subscribe/{id_package}', 'SubscriptionController@initPackages');
    Route::post('package/subscribe/{id_package}/success', 'SubscriptionController@packageSubscriptionCapture');
    Route::get('/deposit/success', 'SubscriptionController@packageSubscriptionCapture');
    Route::post('/deposit/success', 'SubscriptionController@packageSubscriptionCapture');

    //Route::get('package/subscribe/success', 'SubscriptionController@packageSubscriptionCapture');
    Route::get('payment-return', 'SubscriptionController@packageSubscriptionCapture');
    Route::post('payment-return', 'SubscriptionController@packageSubscriptionCapture');

    Route::post('package/subscribe/success', 'SubscriptionController@packageSubscriptionCapture');

    Route::get('payment-success', 'SubscriptionController@subscriptionCapture');
    Route::post('payment-success', 'SubscriptionController@subscriptionCapture');
    Route::post('payment-success-notify', 'SubscriptionController@subscriptionCaptureTwo');
});

Route::group(['middleware' => ['web','auth.check_user']], function () {
    /**
     * Authentication routes
     */
    Route::get('auth/login/{provider?}', [
        'uses' => 'Auth\FacebookController@getSocialAuth',
        'as' => 'auth.getSocialAuth'
    ]);

    Route::get('auth/login/callback/{provider?}', [
        'uses' => 'Auth\FacebookController@getSocialAuthCallback',
        'as' => 'auth.getSocialAuthCallback'
    ]);

    Route::post('password/create', [
        'uses' => 'Auth\FacebookController@postcreatepassword',
        'as' => 'auth.password.create'
    ]);

    //Route::post('login', 'Auth\AuthController@authenticate');

    Route::get('new-user', 'MemberController@new_user');
    Route::post('post_user', 'MemberController@postnew_user');

    Route::auth();

    Route::post('password/emailreset', 'Auth\ResetpasswordController@emailreset');


    Route::get('user/activation/{token}', 'Auth\AuthController@activateUser')->name('user.activate');
    /**
     * Admin routes
     */
    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
        Route::controllers([
            'datatables' => 'Admin\DatatablesController',
        ]);

        Route::get('/dashboard', 'Admin\DashboardController@index');

        // Top Bar News
        Route::get('/top-bar-news', 'Admin\DepositsController@edittopbarnews');
        Route::post('/save-top-news', 'Admin\DepositsController@savetopbarnews');

        Route::resource('orders', 'Admin\OrdersController');
        Route::resource('logistics', 'Admin\LogisticsController');

        Route::resource('coupon', 'Admin\CouponController');

        Route::get('getcoupon', function (Request $request) {
            $coupon = $request->get('coupon');
            $cdata = DB::table('coupon')->where('code', $coupon)->first();
            if (count($cdata) > 0) {
                return response()->json(['status' => 'false' , 'message' => $cdata->point ]);
            } else {
                return response()->json(['status' => 'false' , 'message' => 'Not found coupon.']);
            }
        });

        Route::resource('payments', 'Admin\PaymentsController');
        Route::resource('deposits', 'Admin\DepositsController');
        Route::resource('exchanges', 'Admin\ExchangesController');
        Route::resource('categories', 'Admin\CategoriesController');

        Route::resource('users', 'Admin\UsersController');

        Route::get('/user/{user_id}/sendCreditNotify', 'Admin\UsersController@sendCreditNotify');

        Route::get('settings/create/{type}', ['as' => 'admin.settings.create.type', 'uses' => 'Admin\SettingsController@createForm']);
        Route::get('settings/download/{settings}', ['as' => 'admin.settings.download', 'uses' => 'Admin\SettingsController@fileDownload']);
        Route::resource('settings', 'Admin\SettingsController');

        Route::resource('roles', 'Admin\RolesController');

        Route::resource('features', 'Admin\FeaturesController');

        Route::resource('packages', 'Admin\PackagesController');

        Route::resource('pages', 'Admin\PageController');

        Route::resource('menus', 'Admin\MenusController');

        Route::get('adminMenus', 'Admin\AdminMenusController@index');
        Route::post('adminMenus', 'Admin\AdminMenusController@index');

        Route::get('frontpages/{id}', 'Admin\DashboardController@frontpages');
        Route::post('frontpages', 'Admin\DashboardController@update_frontpages');
    });

    /**
     * Member routes
     */
    Route::group(['prefix' => 'member'], function () {
        Route::controllers([
            'subscription' => 'SubscriptionController'
        ]);

        Route::post('/referrals/send/', 'ReferralController@send')->name('send-referral');
        Route::post('/referrals/apply/', 'ReferralController@apply')->name('apply-referral');

        Route::get('/home', ['as' => 'member.home', 'uses' => 'MemberController@index']);

        Route::get('/myinfo', ['as' => 'member.myinfo', 'uses' => 'MemberController@userinfo']);

        /**
        * New MemberController
        */
        Route::get('/warehouse', ['as' => 'member.warehouse-new', 'uses' => 'NewMemberController@schedule_pickup_exp']);
        Route::get('/warehouse/back', ['as' => 'member.warehouse-new', 'uses' => 'NewMemberController@schedule_pickup_exp_back']);
        Route::get('/m/warehouse', ['as' => 'member.warehouse-old', 'uses' => 'NewMemberController@warehouse']);
        Route::post('/warehouse', ['as' => 'member.warehouse-new', 'uses' => 'NewMemberController@schedule_pickup_post']);
        Route::get('/comeinsoon', ['as' => 'member.warehouse-new', 'uses' => 'NewMemberController@warehouse']);
        //Route::get('/warehouse1', ['as' => 'member.warehouse-new', 'uses' => 'MemberController@schedule_pickup_exp']);
        //Route::get('/warehouse2', ['as' => 'member.warehouse.child', 'uses' => 'MemberController@warehouse_child']);

        Route::post('/home', 'MemberController@updateProfile2');

        Route::get('/profile/changepassword', ['as' => 'member.profile.changepassword', 'uses' => 'MemberController@changepassword']);
        Route::get('/pricing', ['as' => 'member.pricing', 'uses' => 'MemberController@pricing']);
        Route::get('/profile', ['as' => 'member.profile', 'uses' => 'MemberController@profile']);
        Route::get('/profile/edit', ['as' => 'member.profile.edit', 'uses' => 'MemberController@editProfile']);
        Route::put('/profile', ['as' => 'member.profile.update', 'uses' => 'MemberController@updateProfile']);
    });

    Route::get('sitemap', function () {

        // create new sitemap object
        $sitemap = App::make("sitemap");

        // set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
        // by default cache is disabled
        $sitemap->setCache('laravel.sitemap', 1440);

        // check if there is cached sitemap and build new only if is not
        if (!$sitemap->isCached()) {
            $posts = DB::table('pages')->orderBy('created_at', 'desc')->get();

            // add every post to the sitemap
            foreach ($posts as $post) {
                if ($post->blog_post == 1) {
                    $slug = "blog/".$post->slug;
                } elseif ($post->blog_post == 0) {
                    $slug = "page/".$post->slug;
                } elseif ($post->blog_post == 2) {
                    $slug = "/";
                }
                $sitemap->add(URL::to($slug), $post->updated_at, '0.9', 'daily');
            }
        }

        return $sitemap->render('xml');
    });
});
