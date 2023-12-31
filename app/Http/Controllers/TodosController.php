<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class TodosController extends Controller
{
    /**
     * index para mostrar todos los lados
     * store para guardar un todo
     * update para actualizar un todo
     * destroy para eliminar un todo
     * edit para mostrar el formulario de edicion
     */

     public function store(Request $request){

        $request->validate([
            'title' => 'required|min:3'
        ]);

        $todo = new Todo;
        $todo->title = $request->title;
        $todo->category_id = $request->category_id;
        $todo->user_id = Auth::user()->id;
        $todo->save();

        return redirect()->route('todos')->with('success','Tarea creada correctamente');
     }

     public function index(){
         $todos = Todo::all();
         $categories = Category::all();

        return view('todo.todos.index', ['todos' => $todos, 'categories' => $categories]);
     }

     public function show($id){
        $todo = Todo::find($id);
       return view('todo.todos.show', ['todo' => $todo]);
    }

    public function update(Request $request, $id){
        $todo = Todo::find($id);
        $todo->title = $request->title;
        $todo->save();

        //dd($request);
       //return view('todos.index', ['succes', 'Tarea actualizada']);
       return redirect()->route('todos')->with('success','Tarea actualizada');
    }

    public function destroy($id){
        $todo = Todo::find($id);
        $todo->delete();
        return redirect()->route('todos')->with('success','Tarea ha sido eliminada');
    }
}
