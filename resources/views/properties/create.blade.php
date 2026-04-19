@extends('layouts.app')

@section('breadcrumb')
<x-breadcrumb :items="[
    ['label' => 'Ver propiedades', 'url' => route('properties.index')],
    ['label' => 'Crear propiedad']
]" />
@endsection

@section('content')
<div class="min-h-screen bg-gray-950 text-white px-6 py-10">

    <div class="max-w-5xl mx-auto mt-20">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-semibold">Crear Propiedad</h1>
            <p class="text-white/60 text-sm mt-2">Completá la información de la propiedad</p>
        </div>

        <!-- MENSAJES DE VALIDACIÓN -->
        @if ($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-500/20 border border-red-500/50 text-red-400">
                <h3 class="font-semibold mb-2">Errores en el formulario:</h3>
                <ul class="list-disc list-inside space-y-1 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM -->
        <form method="POST" enctype="multipart/form-data"
              action="{{ route('properties.store') }}"
              class="bg-white/5 backdrop-blur border border-white/10 rounded-2xl p-8 space-y-6">

            @csrf

            <!-- Título -->
            <div>
                <label class="block text-sm mb-2 text-white/70">Título</label>
                <input type="text" name="title" value="{{ old('title') }}"
                       class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 
                              focus:outline-none focus:ring-2 focus:ring-purple-500
                              {{ $errors->has('title') ? 'border-red-500' : '' }}">
                @error('title')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Precio / Superficie / Ambientes -->
            <div class="grid md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm mb-2 text-white/70">Precio</label>
                    <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0"
                           class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20
                                  {{ $errors->has('price') ? 'border-red-500' : '' }}">
                    @error('price')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm mb-2 text-white/70">Superficie (m²)</label>
                    <input type="number" name="surface" value="{{ old('surface') }}" step="0.01" min="0"
                           class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20
                                  {{ $errors->has('surface') ? 'border-red-500' : '' }}">
                    @error('surface')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm mb-2 text-white/70">Ambientes</label>
                    <input type="number" name="rooms" value="{{ old('rooms') }}" min="0"
                           class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20
                                  {{ $errors->has('rooms') ? 'border-red-500' : '' }}">
                    @error('rooms')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Selects -->
            <div class="grid md:grid-cols-3 gap-4">

                <div>
                    <label class="block text-sm mb-2 text-white/70">Tipo</label>
                    <select name="type_property_id"
                        class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20
                               {{ $errors->has('type_property_id') ? 'border-red-500' : '' }}">
                        <option value="" class="bg-gray-800 text-white">Seleccionar tipo...</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" class="bg-gray-800 text-white" {{ old('type_property_id') == $type->id ? 'selected' : '' }}>{{ $type->description }}</option>
                        @endforeach
                    </select>
                    @error('type_property_id')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm mb-2 text-white/70">Disponibilidad</label>
                    <select name="status_id"
                        class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20
                               {{ $errors->has('status_id') ? 'border-red-500' : '' }}">
                        <option value="" class="bg-gray-800 text-white">Seleccionar disponibilidad...</option>
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}" class="bg-gray-800 text-white" {{ old('status_id') == $status->id ? 'selected' : '' }}>{{ $status->description }}</option>
                        @endforeach
                    </select>
                    @error('status_id')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm mb-2 text-white/70">Responsable</label>
                    <select name="property_owner_id"
                        class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20
                               {{ $errors->has('property_owner_id') ? 'border-red-500' : '' }}">
                        <option value="" class="bg-gray-800 text-white">Seleccionar responsable...</option>
                        @foreach($owners as $owner)
                            <option value="{{ $owner->id }}" class="bg-gray-800 text-white" {{ old('property_owner_id') == $owner->id ? 'selected' : '' }}>{{ $owner->name }}</option>
                        @endforeach
                    </select>
                    @error('property_owner_id')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Dirección -->
            <div class="grid md:grid-cols-3 gap-4">

                <div>
                    <label class="block text-sm mb-2 text-white/70">Calle</label>
                    <input type="text" name="street" value="{{ old('street') }}"
                           class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20
                                  {{ $errors->has('street') ? 'border-red-500' : '' }}">
                    @error('street')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm mb-2 text-white/70">Número</label>
                    <input type="number" name="number" value="{{ old('number') }}" min="0"
                           class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20
                                  {{ $errors->has('number') ? 'border-red-500' : '' }}">
                    @error('number')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm mb-2 text-white/70">Localidad y Provincia</label>
                    <select name="town_id"
                        class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20
                               {{ $errors->has('town_id') ? 'border-red-500' : '' }}">
                        <option value="" class="bg-gray-800 text-white">Seleccionar localidad...</option>
                        @foreach($towns as $town)
                            <option value="{{ $town->id }}" class="bg-gray-800 text-white" {{ old('town_id') == $town->id ? 'selected' : '' }}>{{ $town->name }}, {{ $town->province->name }}</option>
                        @endforeach
                    </select>
                    @error('town_id')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Descripción -->
            <div>
                <label class="block text-sm mb-2 text-white/70">Descripción</label>
                <textarea name="description" rows="4"
                          class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20
                                 {{ $errors->has('description') ? 'border-red-500' : '' }}">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Imágenes -->
            <div>
                <label class="block text-sm mb-2 text-white/70">Imágenes</label>
                <input type="file" name="images[]" multiple accept="image/*" id="images-input"
                       class="block w-full text-sm text-white/70 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-500 file:text-white hover:file:bg-indigo-600">
                <p class="text-white/50 text-xs mt-1">Selecciona una o más imágenes (máx. 2MB cada una)</p>

                <!-- Preview de imágenes -->
                <div id="images-preview" class="mt-4 flex flex-wrap gap-3 hidden">
                    <!-- Las imágenes se mostrarán aquí dinámicamente -->
                </div>
            </div>

            <!-- Botón -->
            <div class="pt-4">
                <button type="submit"
                        class="w-full md:w-auto px-8 py-3 rounded-full
                               bg-gradient-to-r from-indigo-500 to-purple-600
                               text-white font-semibold shadow-lg shadow-purple-500/20
                               hover:scale-105 transition">
                    Guardar propiedad
                </button>
            </div>

        </form>

        <script>
            // Validación del lado del cliente
            document.addEventListener('DOMContentLoaded', function() {
                // Validar inputs numéricos para no permitir negativos
                const numericInputs = document.querySelectorAll('input[type="number"]');
                numericInputs.forEach(input => {
                    input.addEventListener('input', function() {
                        if (this.value < 0) {
                            this.value = 0;
                        }
                    });

                    input.addEventListener('keydown', function(e) {
                        // Prevenir entrada de números negativos
                        if (e.key === '-' || e.key === 'e') {
                            e.preventDefault();
                        }
                    });
                });

                // Validar campo de calle para solo letras y espacios
                const streetInput = document.querySelector('input[name="street"]');
                if (streetInput) {
                    streetInput.addEventListener('input', function() {
                        this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
                    });
                }

                // Validar título para asegurar que tenga al menos una letra
                const titleInput = document.querySelector('input[name="title"]');
                if (titleInput) {
                    titleInput.addEventListener('input', function() {
                        // Remover números del inicio si no hay letras
                        if (!/[a-zA-Z]/.test(this.value)) {
                            this.value = this.value.replace(/^\d+/, '');
                        }
                    });
                }

                // Preview de imágenes
                const imagesInput = document.getElementById('images-input');
                const imagesPreview = document.getElementById('images-preview');

                if (imagesInput && imagesPreview) {
                    imagesInput.addEventListener('change', function(e) {
                        imagesPreview.innerHTML = ''; // Limpiar preview anterior

                        if (this.files.length > 0) {
                            imagesPreview.classList.remove('hidden');

                            Array.from(this.files).forEach((file, index) => {
                                if (file.type.startsWith('image/')) {
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        const imageContainer = document.createElement('div');
                                        imageContainer.className = 'relative group';

                                        const img = document.createElement('img');
                                        img.src = e.target.result;
                                        img.className = 'w-20 h-20 object-cover rounded-lg border border-white/20';
                                        img.alt = `Preview ${index + 1}`;

                                        const removeBtn = document.createElement('button');
                                        removeBtn.type = 'button';
                                        removeBtn.className = 'absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full text-xs opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center';
                                        removeBtn.innerHTML = '×';
                                        removeBtn.onclick = function() {
                                            // Remover imagen del input file
                                            const dt = new DataTransfer();
                                            const files = Array.from(imagesInput.files);
                                            files.splice(index, 1);
                                            files.forEach(file => dt.items.add(file));
                                            imagesInput.files = dt.files;

                                            // Remover del preview
                                            imageContainer.remove();

                                            // Ocultar preview si no hay imágenes
                                            if (imagesInput.files.length === 0) {
                                                imagesPreview.classList.add('hidden');
                                            }
                                        };

                                        imageContainer.appendChild(img);
                                        imageContainer.appendChild(removeBtn);
                                        imagesPreview.appendChild(imageContainer);
                                    };
                                    reader.readAsDataURL(file);
                                }
                            });
                        } else {
                            imagesPreview.classList.add('hidden');
                        }
                    });
                }
            });
        </script>
    </div>
</div>
@endsection