<div id="loaderPage" class="loaderPage" style="visibility:hidden;">
    <div class="loader"></div>
</div>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Proyectos desarrollados') }}
        </h2>
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!-- Scripts -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    @vite(['resources/icons/css/all.min.css', 'resources/css/post_admin.css', 'resources/js/post_admin.js'])
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        @if (session('success'))
                            <h6 class="alert alert-success">{{ session('success') }}</h6>                
                        @endif
                        @php
                            $key=0;
                        @endphp
                        
                        @foreach ($categories as $category)
                        <div>
                            <a href="#&c={{$category->id}}"><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modal-category"><i class="fas fa-arrow-circle-right"></i> Editar categoría</button></a>
                            <h2>
                                <!-- <a href="#&c={{$category->id}}" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modal-category"> <i class="fa-solid fa-pen"></i></a>-->
                                {{ $category->name }}
                            </h2>
                            <div>
                            <div>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Título</th>
                                            <th scope="col">&nbsp;</th>
                                            <th scope="col">Author</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if ($category->posts->count() > 0)
                                        @foreach ($category->posts as $post)
                                            <tr>
                                                <th scope="row">{{$post->id}}</th>
                                                <td colspan="2">{{$post->title}}</td>
                                                <td>{{$post->user->name}}</td>
                                                <td>
                                                    <a href="#&p={{$post->id}}"><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modal-post"><i class="fas fa-arrow-circle-right"></i> Editar</button></a>
                                                    <form action="{{ route('posts.destroy',[$post->id]) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <a href="">
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="fas fa-arrow-circle-right"></i>
                                                                Eliminar
                                                            </button>
                                                        </a>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                        @php
                            $key++;
                        @endphp
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="contenedor">
        <button class="botonF1">
            <span>+</span>
        </button>
        <a href="#&c=new">
            <button title="NUEVA CATEGORÍA" class="btnFloat botonF2" data-bs-toggle="modal" data-bs-target="#modal-category">
                <label>NUEVA CATEGORÍA</label>
                <span>+</span>
            </button>
        </a>
        <a href="#&p=new">
            <button title="NUEVA PUBLICACIÓN" class="btnFloat botonF3" data-bs-toggle="modal" data-bs-target="#modal-post">
                <label>NUEVA PUBLICACIÓN</label>
                <span>+</span>
            </button>
        </a>
        <!-- <button class="btnFloat botonF4">
            <span>+</span>
        </button>
        <button class="btnFloat botonF5">
            <span>+</span>
        </button> -->
    </div>
    <!-- Modal New Category-->
    <div class="modal fade" id="modal-category" tabindex="-1" aria-labelledby="labelCategory" aria-hidden="true">
        <div class="modal-dialog">
            <!-- New Category -->
            <div id="newCategory" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="labelCategory">Nueva categoría</h5>
                    <a href=""><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></a>
                </div>
                <div class="modal-body">
                    <form action="{{ route('post-categories.store') }}" method="POST">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <p>Corrige los siguientes errores:</p>
                                <ul>
                                    @foreach ($errors->all() as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @csrf
                        <label for="name">Nombre: </label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Digite el nombre de la categoría" value="{{ old('name') }}">
                        <div class="modal-footer">
                            <a href=""><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></a>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End New Category -->
            <!-- Edit Category -->
            <div id="editCategory" class="modal-content" style="display: none;">
                <div class="modal-header">
                    <h5 class="modal-title" id="labelCategory">Editar categoría</h5>
                    <a href=""><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></a>
                </div>
                <div class="modal-body">
                    <form action="" enctype="multipart/form-data" method="POST">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <p>Corrige los siguientes errores:</p>
                                <ul>
                                    @foreach ($errors->all() as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @method('PATCH')
                        @csrf
                        <label for="name">Nombre: </label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Digite el nombre de la categoría" value="{{ old('name') }}">
                        <div class="modal-footer">
                            <a href=""><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></a>
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-category">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Edit Category -->
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-post" tabindex="-1" aria-labelledby="labelPost" aria-hidden="true">
        <div class="modal-dialog">
            <div id="newPost" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="labelPost">Nueva publicación</h5>
                    <a href=""><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></a>
                </div>
                <div class="modal-body">
                    <form action="{{ route('posts.store') }}" enctype="multipart/form-data" method="POST">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <p>Corrige los siguientes errores:</p>
                                <ul>
                                    @foreach ($errors->all() as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @csrf
                        <label for="title">Título: </label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Digite el título de la publicación">
                        <label for="description">Descripción: </label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                        <label for="image">Imagen: </label>
                        <input type="file" name="image" id="image" readonly class="form-control-plaintext">
                        <label for="category">Categoría: </label>
                        <select name="category" id="category" class="form-select">
                            <option value="">Selecione..</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                        </select>
                        <div class="modal-footer">
                            <a href="">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </a>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- EDITAR POST -->
            <div id="editPost" class="modal-content" style="display: none;">
                <div class="modal-header">
                    <h5 class="modal-title" id="labelPost">Editar publicación</h5>
                    <a href=""><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></a>
                </div>
                <div class="modal-body">
                    <form action="" enctype="multipart/form-data" method="POST">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <p>Corrige los siguientes errores:</p>
                                <ul>
                                    @foreach ($errors->all() as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @method('PATCH')
                        @csrf
                        <label for="title">Título: </label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Digite el título de la publicación">
                        <label for="description">Descripción: </label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                        <label for="image">Imagen: </label>
                        <input type="file" name="image" id="image" readonly class="form-control-plaintext">
                        <img src="" class="form-control">
                        <label for="category">Categoría: </label>
                        <select name="category" id="category" class="form-select">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                        </select>
                        <div class="modal-footer">
                            <a href="">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </a>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-delete-category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            Al eliminar la categoria <strong></strong> se eliminan todas las publicaciones asignadas a la misma. ¿Está seguro que desea eliminar la categoria <strong></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-category">Close</button>
                <form id="form_delete_category" action="" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        Eliminar
                    </button>
                </form>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>
