<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
   public $timestamps = false;
   protected $fillable = [
    'order_code' ,  'product_id' ,   'product_name' ,   'product_price' ,   'product_sales_quantity' ,' product_coupon' , ' product_fee ' /* Trường Trong Bảng */
   ]; 
   protected $primaryKey =  'order_details_id  '; /* Khóa Chính */
   protected $table =   'tbl_order_details'; /* Tên Bảng */

   public function product(){
      return $this->belongsTo('App\Models\Product','product_id');
   }
}