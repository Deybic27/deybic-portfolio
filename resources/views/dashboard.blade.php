<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- {{ __('Dashboard') }} -->
            Proyectos desarrollados
        </h2>
    </x-slot>
    <link rel="stylesheet" href="icons/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <div>
                            <h2>
                                Administrador de tareas
                            </h2>
                            <div>
                                <p>
                                    Aplicación para administrar tareas diarias desarrollada con PHP, Laravel y bootstrap.
                                </p>
                                <a href="{{route('todos')}}">
                                    <i class="fas fa-arrow-circle-right"></i>
                                    Ver demo
                                </a>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h2>
                                Administrador de personas
                            </h2>
                            <div>
                                <p>

                                </p>Aplicación para registro de personas desarrollada con PHP, Laravel y Bootstrap.
                                <a href="{{route('peoples.index')}}">
                                    <i class="fas fa-arrow-circle-right"></i>
                                    Ver demo
                                </a>
                            </div>
                        </div>
                        <div>
                            <h2>
                                Administrador de créditos
                            </h2>
                            <div>
                                <p>
                                    Aplicación para simular y administrar créditos desarrollada con Javascript, Jquery y Bootstrap.
                                </p>
                                <a href="{{route('credit')}}"> 
                                    <i class="fas fa-arrow-circle-right"></i>
                                    Ver demo
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
