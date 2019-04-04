<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Mayday extends Model
{
    use Notifiable;

    protected $guarded = [];

    protected $casts = [
        'last_location' => 'array',
        'last_connection' => 'array'
    ];

    public function close(){
        $this->update([
            'status' => 'closed'
        ]);
    }

}
