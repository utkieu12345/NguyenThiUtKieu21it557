<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
   public $timestamps = false;
   protected $fillable = [
    'customer_name' ,  'customer_email' ,   'customer_email' ,   'customer_sdt' , /* Trường Trong Bảng */
   ]; 
   protected $primaryKey =  'customer_id'; /* Khóa Chính */
   protected $table =   'tbl_customers'; /* Tên Bảng */
}