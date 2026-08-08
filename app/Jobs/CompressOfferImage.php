<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\ImageManager;

class CompressOfferImage implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $imagePath
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $manager = new ImageManager(new Driver);

        $fullPath = Storage::disk('public')->path($this->imagePath);

        // Make sure the image still exists
        if (!Storage::disk('public')->exists($this->imagePath)) {
            return;
        }

        $image = $manager
            ->decode($fullPath)
            ->scaleDown(width: 800)
            ->encode(
                new JpegEncoder(quality: 75)
            );

        Storage::disk('public')->put(
            $this->imagePath,
            $image->toString()
        );
    }
}
