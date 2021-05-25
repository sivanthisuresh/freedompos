<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventlog extends Model
{
    use HasFactory;
    public $fillable = ['eventlog_user_id','eventlog_type','eventlog_desc'];
}
