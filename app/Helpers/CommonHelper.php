<?php

namespace App\Helpers;

use App\Models\Configuration;
use App\Models\News;
use App\Models\Program;

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
            ['is_shared_to_live_tv', '=', 1]
        ])->with('user:id,name,email', 'parent:id,name')
            ->orderBy('viewed', 'desc')
            ->get(['name', 'slug', 'image', 'source', 'body', 'author', 'parent_id', 'attr_1 as duration', 'created_at']);
    }
}
