@extends('layouts.app')

@section('breadcrumb')
<x-breadcrumb :items="[
    ['label' => 'Ver propiedades', 'url' => route('properties.index')],
    ['label' => 'Auditorías']
]" />
@endsection

@section('content')
<div class="min-h-screen bg-gray-950 text-white px-6 py-10">
    <div class="max-w-7xl mx-auto mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mt-20">
        <div>
            <h1 class="text-2xl font-semibold">Auditorías</h1>
            <p class="text-white/60 text-sm mt-2">Registro de eventos del sistema con usuario, acción, fecha y hora, valores anteriores y nuevos.</p>
        </div>
    </div>

    <!-- Filtros -->
    <div class="max-w-7xl mx-auto mb-6">
        <form method="GET" action="{{ route('audit.index') }}" class="bg-white/5 backdrop-blur border border-white/10 rounded-2xl p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="date_from" class="block text-sm font-medium text-white/70 mb-2">Fecha desde</label>
                    <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label for="date_to" class="block text-sm font-medium text-white/70 mb-2">Fecha hasta</label>
                    <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}" class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label for="action" class="block text-sm font-medium text-white/70 mb-2">Acción</label>
                    <select name="action" id="action" class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="" class="bg-gray-800 text-white">Todas</option>
                        <option value="created" {{ request('action') == 'created' ? 'selected' : '' }} class="bg-gray-800 text-white">Crear</option>
                        <option value="updated" {{ request('action') == 'updated' ? 'selected' : '' }} class="bg-gray-800 text-white">Editar</option>
                        <option value="deleted" {{ request('action') == 'deleted' ? 'selected' : '' }} class="bg-gray-800 text-white">Eliminar</option>
                    </select>
                </div>
                <div>
                    <label for="user" class="block text-sm font-medium text-white/70 mb-2">Usuario</label>
                    <input type="text" name="user" id="user" value="{{ request('user') }}" placeholder="Buscar por nombre o email" class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>
            <div class="flex gap-4 mt-4">
                <button type="submit" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition">Filtrar</button>
                <a href="{{ route('audit.index') }}" class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition">Limpiar</a>
            </div>
        </form>
    </div>

    <div class="max-w-7xl mx-auto">
        <div class="hidden md:block bg-white/5 backdrop-blur border border-white/10 rounded-2xl overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-white/10 text-white/70 text-sm">
                    <tr>
                        <th class="p-4">Usuario</th>
                        <th class="p-4">Acción</th>
                        <th class="p-4">Fecha / Hora</th>
                        <th class="p-4">ID Propiedad</th>
                        <th class="p-4">Valores anteriores</th>
                        <th class="p-4">Valores nuevos</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse($audits as $audit)
                    <tr class="hover:bg-white/5 transition">
                        <td class="p-4 font-medium text-white">
                            {{ optional($audit->user)->name ?? optional($audit->user)->email ?? 'Sistema' }}
                        </td>
                        <td class="p-4 text-white/80">
                            @switch($audit->custom_event)
                                @case('created') Crear @break
                                @case('updated') Editar @break
                                @case('deleted') Eliminar @break
                                @default {{ ucfirst($audit->event) }}
                            @endswitch
                        </td>
                        <td class="p-4 text-white/70">
                            {{ $audit->created_at->format('d/m/Y H:i:s') }}
                        </td>
                        <td class="p-4 text-white/80">
                            {{ $audit->auditable_id }}
                        </td>
                        <td class="p-4 text-sm text-white/60">
                            @if(!empty($audit->formatted['old']))
                                <div class="space-y-1">
                                    @forelse($audit->formatted['old'] as $item)
                                        <div>
                                            <span class="font-medium text-white">{{ $item['label'] }}:</span>
                                            <span class="text-white/60">{{ $item['value'] ?? '—' }}</span>
                                        </div>
                                    @empty
                                        <span class="text-white/50">—</span>
                                    @endforelse
                                </div>
                            @else
                                <span class="text-white/50">—</span>
                            @endif
                        </td>
                        <td class="p-4 text-sm text-white/60">
                            @if(!empty($audit->formatted['new']))
                                <div class="space-y-1">
                                    @forelse($audit->formatted['new'] as $item)
                                        <div>
                                            <span class="font-medium text-white">{{ $item['label'] }}:</span>
                                            <span class="text-white/60">{{ $item['value'] ?? '—' }}</span>
                                        </div>
                                    @empty
                                        <span class="text-white/50">—</span>
                                    @endforelse
                                </div>
                            @else
                                <span class="text-white/50">—</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-6 text-center text-white/50">
                            No hay eventos de auditoría registrados.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
<!------------------------- Versión móvil------------------------------>
        <div class="md:hidden space-y-4">
            @forelse($audits as $audit)
            <div class="bg-white/5 backdrop-blur border border-white/10 rounded-2xl p-5">
                <div class="flex flex-col gap-3 mb-4">
                    <div class="flex justify-between items-center gap-3">
                        <div>
                            <p class="text-white/60 text-sm mb-2">ID Propiedad: {{ $audit->auditable_id }}</p>
                            <p class="text-white font-medium">Usuario: {{ optional($audit->user)->name ?? optional($audit->user)->email ?? 'Sistema' }}</p>
                            
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs bg-blue-500/20 text-blue-400">
                            @switch($audit->custom_event)
                                @case('created') Crear @break
                                @case('updated') Editar @break
                                @case('deleted') Eliminar @break
                                @default {{ ucfirst($audit->event) }}
                            @endswitch
                        </span>
                    </div>
                    <p class="text-white/70 text-xs">{{ $audit->created_at->format('d/m/Y H:i:s') }}</p>
                </div>

                <div class="grid gap-3 text-sm">
                    <div class="bg-white/5 p-4 rounded-2xl border border-white/10">
                        <p class="text-white/80 font-medium mb-2">Valores anteriores</p>
                       @if(!empty($audit->formatted['old']))
                            <div class="space-y-1">
                                @forelse($audit->formatted['old'] as $item)
                                    <div>
                                        <span class="font-medium text-white">{{ $item['label'] }}:</span>
                                        <span class="text-white/60">{{ $item['value'] ?? '—' }}</span>
                                    </div>
                                @empty
                                    <span class="text-white/50">—</span>
                                @endforelse
                            </div>
                        @else
                            <span class="text-white/50">—</span>
                        @endif
                    </div>
                    <div class="bg-white/5 p-4 rounded-2xl border border-white/10">
                        <p class="text-white/80 font-medium mb-2">Valores nuevos</p>
                        @if(!empty($audit->formatted['new']))
                            <div class="space-y-1">
                                @forelse($audit->formatted['new'] as $item)
                                    <div>
                                        <span class="font-medium text-white">{{ $item['label'] }}:</span>
                                        <span class="text-white/60">{{ $item['value'] ?? '—' }}</span>
                                    </div>
                                @empty
                                    <span class="text-white/50">—</span>
                                @endforelse
                            </div>
                        @else
                            <span class="text-white/50">—</span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <p class="text-white/50 text-center">No hay eventos de auditoría registrados.</p>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $audits->links() }}
        </div>
    </div>
</div>
@endsection