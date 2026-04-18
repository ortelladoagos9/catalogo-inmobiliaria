@extends('layouts.app')

@section('content')

<h1 class="text-xl mb-4">Crear Propiedad</h1>

<form method="POST" enctype="multipart/form-data" action="{{ route('properties.store') }}">
    @csrf

    <input type="text" name="title" placeholder="Título" class="border p-2 block mb-2">

    <input type="number" name="surface" placeholder="Superficie" class="border p-2 block mb-2">
   
    <input type="number" name="price" placeholder="Precio" class="border p-2 block mb-2">

    <input type="file" name="images[]" multiple class="mb-2">

    <button class="bg-blue-500 text-black px-4 py-2">Guardar</button>
</form>

@endsection