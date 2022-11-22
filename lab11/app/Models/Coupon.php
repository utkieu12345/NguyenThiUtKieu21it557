<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
   public $timestamps = false;
   protected $fillable = [
    'coupon_name' ,  'coupon_name_code' ,   'coupon_qty_code' ,   'coupon_condition' ,   'coupon_price_sale'  /* Trường Trong Bảng */
   ]; 
   protected $primaryKey =  'coupon_id'; /* Khóa Chính */
   protected $table =   'tbl_coupon'; /* Tên Bảng */
}
