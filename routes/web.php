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
use App\TestModel;
use App\Theloai;

Route::get('/', function () {
    return view('welcome');
});
//tạo 1 route tên là queryBuilder
//để in ra User cso id = 1trong bảng Test
Route::get('QueryBuilder',function(){
	$result = DB::table('Test')->where('id',1)->value('Name');
	var_dump($result);
});

Route::get('TestModel',function(){
	echo TestModel::find(1)->name;
});

Route::get('test_get_Loaitin_from_Theloai/{n}',function($n){
	//in ra tên của tất cả các loại tin thuộc thể loại xã hội. (1);
	//1: lấy thể loại
	$tl = Theloai::find($n);
	echo 'Tên thể loại: '.$tl->Ten."<br/><br/>";
	//2: lấy danh sách tin tức của thể loại trên
	$ltlist = $tl->loaitin;
	//var_dump($ltlist);
	//3: lấy từng loại tin trong danh sách trên
	foreach ($ltlist as $loaitin) {
		echo $loaitin->Ten."<br/>";
	}
});

// test hiển thị trang admin
Route::get('test_admin',function(){
	return view('admin.loaitin.danhsach');
});

Route::group(['prefix'=>'admin'],function(){
	Route::group(['prefix'=>'theloai'],function(){
		//admin/theloai/sua...
		Route::get('danhsach','TheloaiCler@getDanhSach');

		Route::get('sua/{id}','TheloaiCler@getSua');
		Route::post('sua/{id}','TheloaiCler@postSua');

		Route::get('them','TheloaiCler@getThem');
		Route::post('postthem','TheloaiCler@postThem');

		Route::get('xoa/{id}','TheloaiCler@getXoa');
		
	});
	Route::group(['prefix'=>'loaitin'],function(){
		//admin/theloai/sua...
		Route::get('danhsach','LoaitinCler@getDanhSach');

		Route::get('sua/{id}','LoaitinCler@getSua');
		Route::post('sua/{id}','LoaitinCler@postSua');

		Route::get('them','LoaitinCler@getThem');
		Route::post('postthem','LoaitinCler@postThem');

		Route::get('xoa/{id}','LoaitinCler@getXoa');
		
	});

	Route::group(['prefix'=>'tintuc'],function(){
		//admin/theloai/sua...
		Route::get('danhsach','TintucCler@getDanhSach');

		Route::get('sua/{id}','TintucCler@getSua');
		Route::post('sua/{id}','TintucCler@postSua');

		Route::get('them','TintucCler@getThem');
		Route::post('postthem','TintucCler@postThem');

		Route::get('xoa/{id}','TintucCler@getXoa');
		
	});

	Route::group(['prefix' => 'ajax'],function(){
		Route::get('loaitin/{idTheLoai}','AjaxCler@getLoaiTin');
	});


	Route::group(['prefix'=>'slide'],function(){
		Route::get('danhsach','SlideController@getDanhsach');

		Route::get('sua/{id}','SlideController@getSua');
		Route::post('sua/{id}','SlideController@postSua');

		Route::get('them','SlideController@getThem');
		Route::post('them','SlideController@postThem');

		Route::get('xoa/{id}','SlideController@getXoa');

	});
});