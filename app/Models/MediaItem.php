<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug', 
        'type',
        'file', // Make sure this is here
        'order',
        'route_name'
    ];
}