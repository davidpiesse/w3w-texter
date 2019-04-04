<?php

namespace App\Http\Livewire;

use Livewire\LivewireComponent;
use App\TodoItem;

class TodoList extends LivewireComponent
{
    //will auto be sent as is :)
    public $listeners = [
        'todos-updated' => 'updateList'
    ];

    public $todos; 

    public function created(){
        $this->todos = TodoItem::all();

        // $this->listenFor([
        //     'todos-updated' => 'updateList'
        // ]);
    }

    public function updateList(){
        $this->todos = TodoItem::all();
    }

    public function render()
    {
        return view('livewire.todo-list');
    }
}
