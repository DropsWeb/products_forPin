<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeStatusAvailable($query) {
        return $query->where('status', 'available')->get()->sortBy('id');
    }
}
