<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaveRequest;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class StoreController extends Controller
{
    public function index(): \Inertia\Response
    {
        $userStores = Auth::user()->stores()->paginate(5);
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


    public function create()
    {
        return Inertia::render(
            'Store/Create'
        );
    }

    public function store(StoreSaveRequest $request)
    {
        $store = Auth::user()->stores()->create([
            'name' => $request->validated('name'),
            'description' => $request->validated('description'),
        ]);

        return redirect()->route('store.show', ['store' => $store])->with('message', 'Store Created Successfully!!');
    }

    public function edit(Store $store)
    {
        return Inertia::render(
            'Store/Update',
            [
                'store' => $store
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSaveRequest $request, Store $store)
    {
        $store->name = $request->validated('name');
        $store->description = $request->validated('description');
        $store->save();

        return redirect()->route('store.show', ['store' => $store])->with('message', 'Store Updated Successfully');
    }
}
