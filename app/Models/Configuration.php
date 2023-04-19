<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $primaryKey = 'key';
    protected $table   = 'configurations';
    public $timestamps = false;
    protected $fillable = [
        'key',
        'value',
    ];
    // menonaktifkan incrementing
    public $incrementing = false;
}
