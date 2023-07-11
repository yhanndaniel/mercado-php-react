<?php
namespace App\Helpers;

class Helpers
{
    public static function now(): string
    {
        return date('Y-m-d H:i:s');
    }
}