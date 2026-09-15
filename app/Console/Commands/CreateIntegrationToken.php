<?php

namespace App\Console\Commands;

use App\Models\ApiIntegration;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateIntegrationToken extends Command
{
    protected $signature = 'integration:create-token {name : Integration name}';

    protected $description = 'Create a server-to-server integration token';

    public function handle(): int
    {
        $name = $this->argument('name');

        $token = Str::random(64);

        ApiIntegration::create([
            'name' => $name,
            'token_hash' => hash('sha256', $token),
            'is_active' => true,
        ]);

        $this->newLine();

        $this->info('Integration created successfully.');
        $this->line('Name: ' . $name);

        $this->newLine();

        $this->warn('IMPORTANT: Save this token now.');
        $this->warn('It will not be stored in plain text.');

        $this->newLine();

        $this->line('TOKEN:');
        $this->line($token);

        $this->newLine();

        return self::SUCCESS;
    }
}
