<?php

namespace App\Http\Middleware\Admin;

use App\Http\Middleware\HandleInertiaRequests as HandleBaseInertiaRequests;

class HandleInertiaRequests extends HandleBaseInertiaRequests
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'admin';
}
