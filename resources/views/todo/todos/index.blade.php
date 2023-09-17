@extends('todo.app')

@section('content')
    <div class="container border p-4 mt-4">
        <form action="{{ route('todos') }}" method="POST">
            @csrf

            @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>                
            @endif

            @error('title')
            <h6 class="alert alert-danger">{{ $message }}</h6>                
            @enderror
            <div class="mb-3">
                <label for="title" class="form-label">Título de la tarea</label>
                <input type="text" name="title" class="form-control">
            </div>

            <label for="category_id" class="form-label">Categoria</label>
            <select name="category_id" class="form-select">
                @foreach ($categories as $category)
                    @if ($category->user_id == Auth::user()->id)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endif                  
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary">Crear nueva tarea</button>
        </form>
        <div>
            @foreach ($todos as $todo)
                @if ($todo->user_id == Auth::user()->id)
                    <div class="row py-1">
                        <div class="col-md-9 d-flex align-items-center">
                            <a href="{{ route('todos-show', ['id' => $todo->id]) }}">{{ $todo->title }}</a>
                        </div>

                        <div class="col-md-3 d-flex justify-content-end">
                            <form action="{{ route('todos-destroy', [$todo->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </div>

                    </div>
                @endif
            @endforeach
        </div>
    </div>

@endsection