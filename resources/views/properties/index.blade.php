@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-4">Propiedades</h1>

<a href="{{ route('properties.create') }}" 
   class="bg-green-500 text-black px-4 py-2 rounded">
   Nueva Propiedad
</a>

<table class="w-full mt-4 bg-white">
    <thead>
        <tr>
            <th>Título</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($properties as $property)
        <tr>
            <td>{{ $property->title }}</td>
            <td>{{ $property->price }}</td>
            <td>
                <a href="{{ route('properties.edit', $property) }}">Editar</a>

                @if(auth()->user()->isAdmin())
                <form action="{{ route('properties.destroy', $property) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button>Eliminar</button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $properties->links() }}

@endsection