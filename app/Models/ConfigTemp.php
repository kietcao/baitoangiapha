<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigTemp extends Model
{
    use HasFactory;

    protected $table = 'config_temp';

    protected $fillable = [
        'id',
        'template_id',
        'title',
    ];
}
