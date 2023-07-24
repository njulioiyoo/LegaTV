<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShareCount extends Model
{
    protected $table   = 'share_counts';
    protected $fillable = [
        'content_id',
        'social_media',
        'count'
    ];
}
