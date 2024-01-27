<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{

    protected $table = 'listing';

    use HasFactory;

    protected $fillable = [
        'name',
        'longitude',
        'latitude',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
