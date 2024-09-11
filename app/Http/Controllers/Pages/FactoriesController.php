<?php

namespace App\Http\Controllers\Pages;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Factories;
use Illuminate\Http\Request;
use App\Services\FactoryService;
use App\Http\Controllers\Controller;
use App\Http\Resources\FactoryResource;
use App\Http\Requests\UpdateFactoryRequest;
use App\Http\Requests\StoreFactoriesRequest;

class FactoriesController extends Controller
{
    public function __construct(protected FactoryService $factoryService)
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        return Inertia::render('Factory/IndexFactory', [
            'factories' => Factories::withoutTrashed()
                                    ->latest()
                                    ->paginate($request->input('per_page', 10))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Factory/CreateFactory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFactoriesRequest $request)
    {
        $this->factoryService->createFactory($request->validated());

        return to_route('factories.index')->with('success', 'Factory created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Factories $factory)
    {
        return Inertia::render('Factory/ShowFactory', [
            'factory' => new FactoryResource($factory)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factories $factory)
    {
        return Inertia::render('Factory/EditFactory', [
            'factories' => new FactoryResource($factory)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFactoryRequest $request, Factories $factory)
    {
        $this->factoryService->updateFactory($factory, $request->validated());

        return to_route('factories.index')->with('success', 'Factory updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factories $factory)
    {
        $this->factoryService->deleteFactory($factory);
    }
}
