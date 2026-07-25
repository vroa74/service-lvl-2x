<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CleanTempReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reports:clean {--days=1 : Number of days old files to delete}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean temporary report files older than specified days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = $this->option('days');
        $tempPath = storage_path('app/public/temp');
        
        if (!File::exists($tempPath)) {
            $this->info('Temp directory does not exist. Nothing to clean.');
            return 0;
        }

        $files = File::files($tempPath);
        $deletedCount = 0;
        $cutoffTime = now()->subDays($days);

        foreach ($files as $file) {
            if (File::lastModified($file) < $cutoffTime->timestamp) {
                File::delete($file);
                $deletedCount++;
                $this->line("Deleted: " . $file->getFilename());
            }
        }

        $this->info("Cleaned {$deletedCount} temporary report files older than {$days} days.");
        
        return 0;
    }
}
