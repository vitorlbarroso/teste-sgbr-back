<?php

namespace App\Http\Controllers;

use App\Helpers\ResponsesHelper;
use App\Helpers\SlugHelper;
use App\Http\Requests\Locations\CreateLocationsRequest;
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
}
