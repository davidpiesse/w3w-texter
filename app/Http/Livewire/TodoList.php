<?php

namespace App\Http\Livewire;

use App\TodoItem;
use Livewire\LivewireComponent;
use App\Events\NewTodo;

class TodoList extends LivewireComponent
{
    //For local listeners NOT Echo
    public $listeners = [
        'todos-updated' => 'updateList'
    ];

    public $todos; 

    public function created(){
        $this->attachEchoPublicListener('todos','NewTodo', 'todos-updated');
        // $this->attachEchoPrivateListener('todos','NewTodo', 'todos-updated');
        // $this->attachEchoPresenceListener('todos','here', 'todos-updated');

        $this->todos = TodoItem::all();
    }

    public function updateList(){
        $this->todos = TodoItem::all();
    }

    public function render()
    {
        return view('livewire.todo-list');
    }
}
