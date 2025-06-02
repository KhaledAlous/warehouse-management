<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Tax Rate
    |--------------------------------------------------------------------------
    |
    | This value specifies the default tax rate to be applied.
    | It can be overridden by setting the DEFAULT_TAX_RATE environment variable
    | in your .env file. The value should be a decimal (e.g., 0.15 for 15%).
    |
    */
    'rate' => env('DEFAULT_TAX_RATE', 0.15), 
];