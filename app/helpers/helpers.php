<?php

use App\enums\StatusEnum;

if (!function_exists('get_translated_status')) {
   
    function get_translated_status(StatusEnum $status): string
    {
        return $status->translatedName();
    }
}