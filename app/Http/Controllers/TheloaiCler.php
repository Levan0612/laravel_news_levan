<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Theloai;

class TheloaiCler extends Controller
{
    public function getDanhSach()
    {
    	//lấy tất cả từ model
    	$data = Theloai::all();
    	// lấy tất cả danh sách Thể loại -> view('admin.Theloai.danhsach')
    	return view('admin.Theloai.danhsach',['DsTheLoai' => $data]);
    }

    public function getThem()
    {
    	return view('admin.theloai.them');
    }

     public function postThem(Request $req)
    {	
    	
    	$this->validate($req,			//hàm bắt lỗi dũ liệu
    		[
    			'Ten'	=> 'required|min:3|max:100|unique:Theloai,Ten'
    		],
    		[
    			'required'	=> 'Vui lòng nhập tên thể loại',
    			'min'		=> 'Độ dài ký tự phải lớn hơn 3 và nhỏ hơn 100',
    			'max'		=> 'Độ dài ký tự phải lớn hơn 3 và nhỏ hơn 100',
    			'unique' 	=> 'Tên thể loại đẫ tồn tại'
    		]
    	);
    	
    	//Tạo model thể loại;
    	$theloai = new Theloai();
    	$theloai->Ten = $req->Ten;
    	$theloai->TenKhongDau = changeTitle($req->Ten);
    	//$theloai->created_at = new datetime(); cái này tự tạo
    	//lưu vào cơ sở dữ liệu 
    	$theloai->save();
    	return redirect('admin/theloai/them')->with('Thongbao','Đã thêm thành công');
    // }
    }

    public function getSua($id)
    {
    	$theloai = Theloai::find($id);
    	return view('admin.theloai.sua',['theloai' => $theloai]);
    }

    public function postSua(Request $req,$id)
    {
    	$theloai = Theloai::find($id);
    	$this->validate($req,
    		[
    			'Ten' => 'required|unique:Theloai,Ten|min:3|max:100'
    		],
    		[
    			'requierd' 	=> 'Bạn chưa nhập tên thể loại',
    			'unique' 	=> 'Tên thể loại đẫ tồn tại',
    			'min'		=> 'Độ dài ký tự phải lớn hơn 3 và nhỏ hơn 100',
    			'max'		=> 'Độ dài ký tự phải lớn hơn 3 và nhỏ hơn 100'
    		]
    	);
    	$theloai->Ten = $req->Ten;
    	$theloai->TenKhongDau = changeTitle($req->Ten);
    	$theloai->save();

    	return redirect('admin/theloai/sua/'.$theloai->id)->with('thongbao','Sửa Thành công');
    }

    public function getXoa($id)
    {
    	//yêu cầu model tìm thằng có id cần xóa
    	$theloai = Theloai::find($id);
    	$theloai->delete();
    	return redirect('admin/theloai/danhsach')->with('thongbao','Xóa thể loại thành công');
    }



}
