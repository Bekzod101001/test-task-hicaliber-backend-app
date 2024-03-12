<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyIndexRequest;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PropertyIndexRequest $request)
    {
        $properties = Property::query()
            ->when($request->name, function ($query, $name) {
                return $query->where('name', 'LIKE', "%$name%");
            })
            ->when($request->price_from, function ($query, $price_from) {
                return $query->where('price', '>=', $price_from);
            })
            ->when($request->price_to, function ($query, $price_to) {
                return $query->where('price', '<=', $price_to);
            })
            ->when($request->bedrooms, function ($query, $bedrooms) {
                return $query->where('bedrooms', $bedrooms);
            })
            ->when($request->bathrooms, function ($query, $bathrooms) {
                return $query->where('bathrooms', $bathrooms);
            })
            ->when($request->storeys, function ($query, $storeys) {
                return $query->where('storeys', $storeys);
            })
            ->when($request->garages, function ($query, $garages) {
                return $query->where('garages', $garages);
            })
            ->paginate($request->per_page);

        return response()->json($properties);
    }

}
