<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\UpdatePeminjamanTerlambat::class, // Add this line
    ];

    protected function schedule(Schedule $schedule)
    {
        // Schedule your commands
        $schedule->command('peminjaman:update-terlambat')->daily(); // Adjust frequency as needed
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}