<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'amount', 'deposit_option_id', 'status'];

    // Relationship with User and DepositOption models
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function depositOption()
    {
        return $this->belongsTo(DepositOption::class);
    }

    // Mutator method to calculate current_amount based on status
    public function getCurrentAmountAttribute()
    {
        if ($this->status) {
            $time = now()->diffInHours($this->created_at);
            $interest = ($this->amount * $time * 25) / 100;
            return $this->amount + $interest;
        }
        return null;
    }

    // Mutator method to calculate available_amount based on status
    public function getAvailableAmountAttribute()
    {
        if ($this->status) {
            $time = now()->diffInHours($this->created_at);
            $interest = ($this->amount * $time * 25) / 100;
            return $this->amount + $interest - $this->amount;
        }
        return null;
    }
}
