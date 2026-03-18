@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">Mis Materias</h1>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('subjects.store') }}" method="POST" class="row g-2">
            @csrf
            <div class="col-md-5">
                <input type="text" name="name" class="form-control"
                       placeholder="Nombre de materia" required>
            </div>
            <div class="col-md-5">
                <input type="text" name="teacher" class="form-control"
                       placeholder="Maestro (opcional)">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100">Agregar</button>
            </div>
        </form>
    </div>
</div>

<table class="table table-hover align-middle">
    <thead class="table-dark">
        <tr><th>Materia</th><th>Maestro</th><th>Actividades</th><th>Promedio</th><th>Acciones</th></tr>
    </thead>
    <tbody>
    @forelse($subjects as $subject)
        <tr>
            <td><strong>{{ $subject->name }}</strong></td>
            <td>{{ $subject->teacher ?? '—' }}</td>
            <td>{{ $subject->activities_count }}</td>
            <td>
                @php $avg = round($subject->activities_avg_grade ?? 0, 1); @endphp
                <span class="badge bg-{{ $avg >= 6 ? 'success' : 'danger' }}">
                    {{ $avg }}/10
                </span>
            </td>
            <td>
                <a href="{{ route('subjects.show', $subject) }}" class="btn btn-sm btn-info">Ver calificaciones</a>
                <form action="{{ route('subjects.destroy', $subject) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger"
                        onclick="return confirm('¿Eliminar materia?')">Eliminar</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="5" class="text-center text-muted py-3">Aún no hay materias.</td></tr>
    @endforelse
    </tbody>
</table>
@endsection