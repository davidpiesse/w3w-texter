<?php

namespace App\Http\Livewire;

use App\TodoItem;
use App\Events\NewTodo;
use Livewire\LivewireComponent;

class TodoItemCreate extends LivewireComponent
{
    public $todo;

    public function createTodo(){

        $todo = TodoItem::create([
            'name' => $this->todo
        ]);

        // How to rest the value in the input box
        // $this->todo = "";

        // Need to reset event handlers
        //keeps this from last time

        //broadcasting to all BUT me
        broadcast(new NewTodo($todo));
        // Event should work too
        // event(new NewTodo($todo));

        // $this->emit('todos-updated');
    }

    public function render()
    {
        return view('livewire.todo-item-create');
    }
}
