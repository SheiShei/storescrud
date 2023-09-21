<?php

namespace App\Http\Controllers;

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
}
