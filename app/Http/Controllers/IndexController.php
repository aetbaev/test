<?php

namespace App\Http\Controllers;

use App\Models\Broadcast;
use App\Services\ChatAppService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(ChatAppService $service)
    {
        $broadcasts = Broadcast::withCount('recipients')->latest()->get();

        return view('welcome', [
            'broadcasts' => $broadcasts,
        ]);
    }

    public function store(Request $request, ChatAppService $service)
    {
        $service->createBroadcast($request);

        return redirect()->back()->with('success', 'Рассылка успешно создана.');
    }
}
