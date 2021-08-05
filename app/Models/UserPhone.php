<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserPhone extends Model
{
    use HasFactory;

    protected $fillable = ['phone_number', 'is_default'];

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->belongsTo(User::class);
    }
}
