<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;
use View;
use App\Utility;
use App\User;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $id;
    private $user;

    public function __construct() {
        $this(function ($request, $next) {
            $util = Utility::find(1);
            $this->id = Auth::id();
            $this->user = User::find($this->id);
            View::share('user', $this->user);
            View::share('util', $util);
            return $next($request);
        });
    }
}
