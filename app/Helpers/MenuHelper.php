<?php

namespace App\Helpers;

class MenuHelper
{
    public static function getMenu()
    {
        return [
            [
                'name' => 'Home',
                'url' => '/',
            ],
            [
                'name' => 'News',
                'url' => '/news',
            ],
            [
                'name' => 'Program',
                'url' => '/program',
            ],
            [
                'name' => 'Article',
                'url' => '/live',
            ],
            [
                'name' => 'Live TV',
                'url' => '/live',
            ],
        ];
    }
}
