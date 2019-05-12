<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theloai extends Model
{
    protected $table = 'theLoai';

    //với 1 thể loại nào đó
    //có thể lấy đc tất cả các loại tin thuộc thể lạo này
    //? cho thể loại => hãy lấy tất cả loại tin thuộc thể laoij này
    public function loaitin(){
    	return $this->hasMany('App\Loaitin','idTheLoai','id');//model,khóa ngoại, khóa chính
    }
}
