<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Theloai;
class Loaitin extends Model
{
    protected $table = 'loaitin';
    public function theloai(){
    	return $this->belongsTo('App\Theloai','idTheLoai','id');
    }
}
