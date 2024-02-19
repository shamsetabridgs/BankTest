<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositOption extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
}
