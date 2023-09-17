@extends('people.app')

@section('content')

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido</th>
      <th scope="col">Teléfono</th>
      <th scope="col">Email</th>
      <th scope="col" colspan="2" class="text-center">Acción</th>
    </tr>
  </thead>
  @foreach ($peoples as $people)
    @if ($people->user_id == Auth::user()->id)
      <tr>
        <td>{{ $people->id }}</td>
        <td>{{ $people->name }}</td>
        <td>{{ $people->last_name }}</td>
        <td>{{ $people->number_phone }}</td>
        <td>{{ $people->email }}</td>
        <td class="text-center">
          <a href="{{route('peoples.show',[$people->id]);}}">
            <button type="submit" class="btn btn-warning">
              <i class="fas fa-edit"></i>
            </button>
          </a>
        </td>
        <td class="text-center">
          <form action="{{route('peoples.destroy',[$people->id]);}}" method="POST">
              @method('DELETE')
              @csrf
              <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash-alt"></i>
              </button>
          </form>  
        </td>
      </tr>
    @endif
  @endforeach
</table>
    
@endsection