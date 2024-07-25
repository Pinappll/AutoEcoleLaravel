<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Lesson;
use Illuminate\Support\Facades\Mail;
use App\Mail\LessonReminder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SendNotifications extends Command
{
    protected $signature = 'notifications:send';
    protected $description = 'Send notifications to students and instructors about upcoming lessons';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Log::info('Starting notification command');

        $lessons = Lesson::where('date', '=', Carbon::tomorrow()->toDateString())->get();
        Log::info('Fetched lessons', ['count' => $lessons->count()]);

        foreach ($lessons as $lesson) {
            if ($lesson->student && $lesson->moniteur) {
                try {
                    Mail::to($lesson->student->email)->send(new LessonReminder($lesson));
                    // Mail::to($lesson->moniteur->email)->send(new LessonReminder($lesson));
                    $this->info("Notification sent for lesson ID {$lesson->id}.");
                    Log::info('Notification sent', ['lesson_id' => $lesson->id]);
                } catch (\Exception $e) {
                    $this->error("Failed to send notification for lesson ID {$lesson->id}.");
                    Log::error('Failed to send notification', [
                        'lesson_id' => $lesson->id,
                        'error' => $e->getMessage()
                    ]);
                }
            } else {
                $this->error("Lesson ID {$lesson->id} is missing student or instructor email.");
                Log::warning('Missing student or instructor email', ['lesson_id' => $lesson->id]);
            }
        }

        $this->info("Notifications sent for upcoming lessons.");
        Log::info('Finished notification command');
        return 0;
    }
}
