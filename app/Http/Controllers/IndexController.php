<?php

namespace App\Http\Controllers;

use App\Services\ChatAppService;

class IndexController extends Controller
{
    public function index(ChatAppService $service)
    {
        return view('welcome');
    }
}
