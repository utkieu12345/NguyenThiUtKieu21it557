<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   public $timestamps = false;
   protected $fillable = [
    'product_name' ,  'category_id' ,   'brand_id' ,   'product_desc' ,   'product_content' ,
    'product_price' , 'product_image' , 'product_status' ,/* Trường Trong Bảng */
   ]; 
   protected $primaryKey =  'product_id'; /* Khóa Chính */
   protected $table =   'tbl_product'; /* Tên Bảng */
}