<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inmate extends Model
{
    use HasFactory;
    public $fillable = ['inmate_name','inmate_fname','inmate_rpno','inmate_blockno','inmate_photo','inmate_dob','inmate_accno','inmate_balance','inmate_created_id'];
}
