<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : Response()->json(['warnning' => "user must be login", 'redirect' => '/login']);
    }
}
