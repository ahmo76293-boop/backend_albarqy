<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\ImageManager;

class CompressCategoryImage implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $imagePath)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $manager = new ImageManager(new Driver);

        $image = $manager
            ->decode(Storage::disk('public')->path($this->imagePath))
            ->scaleDown(width: 800)
            ->encode(new JpegEncoder(quality: 75));

        Storage::disk('public')->put(
            $this->imagePath,
            $image->toString()
        );
    }
}
