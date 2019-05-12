<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loaitin;
use App\Theloai;

class LoaitinCler extends Controller
{
    public function getDanhSach()
    {
    	//lấy tất cả từ model
    	$data = Loaitin::all();
    	// lấy tất cả danh sách Thể loại -> view('admin.Loaitin.danhsach')
    	return view('admin.loaitin.danhsach',['DsLoaiTin' => $data]);
    }

    public function getThem()
    {
    	$dsTheLoai = Theloai::all();
        return view('admin.loaitin.them',['dsTheLoai' => $dsTheLoai]);
    }

     public function postThem(Request $req)
    {	
    	
    	$this->validate($req,			//hàm bắt lỗi dũ liệu
    		[
    			'Ten'	=> 'required|min:3|max:100|unique:Loaitin,Ten',
                'TheLoai' => 'required' // TheLoai là tên ở trang thêm, nếu sai tên sẽ báo lỗi
    		],
    		[
    			'Ten.required'	=> 'Vui lòng nhập tên loại tin',
    			'Ten.min'		=> 'Độ dài ký tự phải lớn hơn 3 và nhỏ hơn 100',
    			'Ten.max'		=> 'Độ dài ký tự phải lớn hơn 3 và nhỏ hơn 100',
    			'Ten.unique' 	=> 'Tên loại tin đẫ tồn tại',
                'TheLoai.required'  => 'Vui lòng chọn thể loại'
    		]
    	);
    	
    	//Tạo model loại tin;
    	$loaitin = new Loaitin();
    	$loaitin->Ten = $req->Ten;
    	$loaitin->TenKhongDau = changeTitle($req->Ten);
    	//$loaitin->created_at = new datetime(); cái này tự tạo
    	//lưu vào cơ sở dữ liệu
        $loaitin->idTheLoai = $req->TheLoai;
    	$loaitin->save();
    	return redirect('admin/loaitin/them')->with('Thongbao','Đã thêm thành công');
    // }
    }

    public function getSua($id)
    {
    	$loaitin = Loaitin::find($id);
        $dsTheLoai = Theloai::all();
    	return view('admin.loaitin.sua',['loaitin' => $loaitin,'dsTheLoai'=>$dsTheLoai]);
    }

    public function postSua(Request $req,$id)
    {
    	$loaitin = Loaitin::find($id);
    	$this->validate($req,
    		[
    			'Ten' => 'required|min:3|max:100'
    		],
    		[
    			//'requierd' 	=> 'Bạn chưa nhập tên loại tin',
    			'unique' 	=> 'Tên loại tin đẫ tồn tại',
    			'min'		=> 'Độ dài ký tự phải lớn hơn 3 và nhỏ hơn 100',
    			'max'		=> 'Độ dài ký tự phải lớn hơn 3 và nhỏ hơn 100'
    		]
    	);
    	$loaitin->Ten = $req->Ten;
    	$loaitin->TenKhongDau = changeTitle($req->Ten);
        $loaitin->idTheLoai = $req->TheLoai;
    	$loaitin->save();

    	return redirect('admin/loaitin/sua/'.$loaitin->id)->with('thongbao','Sửa Thành công');
    }

    public function getXoa($id)
    {
    	//yêu cầu model tìm thằng có id cần xóa
    	$loaitin = Loaitin::find($id);
    	$loaitin->delete();
    	return redirect('admin/loaitin/danhsach')->with('thongbao','Xóa loại tin thành công');
    }



}
