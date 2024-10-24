<?php

namespace App\Http\Middleware;

use Closure;

class VerifyCsrfToken extends \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken
{
    protected $except = [
        //
    ];
}
