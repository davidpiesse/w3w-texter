<?php

namespace App\Http\Livewire;

use App\TodoItem;
use Livewire\LivewireComponent;

class TodoItemCreate extends LivewireComponent
{
    public $todo;

    public function createTodo(){
        TodoItem::create([
            'name' => $this->todo
        ]);

        // How to rest the value in the input box
        // $this->todo = "";

        // Need to reset event handlers
        //keeps this from last time
        $this->emit('todos-updated');
    }

    public function render()
    {
        return view('livewire.todo-item-create');
    }
}
