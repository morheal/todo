<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $task;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($_task)
    {
        return $this->task = $_task;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->from('todo@gmail.com', 'Todo')
         ->subject('Скоро дедлайн задания: '. $this->task->title);
         ->view('mail.task_reminder');
    }
}
