<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Car;
use App\Models\Lesson;
use Carbon\Carbon;

class CheckCarAvailability extends Command
{
    protected $signature = 'cars:check-availability {date} {start_time} {end_time}';
    protected $description = 'Check the availability of cars for a given date, start time, and end time';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $date = $this->argument('date');
        $startTime = $this->argument('start_time');
        $endTime = $this->argument('end_time');

        $lessons = Lesson::where('date', $date)
            ->where(function($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                      ->orWhereBetween('end_time', [$startTime, $endTime])
                      ->orWhere(function($query) use ($startTime, $endTime) {
                          $query->where('start_time', '<=', $startTime)
                                ->where('end_time', '>=', $endTime);
                      });
            })
            ->get();

        $unavailableCars = $lessons->pluck('car_id')->unique();
        $availableCars = Car::whereNotIn('id', $unavailableCars)->get();

        if ($availableCars->isEmpty()) {
            $this->info("No cars available on $date between $startTime and $endTime.");
        } else {
            $this->info("Available cars on $date between $startTime and $endTime:");
            foreach ($availableCars as $car) {
                $this->info("Car ID: {$car->id}, Marque: {$car->marque}, Modèle: {$car->modele}");
            }
        }

        return 0;
    }
}
