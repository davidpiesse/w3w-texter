<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Notifications\SendMessage;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class MessagePIN implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $mayday;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mayday)
    {
        $this->mayday = $mayday;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Send SMS to user
        $this->mayday->notify(new SendMessage());
        return;
    }
}
