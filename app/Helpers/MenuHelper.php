<?php

namespace App\Helpers;

class MenuHelper
{
    public static function getMenu()
    {
        return [
            [
                'name' => 'HOME',
                'url' => '/',
            ],
            [
                'name' => 'NEWS',
                'url' => '/news',
            ],
            [
                'name' => 'PROGRAM',
                'url' => '/program',
            ],
            [
                'name' => 'ARTICLE',
                'url' => '/article',
            ],
            [
                'name' => 'LIVE TV',
                'url' => '/live',
            ],
        ];
    }
}
