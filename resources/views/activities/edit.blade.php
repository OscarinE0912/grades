@extends('layouts.app')
@section('content')
<div class="col-md-6 mx-auto">
    <h1 class="h3 mb-4">Editar actividad — {{ $subject->name }}</h1>
    <form action="{{ route('activities.update', [$subject, $activity]) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Tipo de actividad</label>
            <select name="type" class="form-select">
                @foreach(['Tarea','Actividad','Quiz','Examen parcial','Examen final','Proyecto'] as $t)
                    <option {{ $activity->type == $t ? 'selected' : '' }}>{{ $t }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Calificación</label>
            <input type="number" name="grade" class="form-control"
                   value="{{ $activity->grade }}" min="0" max="10" step="0.1">
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha</label>
            <input type="date" name="date" class="form-control"
                   value="{{ \Carbon\Carbon::parse($activity->date)->format('Y-m-d') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Notas</label>
            <textarea name="notes" class="form-control" rows="2">{{ $activity->notes }}</textarea>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-warning">Actualizar</button>
            <a href="{{ route('subjects.show', $subject) }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection