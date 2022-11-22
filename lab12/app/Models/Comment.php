<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = false;
    protected $fillable = [
    'comment_title' ,  'comment_content' ,  'comment_customer_id' ,  'comment_customer_name',
   ]; 
   protected $primaryKey =  'comment_id'; /* Khóa Chính */
   protected $table =   'tbl_comment'; /* Tên Bảng */
}
