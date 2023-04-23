<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use Orchid\Attachment\Attachable;
use App\Orchid\Presenters\UserPresenter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Content
{
    use HasFactory, AsSource, Attachable;

    public function user()
    {
        return $this->belongsTo(User::class, 'author');
    }

    public function parent()
    {
        return $this->belongsTo(ContentType::class, 'parent_id');
    }

    /**
     * @return UserPresenter
     */
    public function presenter()
    {
        return new UserPresenter($this);
    }

    protected static function boot()
    {
        parent::boot();
        $type = 'news';

        static::addGlobalScope('', function (Builder $builder) use ($type) {
            $builder->where('type', $type);
        });

        self::creating(function ($model) use ($type) {
            $model->type = $type;
        });
    }
}
