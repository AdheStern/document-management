<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'name', 'type', 'state', 'content', 'user_id', 'reception_at', 'delivery_at', 'deadline'
    ];
}
