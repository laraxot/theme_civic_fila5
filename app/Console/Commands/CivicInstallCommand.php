<?php

declare(strict_types=1);

namespace Themes\Civic\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * Comando Artisan per l'installazione completa del tema Civic
 */
class CivicInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'civic:install {--force : Overwrite any existing files}';

    /**
     * The console command description.
     */
    protected $description = 'Install Civic theme with all required files and dependencies';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('🚀 Installing Civic theme...');

        // Step 1: Publish theme files
        $this->info('📦 Publishing theme files...');
        $this->call('civic:publish', [
            '--force' => $this->option('force'),
        ]);

        // Step 2: Create environment variables template
        $this->createEnvTemplate();

        // Step 3: Clear caches
        $this->info('🧹 Clearing caches...');
        $this->call('optimize:clear');

        // Step 4: Show completion
        $this->showCompletionMessage();

        return self::SUCCESS;
    }

    /**
     * Create .env template with Civic variables
     */
    protected function createEnvTemplate(): void
    {
        $this->info('📄 Creating .env template...');

        $envExample = base_path('.env.civic.example');

        $template = $this->getEnvTemplate();

        File::put($envExample, $template);

        $this->comment("Created {$envExample}");
        $this->line('You can copy these variables to your .env file');
    }

    /**
     * Get the environment variables template
     */
    protected function getEnvTemplate(): string
    {
        return <<<'ENV'
# Civic Theme Configuration
# Copy these variables to your .env file and customize as needed

# App Information
CIVIC_APP_NAME="Applicazione PA"
CIVIC_TAGLINE="Servizi digitali per i cittadini"
CIVIC_DESCRIPTION="Ente di appartenenza"
CIVIC_VERSION="1.0.0"

# Brand Configuration
CIVIC_LOGO_TYPE=icon
CIVIC_LOGO_SOURCE="heroicon-o-building-office"
CIVIC_LOGO_ALT="Logo istituzionale"
CIVIC_PRIMARY_COLOR="#0066CC"
CIVIC_SECONDARY_COLOR="#5A6772"

# Layout Settings
CIVIC_SLIM_HEADER=true
CIVIC_SHOW_SEARCH=true
CIVIC_SHOW_SOCIAL=true
CIVIC_BREADCRUMBS=true
CIVIC_BACK_TO_TOP=true
CIVIC_COOKIEBAR=true

# Contact Information
CIVIC_ADDRESS="Via Roma 1<br>00100 Roma (RM)"
CIVIC_PHONE="+39 06 12345678"
CIVIC_EMAIL="info@comune.esempio.it"
CIVIC_PEC="protocollo@pec.comune.esempio.it"
CIVIC_CF_PIVA="12345678901"
CIVIC_IPA_CODE="c_a123"

# Performance & SEO
CIVIC_LAZY_LOADING=true
CIVIC_PRELOAD_CSS=true
CIVIC_CACHE_MENU=true
CIVIC_OG_ENABLED=true
CIVIC_SCHEMA_ENABLED=true

# Accessibility
CIVIC_SKIP_LINKS=true
CIVIC_KEYBOARD_NAV=true
CIVIC_SCREEN_READER=true
ENV;
    }

    /**
     * Show installation completion message
     */
    protected function showCompletionMessage(): void
    {
        $this->info('🎉 Civic theme installed successfully!');

        $this->comment('Next steps:');
        $this->line('1. Copy variables from .env.civic.example to your .env file');
        $this->line('2. Customize the configuration in config/civic.php');
        $this->line('3. Run "npm install && npm run build" to build assets');
        $this->line('4. Update your layout to use pub_theme views');

        $this->warn('⚠️  Remember to:');
        $this->line('• Configure your web server to serve static assets');
        $this->line('• Set up proper permissions for the public/themes directory');
        $this->line('• Test accessibility features with screen readers');
    }
}
