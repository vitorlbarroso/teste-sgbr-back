<?php

namespace App\Http\Controllers;

use App\Helpers\ResponsesHelper;
use App\Helpers\SlugHelper;
use App\Http\Requests\Locations\CreateLocationsRequest;
use App\Http\Requests\Locations\UpdateLocationsRequest;
use App\Models\Locations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LocationsController extends Controller
{
    public function store(CreateLocationsRequest $request)
    {
        $formatedSlug = SlugHelper::format_slug($request->slug);

        $data = [
            'name' => $request->name,
            'slug' => $formatedSlug,
            'city' => $request->city,
            'state' => $request->state,
        ];

        try {
            $createdLocation = Locations::create($data);

            return ResponsesHelper::SUCCESS('Localização criada com sucesso', $createdLocation, 201);
        }
        catch (\Exception $e) {
            Log::error('|' . $request->header('x-transaction-id') . '|Erro ao criar a localização ', ['error' => $e->getMessage()]);

            return ResponsesHelper::ERROR('Ocorreu um erro ao tentar criar a localização', null, -1000, 400);
        }
    }

    public function index(Request $request)
    {
        $itemsPerPage = $request->query('items_per_page', 10);
        $termsFilter = $request->query('filter', '');

        try {
            $getLocations = Locations::where(function($query) use ($termsFilter) {
                    $query->where('name', 'LIKE', "%$termsFilter%")
                        ->orWhere('slug', 'LIKE', "%$termsFilter%");
                })
                ->orderBy('id', 'desc')
                ->paginate($itemsPerPage);

            return ResponsesHelper::SUCCESS('', $getLocations, 200);
        }
        catch (\Exception $e) {
            Log::error('|' . $request->header('x-transaction-id') . '|Erro ao criar buscar as localizações', ['error' => $e->getMessage()]);

            return ResponsesHelper::ERROR('Ocorreu um erro ao buscar as localizações', null, -1000, 400);
        }
    }

    public function show(Request $request, $id)
    {
        try {
            $getLocation = Locations::find($id);

            if (!$getLocation) {
                return ResponsesHelper::ERROR('A localização informada não consta em nossos registros!', null, 1000, 404);
            }

            return ResponsesHelper::SUCCESS('', $getLocation, 200);
        }
        catch (\Exception $e) {
            Log::error('|' . $request->header('x-transaction-id') . '|Erro ao criar buscar a localização', ['error' => $e->getMessage()]);

            return ResponsesHelper::ERROR('Ocorreu um erro ao buscar a localização', null, -1000, 400);
        }
    }

    public function update(UpdateLocationsRequest $request, $id)
    {
        $validated = $request->validated();

        $getLocation = Locations::find($id);

        if (!$getLocation) {
            return ResponsesHelper::ERROR('A localização informada não consta em nossos registros!', null, 1000, 404);
        }

        if ($request->has('slug')) {
            $formatedSlug = SlugHelper::format_slug($request->slug);

            $validated['slug'] = $formatedSlug;
        }

        try {
            $getLocation->update($validated);
            $getLocation->save();

            return ResponsesHelper::SUCCESS('Localização atualizada com sucesso!', $getLocation, 200);
        }
        catch (\Exception $e) {
            Log::error('|' . $request->header('x-transaction-id') . '|Erro ao criar atualizar a localização', ['error' => $e->getMessage()]);

            return ResponsesHelper::ERROR('Ocorreu um erro ao tentar atualizar a localização', null, -1000, 400);
        }
    }
}
