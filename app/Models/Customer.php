<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

class Customer extends Model
{
    protected $table = 'tblcustomer';
    protected $primaryKey = 'cusid';
    protected $fillable = [
        'cusid', 'cusname', 'custtel', 'idcard', 'cusaddress', 'productname', 'photo', 'product_price', 'interest', 'duration', 'create_date'
    ];
    use HasFactory;
}
