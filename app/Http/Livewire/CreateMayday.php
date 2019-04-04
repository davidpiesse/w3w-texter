<?php

namespace App\Http\Livewire;

use App\Mayday;
use App\Jobs\MessagePIN;
use Livewire\LivewireComponent;

class CreateMayday extends LivewireComponent
{
    public $phone_number;

    public function createMayday(){

        $valid_data = $this->validate([
            'phone_number' => 'required|phone:US'
        ]);
        
        $mayday = Mayday::create([
            'phone_number' => $valid_data['phone_number']
        ]);
        
        dispatch(new MessagePIN($mayday));

        $this->redirect(route('mayday.track', $mayday));
    }

    public function render()
    {
        return view('livewire.create-mayday');
    }
}
