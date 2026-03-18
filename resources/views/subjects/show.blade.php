@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h1 class="h3 mb-0">{{ $subject->name }}</h1>
        @if($subject->teacher)
            <p class="text-muted mb-0">{{ $subject->teacher }}</p>
        @endif
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('activities.create', $subject) }}" class="btn btn-primary">+ Agregar actividad</a>
        <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>

<div class="alert alert-light border">
    Promedio general: <strong>{{ $subject->average() }}/10</strong>
    &mdash; {{ $activities->count() }} actividad(es)
</div>

<table class="table table-hover">
    <thead class="table-dark">
        <tr><th>Tipo</th><th>Calificación</th><th>Fecha</th><th>Notas</th><th>Acciones</th></tr>
    </thead>
    <tbody>
    @forelse($activities as $act)
        <tr>
            <td>{{ $act->type }}</td>
            <td>
                <span class="badge bg-{{ $act->grade >= 6 ? 'success' : 'danger' }} fs-6">
                    {{ $act->grade }}
                </span>
            </td>
            <td>{{ \Carbon\Carbon::parse($act->date)->format('d/m/Y') }}</td>
            <td>{{ $act->notes ?? '—' }}</td>
            <td>
                <a href="{{ route('activities.edit', [$subject, $act]) }}"
                   class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('activities.destroy', [$subject, $act]) }}"
                      method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger"
                        onclick="return confirm('¿Eliminar actividad?')">Eliminar</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="5" class="text-center text-muted py-3">Sin actividades aún.</td></tr>
    @endforelse
    </tbody>
</table>
@endsection