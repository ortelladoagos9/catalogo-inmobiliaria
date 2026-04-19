@extends('layouts.app')

@section('breadcrumb')
<x-breadcrumb :items="[
    ['label' => 'Inicio']
]" />
@endsection

@section('content')
<div class="min-h-screen bg-gray-950 text-white px-6 py-10">

    <!-- Header -->
    <div class="max-w-7xl mx-auto mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mt-20">
        
        <div>
            <h1 class="text-2xl font-semibold">Propiedades</h1>
            <p class="text-white/60 text-sm mt-2">Listado general de propiedades</p>
        </div>

        <a href="{{ route('properties.create') }}"
           class="px-6 py-3 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 
                  text-white font-medium shadow-lg shadow-purple-500/20 
                  hover:scale-105 transition">
            + Nueva propiedad
        </a>
    </div>

    <!-- Contenedor -->
    <div class="max-w-7xl mx-auto">

        <!-- TABLA (desktop) -->
        <div class="hidden md:block bg-white/5 backdrop-blur border border-white/10 rounded-2xl overflow-hidden">

            <table class="w-full text-left">
                <thead class="bg-white/10 text-white/70 text-sm">
                    <tr>
                        <th class="p-4">Imagen</th>
                        <th class="p-4">Título</th>
                        <th class="p-4">Precio</th>
                        <th class="p-4">Ubicación</th>
                        <th class="p-4">Disponibilidad</th>
                       <!--  <th class="p-4">Estado</th>-->
                        <th class="p-4 text-right">Acciones</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-white/10">
                    @forelse($properties as $property)
                    <tr x-data="{ open: false }" class="hover:bg-white/5 transition">
                        <td class="p-4 w-20 h-20">
                            @if($property->picture && $property->picture->first())
                                <img src="{{ Storage::url($property->picture->first()->path) }}" alt="{{ $property->title }}" class="w-full h-full object-cover rounded-lg">
                            @else
                                <div class="bg-gray-300 border-2 border-dashed rounded-xl w-full h-full"></div>
                            @endif
                        </td>

                        <td class="p-4 font-medium">
                            {{ $property->title }}
                        </td>

                        <td class="p-4 text-white/80">
                            ${{ number_format($property->price, 2, ',', '.') }}
                        </td>

                        <td class="p-4 text-white/70">
                            {{ $property->address->town->province->name }}, {{ $property->address->town->name }}, {{ $property->address->street }} {{ $property->address->number }}
                        </td>

                        <td class="p-4">
                            <span class="px-3 py-1 rounded-full text-xs bg-blue-500/20 text-blue-400">
                                {{ $property->statusProperty ? $property->statusProperty->description : '—' }}
                            </span>
                        </td>

                        <!--<td class="p-4">
                            <span class="px-3 py-1 rounded-full text-xs 
                               {{ $property->status ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                                {{ $property->status ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>-->

                        <td class="p-4 text-right space-x-3">

                            <a href="{{ route('properties.edit', $property) }}"
                               class="text-indigo-400 hover:text-indigo-300 transition">
                                Editar
                            </a>

                            @if(auth()->user()->isAdmin())
                            <form action="{{ route('properties.destroy', $property) }}"
                                  method="POST"
                                  class="inline"
                                  id="delete-form-{{ $property->id }}">
                                @csrf
                                @method('DELETE')

                                <button type="button"
                                        onclick="confirmDelete({{ $property->id }}, '{{ $property->title }}')"
                                        class="text-red-400 hover:text-red-300 transition">
                                    Eliminar
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-6 text-center text-white/50">
                            No hay propiedades cargadas
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- MOBILE (cards) -->
        <div class="md:hidden space-y-4">
            @forelse($properties as $property)
            <div class="bg-white/5 backdrop-blur border border-white/10 rounded-2xl p-5">

                @if($property->picture && $property->picture->first())
                    <img src="{{ Storage::url($property->picture->first()->path) }}" alt="{{ $property->title }}" class="w-full h-40 object-cover rounded-lg mb-3">
                @endif

                <h2 class="text-lg font-semibold mb-2">
                    {{ $property->title }}
                </h2>

                <p class="text-white/70 text-sm mb-1">
                    ${{ number_format($property->price, 2, ',', '.') }}
                </p>

                <p class="text-white/60 text-sm mb-2">
                    📍 {{ $property->address->town->province->name }}, {{ $property->address->town->name }}, {{ $property->address->street }} {{ $property->address->number }}
                </p>

                <div class="flex gap-2 mb-4">
                    <span class="px-3 py-1 rounded-full text-xs bg-blue-500/20 text-blue-400">
                        {{ $property->statusProperty ? $property->statusProperty->description : '—' }}
                    </span>
                    <!--<span class="px-3 py-1 rounded-full text-xs {{ $property->status ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                        {{ $property->status ? 'Activo' : 'Inactivo' }}
                    </span>-->
                </div>

                <div class="flex justify-between items-center">

                    <a href="{{ route('properties.edit', $property) }}"
                       class="text-indigo-400 text-sm">
                        Editar
                    </a>

                    @if(auth()->user()->isAdmin())
                    <form action="{{ route('properties.destroy', $property) }}" method="POST" class="inline" id="delete-form-mobile-{{ $property->id }}">
                        @csrf
                        @method('DELETE')

                        <button type="button"
                                onclick="confirmDelete({{ $property->id }}, '{{ $property->title }}', 'mobile')"
                                class="text-red-400 text-sm">
                            Eliminar
                        </button>
                    </form>
                    @endif

                </div>
            </div>
            @empty
            <p class="text-white/50 text-center">
                No hay propiedades cargadas
            </p>
            @endforelse
        </div>

        <!-- PAGINACIÓN -->
        <div class="mt-8">
            {{ $properties->links() }}
        </div>

    </div>
</div>

<script>
function confirmDelete(propertyId, propertyTitle, type = '') {
    const formId = type === 'mobile' ? `delete-form-mobile-${propertyId}` : `delete-form-${propertyId}`;

    if (confirm(`¿Estás seguro de que quieres eliminar la propiedad "${propertyTitle}"?\n\nEsta acción marcará la propiedad como inactiva.`)) {
        document.getElementById(formId).submit();
    }
}
</script>
@endsection