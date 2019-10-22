<?php

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

//------------Original------------
Route::get('/', function () {
	return view('welcome');
});

//------------------------------------------------------------------------
//------------ Route Get ------------
//------------------------------------------------------------------------

//------------ hello ------------
Route::get('hello', function () {
	//echo 'Hello World!';
	return 'Hello World!';
});

//------------ user ------------
Route::get('user/{id}/{name}', function ($id, $name) {
	//id、name必填
	return 'User '.$name.$id;
})->where(['id' => '[0-9]+', 'name' => '[a-z]+']); //正則表示式定義參數格式

//------------ userid ------------
Route::get('userid/{_id}', function ($_id) {
	//_id必填
	//整個class的 _id變數 都只能輸入數字 定義在：app/Http/Providers/RouteServiceProvider.php boot()
	return 'Hello! '.$_id;
});

//------------ username ------------
Route::get('username/{_name?}', function ($_name = null) { // function ($name = 'John') {
	//_name可不填，不填則代預設值
	return 'Hi! '.$_name;
})->name('RouteName1');

//------------ testrn ------------
Route::get('testrn', function () {
	//回傳 username 的 http url
	$url = route('RouteName1');
	return $url;
});

//------------ testred ------------
Route::get('testred/{_num?}', function ($_num = 1) {
	//redirect username 的 http url
	if($_num==1){
		return redirect() -> route('RouteName2', ['_var' => 'RouteName2']);
	}else{
		return redirect() -> route('RouteName1', ['_name' => 'Stranger']);
	}
});

//------------------------------------------------------------------------
//------------ Route Get End------------
//------------------------------------------------------------------------


//------------------------------------------------------------------------
//------------ Middleware ------------
//------------------------------------------------------------------------
//先用cmd: php artisan make:middleware filename 創建middleware檔案，在Kernel.php設定完後才能使用

Route::group(['middleware' => 'before:varstring', 'after'], function () {
	//看起來這樣寫無法before跟after同時跑 -> 可能要用middlewareGroups，此處語法改成['middleware' => ['name']]
	Route::get('midware', function () {
		// Uses bofre Middleware
		echo 'web: midware';
	});

	Route::get('midware/{_var}', function ($_var) {
		// Uses before Middleware
		return 'web: midware/'.$_var;
	})->name('RouteName2');
});

//------------ middlewareGroups ------------
Route::group(['middleware' => ['midgroup']], function () {
	//呈上，用middlewareGroups --->怎麼代參數？？？？？？？？？？？？？？？？？？？？？
	Route::get('midwaregroup', function () {
		//結果與midware2相同
		echo 'web: midwaregroup';
	});
});

//------------ 呼叫方式 ------------
Route::middleware('after', 'before:mid')->get('midware2', function () {
	//此處例子不論哪個middleware放前面，都不會影響結果
	//!!! 如果同樣都是在before做的話，會有呼叫順序差 !!!
    echo 'web: midware2';
});

Route::get('midware3/{_var}', function ($_var) {
    echo 'web: midware3';
})->middleware('after', 'before:$_var'); //怎麼代參數？？？？？？？？？？？？？？？？？？？？？

/*
Route::get('midware3/{_var?}', function ($_var = null) {
    echo 'web: midware3';
})->middleware('after', 'before');
*/

Route::get('midware4', ['middleware' => ['after', 'before:midware4'], function () {
    echo 'web: midware4';
}]);

//
Route::get('midwareold/{_age?}', function ($_age = null) {
    echo 'web: midwareold';
})->middleware('old'); //失敗.......
//------------------------------------------------------------------------
//------------ Middleware End ------------
//------------------------------------------------------------------------


//------------------------------------------------------------------------
//------------ group Namespace ------------
//------------------------------------------------------------------------
//namespace
Route::group(['namespace' => 'Admin'], function () {

	Route::get('1', function ()    {
		// Controllers Within The "App\Http\Controllers\Admin" Namespace
		return 'It\'s 1!';
	});

});
//------------------------------------------------------------------------
//------------ group Namespace End ------------
//------------------------------------------------------------------------

//as
Route::group(['as' => 'admin::'], function () {
    Route::get('dashboard', ['as' => 'dashboard', function () {
        // 路由名稱為「admin::dashboard」
        return 'as test';
    }]);
});

//domain
Route::group(['domain' => 'testmyappd.com'], function () {
    Route::get('123', function () {
        return 'test domain';
    });
});

//------------------------------------------------------------------------
//------------ Prefix 為群組中每個路由加上給定的 URI 前綴 ------------
//------------------------------------------------------------------------
Route::group(['prefix' => 'api/{_accid}'], function () {
    Route::get('users', function ($_accid)    {
        //與單獨呼叫 Route::get('api/{accid}/user', function (){}); 一樣
        return 'accid: '.$_accid;
    });
});
//------------------------------------------------------------------------
//------------ Prefix End ------------
//------------------------------------------------------------------------

//------------------------------------------------------------------------
//------------ Controller ------------
//------------------------------------------------------------------------
//php artisan make:controller filename --resource 創建controller檔案，路徑在"App\Http\Controllers"

Route::get('midcon/admin/{name}', 'middleController@sayHiToAdmin');
Route::get('midcon/show/{id}', 'middleController@show');

Route::resource('midcon', 'middleController', ['only' => [
    'sayHiToAdmin', 'show'
]]);
//------------------------------------------------------------------------
//------------ Controller End ------------
//------------------------------------------------------------------------

