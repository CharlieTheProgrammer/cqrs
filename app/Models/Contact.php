<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Laravel assumes PK is an auto-incrementing integer. This means toArray returns 0.
    // Overriding because I'm using UUID
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillables = ['id', 'type', 'details'];
}
