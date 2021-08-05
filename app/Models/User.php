<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    use HasFactory;

    public $fillable = ['name', 'email', 'date_of_birth', 'is_active'];

    /**
     * @return HasMany
     */
    public function phone_numbers(): HasMany
    {
        return $this->hasMany(UserPhone::class);
    }
}
