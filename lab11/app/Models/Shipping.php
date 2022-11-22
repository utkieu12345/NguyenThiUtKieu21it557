<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
   public $timestamps = false;
   protected $fillable = [
    'shipping_name' ,  'shipping_email' ,   'shipping_phone' ,   'shipping_address' ,   'shipping_notes' ,' shipping_menthod' /* Trường Trong Bảng */
   ]; 
   protected $primaryKey =  'shipping_id '; /* Khóa Chính */
   protected $table =   'tbl_shipping'; /* Tên Bảng */
}