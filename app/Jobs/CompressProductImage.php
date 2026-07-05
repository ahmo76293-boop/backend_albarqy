<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\ImageManager;

class CompressProductImage implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public string $imagePath
    ) {}

    public function handle(): void
    {
        $manager = new ImageManager(new Driver());

        $image = $manager
            ->decode(Storage::disk('public')->path($this->imagePath))
            ->scaleDown(width: 1000)
            ->encode(new JpegEncoder(quality: 75));

        Storage::disk('public')->put(
            $this->imagePath,
            $image->toString()
        );
    }
}
