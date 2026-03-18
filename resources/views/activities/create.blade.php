@extends('layouts.app')
@section('content')
<div class="col-md-6 mx-auto">
    <h1 class="h3 mb-4">Nueva actividad — {{ $subject->name }}</h1>
    <form action="{{ route('activities.store', $subject) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Tipo de actividad</label>
            <select name="type" class="form-select">
                @foreach(['Tarea','Actividad','Quiz','Examen parcial','Examen final','Proyecto'] as $t)
                    <option>{{ $t }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Calificación (0–10)</label>
            <input type="number" name="grade" class="form-control @error('grade') is-invalid @enderror"
                   min="0" max="10" step="0.1" value="{{ old('grade') }}">
            @error('grade')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha</label>
            <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Notas (opcional)</label>
            <textarea name="notes" class="form-control" rows="2">{{ old('notes') }}</textarea>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-primary">Guardar</button>
            <a href="{{ route('subjects.show', $subject) }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection