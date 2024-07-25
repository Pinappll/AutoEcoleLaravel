<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Car;
use App\Models\User;
use App\Models\Lesson;

class GetStatistics extends Command
{
    protected $signature = 'stats:get';
    protected $description = 'Get various statistics for the application';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Récupérer les statistiques
        $numberOfCars = Car::count();
        $numberOfStudents = User::role('eleve')->count();
        $numberOfMonitors = User::role('moniteur')->count();
        $numberOfLessons = Lesson::count();

        // Afficher les statistiques
        $this->info("Nombre de voitures: $numberOfCars");
        $this->info("Nombre d'élèves: $numberOfStudents");
        $this->info("Nombre de moniteurs: $numberOfMonitors");
        $this->info("Nombre de leçons: $numberOfLessons");

        return 0;
    }
}
