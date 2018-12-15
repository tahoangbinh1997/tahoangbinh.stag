<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoStudent extends Model
{
	protected $table = 'info_students';
    protected $fillable = ['id','hoten','gioitinh','ngaysinh','sdt','diachi'];
}
