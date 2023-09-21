<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class StoreController extends Controller
{
    public function index(): \Inertia\Response
    {
        $userStores = Auth::user()->stores;
        return Inertia::render('Store/List', [
            'stores' => $userStores,
        ]);
    }

    public function show(Store $store): \Inertia\Response
    {
        return Inertia::render('Store/View', [
            'store' => $store,
        ]);
    }

}
