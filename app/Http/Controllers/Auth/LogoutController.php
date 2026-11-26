<?php

declare(strict_types=1);

namespace Themes\Civic\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Themes\Civic\Http\Controllers\BaseController;

class LogoutController extends BaseController
{
    public function __invoke(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
