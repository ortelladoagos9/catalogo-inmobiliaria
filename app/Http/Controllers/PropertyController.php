<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Status;
use App\Models\Town;
use App\Models\TypeProperty;
use App\Models\PropertyOwner;
use App\Models\Picture;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Services\PropertyService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    protected $service;

    public function __construct(PropertyService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    public function index()
    {
        $properties = Property::with(['address.town.province', 'picture', 'statusProperty'])
            ->where('status', true)
            ->paginate(10);

        return view('properties.index', compact('properties'));
    }

    public function create()
    {
        $this->authorize('create', Property::class);

        return view('properties.create', [
            'statuses' => Status::all(),
            'types' => TypeProperty::all(),
            'owners' => PropertyOwner::all(),
            'towns' => Town::with('province')->get(),
        ]);
    }

    public function store(StorePropertyRequest $request)
    {
        $this->authorize('create', Property::class);

        $this->service->create($request->validated(), $request->user());

        return redirect()->route('properties.index')
            ->with('success', 'Propiedad creada correctamente');
    }

    public function edit(Property $property)
    {
        $this->authorize('update', $property);

        return view('properties.edit', [
            'property' => $property,
            'statuses' => Status::all(),
            'types' => TypeProperty::all(),
            'owners' => PropertyOwner::all(),
            'towns' => Town::with('province')->get(),
        ]);
    }

    public function update(UpdatePropertyRequest $request, Property $property)
    {
        $this->authorize('update', $property);

        $this->service->update($property, $request->validated(),  $request->user());

        return redirect()->route('properties.index')
            ->with('success', 'Propiedad actualizada');
    }

    public function destroy(Property $property)
    {
        $this->authorize('delete', $property);

        // Soft delete: marcar como inactivo
        $property->update(['status' => false]);

        return redirect()->route('properties.index')
            ->with('success', 'Propiedad eliminada (inactiva)');
    }

    public function destroyImage(Property $property, $pictureId)
    {
        $picture = $property->picture()->findOrFail($pictureId);

        // Eliminar archivo físico
        if (Storage::disk('public')->exists($picture->path)) {
            Storage::disk('public')->delete($picture->path);
        }

        // Eliminar registro de la base de datos
        $picture->delete();

        return response()->json(['success' => true]);
    }
}
