<?php

namespace App\Helpers;

use App\Models\Configuration;
use App\Models\News;
use App\Models\Partnership;
use App\Models\Program;
use Illuminate\Support\Facades\DB;

class CommonHelper
{
    public static function getPopularNews($slug, $limit = 5)
    {
        return News::where([
            ['active', '=', 1],
            ['slug', '!=', $slug]
        ])
            ->with('user:id,name,email', 'parent:id,name')
            ->orderBy('viewed', 'desc')
            ->take($limit)
            ->get(['name', 'slug', 'image', 'source', 'description', 'body', 'author', 'parent_id', 'created_at']);
    }

    public static function getLatestNews($slug, $limit = 5)
    {
        return News::where([
            ['active', '=', 1],
            ['slug', '!=', $slug]
        ])
            ->with('user:id,name,email', 'parent:id,name')
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get(['name', 'slug', 'image', 'source', 'description', 'body', 'author', 'parent_id', 'created_at']);
    }

    public static function getConfigurations()
    {
        return Configuration::pluck('value', 'key')->all();
    }

    public static function getPopularProgram($slug, $limit = 5)
    {
        return Program::where([
            ['active', '=', 1],
            ['slug', '!=', $slug]
        ])
            ->with('user:id,name,email', 'parent:id,name')
            ->orderBy('viewed', 'desc')
            ->take($limit)
            ->get(['name', 'slug', 'image', 'source', 'body', 'author', 'parent_id', 'attr_1 as duration', 'created_at']);
    }

    public static function getBrowseProgramLiveTV()
    {
        return Program::where([
            ['active', '=', 1],
            ['is_shared_to_live', '=', 1]
        ])->with('user:id,name,email', 'parent:id,name')
            ->orderBy('viewed', 'desc')
            ->get(['name', 'slug', 'image', 'source', 'body', 'author', 'parent_id', 'attr_1 as duration', 'created_at']);
    }

    public static function getLiveNews()
    {
        return News::where([
            ['active', '=', 1],
            ['is_shared_to_live', '=', 1]
        ])->orderBy('updated_at', 'desc')->take(5)->get(['name', 'slug', 'body']);
    }

    public static function getPartnerships()
    {
        return Partnership::where('active', 1)->latest()->get(['image']);
    }

    public static function getLatestProgram($slug, $limit = 5)
    {
        return Program::where([
            ['active', '=', 1],
            ['slug', '!=', $slug]
        ])
            ->with('user:id,name,email', 'parent:id,name')
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get(['name', 'slug', 'image', 'source', 'description', 'body', 'author', 'parent_id', 'attr_1 as duration', 'created_at']);
    }

    public static function getFeaturedProgram()
    {
        return Program::where([
            ['active', '=', 1],
            ['is_featured', '=', 1]
        ])
            ->with('user:id,name,email', 'parent:id,name')
            ->orderBy('created_at', 'desc')
            ->get(['name', 'slug', 'image', 'source', 'description', 'body', 'author', 'parent_id', 'attr_1 as duration', 'created_at']);
    }

    /**
     * Mengambil total viewed pada hari ini dari suatu model.
     *
     * @param string $model
     * @return int
     */
    public static function getTotalViewedToday($model, $type)
    {
        return DB::table((new $model)->getTable())
            ->where([
                ['active', '=', 1],
                ['type', '=', $type]
            ])
            ->whereDate('created_at', today())
            ->sum('viewed');
    }

    /**
     * Mengambil total viewed pada hari sebelumnya dari suatu model.
     *
     * @param string $model
     * @return int
     */
    public static function getTotalViewedYesterday($model, $type)
    {
        return DB::table((new $model)->getTable())
            ->where([
                ['active', '=', 1],
                ['type', '=', $type]
            ])
            ->whereDate('created_at', today()->subDay())
            ->sum('viewed');
    }

    /**
     * Menghitung persentase perubahan dari suatu model.
     *
     * @param string $model
     * @return float
     */
    public static function getPercentChange($model, $type)
    {
        $total_viewed_today = self::getTotalViewedToday($model, $type);
        $total_viewed_yesterday = self::getTotalViewedYesterday($model, $type);

        return $total_viewed_yesterday != 0 ? ($total_viewed_today - $total_viewed_yesterday) / $total_viewed_yesterday * 100 : 0;
    }
}
