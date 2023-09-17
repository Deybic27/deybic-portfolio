@extends('people.app')

@section('content')
    <div class="container w-25">
        <form action="{{ route('peoples.store') }}" method="POST">
            @csrf
            @error('name')
                <h6 class="alert alert-danger">{{ $message }}</h6>                
            @enderror
            <div class="mb-3">
                <label for="name" class="form-label">Nombres</label>
                <input type="name" class="form-control" name="name" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="last_name" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="number_phone" class="form-label">Teléfono</label>
                <input type="number" class="form-control" name="number_phone" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection