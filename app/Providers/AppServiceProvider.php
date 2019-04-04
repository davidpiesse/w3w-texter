<?php

namespace App\Providers;

use Livewire\Livewire;
use App\Http\Livewire\CreateMayday;
use Illuminate\Support\ServiceProvider;
use App\Http\Livewire\TodoItemCreate;
use App\Http\Livewire\TodoList;
use App\Http\Livewire\TodoItemDelete;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Livewire::component('mayday-create', CreateMayday::class);
        Livewire::component('todo-create', TodoItemCreate::class);
        Livewire::component('todo-delete', TodoItemDelete::class);
        Livewire::component('todo-list', TodoList::class);
    }
}
