<?php

declare(strict_types=1);

namespace Themes\Civic\Console\Commands;

use Illuminate\Console\Command;

/**
 * Comando Artisan per pubblicare gli asset e configurazioni del tema Civic
 */
class CivicPublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'civic:publish {--force : Overwrite any existing files}';

    /**
     * The console command description.
     */
    protected $description = 'Publish Civic theme assets and configuration files';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Publishing Civic theme files...');

        // Publish assets
        $this->call('vendor:publish', [
            '--tag' => 'civic-assets',
            '--force' => $this->option('force'),
        ]);

        // Publish configuration
        $this->call('vendor:publish', [
            '--tag' => 'civic-config',
            '--force' => $this->option('force'),
        ]);

        // Show completion message
        $this->info('✅ Civic theme published successfully!');

        $this->comment('Next steps:');
        $this->line('• Update your .env file with Civic configuration variables');
        $this->line('• Run "npm run build" to compile theme assets');
        $this->line('• Clear cache with "php artisan optimize:clear"');

        return self::SUCCESS;
    }
}
