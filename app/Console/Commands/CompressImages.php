<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CompressImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:compress-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $directories = [
            public_path('images'),
            storage_path('app/public'),
        ];

        $extensions = ['jpg', 'jpeg', 'png', 'webp', 'bmp'];
        $count = 0;
        $failed = 0;

        foreach ($directories as $dir) {
            if (!is_dir($dir)) {
                continue;
            }

            $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir));
            foreach ($iterator as $file) {
                if ($file->isDir()) {
                    continue;
                }

                $ext = strtolower($file->getExtension());
                if (in_array($ext, $extensions)) {
                    $this->info("Compressing: " . $file->getPathname());
                    $success = \App\Services\ImageOptimizerService::compressExistingImage($file->getPathname());
                    if ($success) {
                        $count++;
                    } else {
                        $this->error("Failed: " . $file->getPathname());
                        $failed++;
                    }
                }
            }
        }

        $this->info("Compression complete. Compressed: $count, Failed: $failed.");
    }
}
