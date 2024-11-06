<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depreciation extends Model
{
    protected $table = 'tbldepreciationdatail';
    protected $primaryKey = 'depreid';
    protected $fillable = [
        'depreid', 'cusid', 'principal', 'interest_month', 'paid_date', 'clear_date', 'clear_by_userid'
    ];
    use HasFactory;
}
