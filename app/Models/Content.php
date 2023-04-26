<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $table   = 'contents';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'author');
    }

    public function parent()
    {
        return $this->belongsTo(ContentType::class, 'parent_id');
    }
}
