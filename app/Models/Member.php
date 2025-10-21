<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'tbl_member'; // Use the imported table
    protected $primaryKey = 'id'; 
    public $timestamps = false; // old table doesn’t have timestamps

    protected $fillable = [
        'name',
        'organization',
        'email',
        'phone',
        'county',
        'thematicgroup',
    ];
}

