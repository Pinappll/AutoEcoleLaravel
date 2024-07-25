<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Lesson;

class LessonReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $lesson;

    public function __construct(Lesson $lesson)
    {
        $this->lesson = $lesson;
    }

    public function build()
    {
        return $this->subject('Lesson Reminder')
                    ->view('emails.lesson_reminder');
    }
}
