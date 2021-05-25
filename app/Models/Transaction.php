<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    public $fillable = ['transaction_inmate_id', 'transcation_type','transcation_mode','transcation_amt','transcation_bal','transcation_user_id'];
}
