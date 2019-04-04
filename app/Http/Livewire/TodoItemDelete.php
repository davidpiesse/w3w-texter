<?php

namespace App\Http\Livewire;

use App\TodoItem;
use Livewire\LivewireComponent;

class TodoItemDelete extends LivewireComponent
{
    public function deleteAll(){
        TodoItem::all()->each(function($item){
            $item->delete();
        });

        $this->emit('todos-updated');
    }

    public function render()
    {
        return view('livewire.todo-item-delete');
    }
}
