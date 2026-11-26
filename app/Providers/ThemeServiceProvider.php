<?php

declare(strict_types=1);

namespace Themes\Civic\Providers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Blade;
use Modules\Xot\Actions\Blade\RegisterBladeComponentsAction;
use Modules\Xot\Providers\XotBaseThemeServiceProvider;
use Safe\Exceptions\FilesystemException;
use Themes\Civic\Actions\CieAuthAction;
use Themes\Civic\Actions\MenuBuilderAction;
use Themes\Civic\Actions\SpidAuthAction;
use Themes\Civic\Adapters\ThemeAdapter;
use Themes\Civic\Console\Commands\CivicInstallCommand;
use Themes\Civic\Console\Commands\CivicPublishCommand;
use Themes\Civic\Contracts\MenuFilterInterface;
use Themes\Civic\Filters\ActiveMenuFilter;
use Themes\Civic\Filters\GateMenuFilter;
use Themes\Civic\Filters\HrefMenuFilter;
use Themes\Civic\View\Composers\CivicComposer;

use function Safe\glob;
use function Safe\realpath;

/**
 * Enhanced Service Provider per il tema Civic.
 *
 * Questo provider gestisce la registrazione e configurazione
 * del tema Civic nell'applicazione Laravel, integrando il
 * nuovo Menu Builder System e le funzionalità avanzate.
 *
 * IMPORTANTE: Il tema Civic usa il namespace 'pub_theme' per le viste,
 * non 'civic', per essere compatibile con il sistema di temi.
 *
 * @see docs/adr/0005-attivazione-civic-e-convivenza-con-sixteen.md
 * @see docs/contracts/theme-identity.md
 */
class ThemeServiceProvider extends XotBaseThemeServiceProvider
{
    public string $name = 'Civic';

    public string $nameLower = 'civic';

    protected string $module_dir = __DIR__.'/../../';

    protected string $module_ns = __NAMESPACE__;

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Load theme resources BEFORE parent to ensure pub_theme namespace is registered first
        $this->loadCoreThemeResources();

        parent::boot();

        // Menu system registration
        $this->registerMenuSystem();

        // View composers
        $this->registerViewComposers();

        // Artisan commands
        $this->registerCommands();

        // Publishing configurations
        $this->registerPublishing();

        // Authentication routes
        $this->registerAuthRoutes();

        // Layout shortcuts (legacy compatibility)
        $this->registerLayoutShortcuts();
    }

    /**
     * Register any application services.
     *
     * Non chiama `parent::register()`: la base registra `{module_ns}\Providers\RouteServiceProvider` ed
     * `EventServiceProvider`, che nel tema non esistono (con `module_ns` = questo namespace il nome diventava
     * `Themes\Civic\Providers\Providers\RouteServiceProvider`) e fanno morire la registrazione con «Class not found».
     * Le rotte del tema si caricano in `registerAuthRoutes()`.
     *
     * @see docs/adr/0005-attivazione-civic-e-convivenza-con-sixteen.md
     */
    public function register(): void
    {
        // Register core services
        $this->registerCoreServices();

        // Register menu filters
        $this->registerMenuFilters();

        // Register SPID/CIE services
        $this->registerAuthServices();
    }

    /**
     * Load core theme resources
     */
    protected function loadCoreThemeResources(): void
    {
        // IMPORTANTE: pub_theme è il namespace standard per i temi
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'pub_theme');
        $this->loadTranslationsFrom(__DIR__.'/../../lang', 'pub_theme');

        // Register 'civic' namespace for backward compatibility
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'civic');
        $this->loadTranslationsFrom(__DIR__.'/../../lang', 'civic');

        // Caricamento delle configurazioni del tema
        // Keep the main theme contract at config('civic.*'); the per-file
        // namespace loader below remains available for legacy config groups.
        $this->mergeConfigFrom(__DIR__.'/../../config/civic.php', 'civic');
        $this->loadConfigFrom(__DIR__.'/../../config', 'civic');
    }

    /**
     * Register the Menu Builder system
     */
    protected function registerMenuSystem(): void
    {
        // Singleton per il Menu Builder
        $this->app->singleton(MenuBuilderAction::class, static fn (): MenuBuilderAction => new MenuBuilderAction);

        // Alias per backward compatibility
        $this->app->alias(MenuBuilderAction::class, 'civic.menu');
    }

    /**
     * Register core services
     */
    protected function registerCoreServices(): void
    {
        // Theme Service con dependency injection del MenuBuilder
        $this->app->singleton('civic.theme', function ($app) {
            return new ThemeAdapter;
        });

        // Alias per il ThemeService
        $this->app->alias('civic.theme', ThemeAdapter::class);
    }

    /**
     * Register menu filters
     */
    protected function registerMenuFilters(): void
    {
        // Register default menu filters
        $this->app->singleton(HrefMenuFilter::class);
        $this->app->singleton(ActiveMenuFilter::class);
        $this->app->singleton(GateMenuFilter::class);

        // Tag them for the menu builder
        $this->app->tag([
            HrefMenuFilter::class,
            ActiveMenuFilter::class,
            GateMenuFilter::class,
        ], 'civic.menu.filters');

        // Register the interface binding for extension
        $this->app->bind(MenuFilterInterface::class, HrefMenuFilter::class);
    }

    /**
     * Register SPID/CIE authentication services
     */
    protected function registerAuthServices(): void
    {
        // Register SPID Auth Service
        $this->app->singleton(SpidAuthAction::class, function ($app) {
            return new SpidAuthAction;
        });

        // Register CIE Auth Service
        $this->app->singleton(CieAuthAction::class, function ($app) {
            return new CieAuthAction;
        });

        // Aliases for easier access
        $this->app->alias(SpidAuthAction::class, 'civic.spid');
        $this->app->alias(CieAuthAction::class, 'civic.cie');
    }

    /**
     * Register view composers
     */
    protected function registerViewComposers(): void
    {
        // Composer per layout principali
        $this->app->make('view')->composer([
            'pub_theme::layouts.app',
            'pub_theme::layouts.guest',
            'pub_theme::layouts.guest-agid',
            'pub_theme::components.layout.header',
            'pub_theme::components.layout.footer',
        ], CivicComposer::class);
    }

    /**
     * Register Artisan commands
     */
    protected function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CivicInstallCommand::class,
                CivicPublishCommand::class,
            ]);
        }
    }

    /**
     * Register publishing configurations
     */
    protected function registerPublishing(): void
    {
        // Pubblicazione degli assets del tema
        $this->publishes([
            __DIR__.'/../../resources/assets' => public_path('themes/civic/assets'),
            __DIR__.'/../../public' => public_path('themes/civic'),
        ], 'civic-assets');

        // Pubblicazione delle configurazioni del tema
        $this->publishes([
            __DIR__.'/../../config' => config_path('themes/civic'),
        ], 'civic-config');

        // Pubblicazione delle viste (opzionale per personalizzazioni)
        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/themes/civic'),
        ], 'civic-views');
    }

    /**
     * Register anonymous components for pub_theme namespace.
     */
    /**
     * Register Blade components for both civic and pub_theme namespaces.
     */
    protected function registerBladeComponents(): void
    {
        // `module_ns` e' il namespace di questo provider (`Themes\Civic\Providers`), non quello del tema: con quello i
        // componenti di classe cadevano in `Themes\Civic\Providers\View\Components` e in una cartella fuori dal tema.
        $themeNamespace = 'Themes\\Civic';
        $componentNamespace = $themeNamespace.'\View\Components';

        // Register with civic namespace (parent)
        Blade::componentNamespace($componentNamespace, 'civic');

        // Register with pub_theme namespace (for theme compatibility)
        Blade::componentNamespace($componentNamespace, 'pub_theme');

        // Register anonymous components (default + pub_theme namespace)
        try {
            $componentsPath = realpath(__DIR__.'/../../resources/views/components');
            Blade::anonymousComponentPath($componentsPath);
            Blade::anonymousComponentPath($componentsPath, 'pub_theme');
        } catch (FilesystemException) {
            // Directory dei componenti non presente: nessun componente anonimo da registrare.
        }

        // Register class-based components
        app(RegisterBladeComponentsAction::class)
            ->execute(__DIR__.'/../View/Components', $themeNamespace);
    }

    /**
     * Register authentication routes
     */
    protected function registerAuthRoutes(): void
    {
        if (! static::digitalIdentityRoutesEnabled()) {
            return;
        }

        if (! $this->app->routesAreCached()) {
            $this->loadRoutesFrom(__DIR__.'/../../routes/auth.php');
        }
    }

    /**
     * Registra i layout shortcuts AGID per il tema (legacy compatibility).
     */
    protected function registerLayoutShortcuts(): void
    {
        // Registrazione dei layout shortcuts per facilitare l'uso
        $this->app->make('view')->addNamespace('layouts', __DIR__.'/../../resources/views/layouts');

        // Enhanced composer per layout AGID-compliant
        $this->app->make('view')->composer('layouts.guest-agid', function (View $view): void {
            $themeService = app(ThemeAdapter::class);

            $view->with([
                'theme_name' => 'Civic',
                'theme_info' => $themeService->getInfo(),
                'agid_compliant' => true,
                'accessibility_level' => 'WCAG 2.1 AA',
                'compliance_check' => $themeService->checkAgidCompliance(),
            ]);
        });
    }

    /**
     * Carica le configurazioni del tema.
     */
    protected function loadConfigFrom(string $path, string $namespace): void
    {
        if (! is_dir($path)) {
            return;
        }

        try {
            $files = glob($path.'/*.php');
        } catch (FilesystemException) {
            return;
        }

        foreach ($files as $file) {
            if (! is_string($file)) {
                continue;
            }

            $name = basename($file, '.php');
            $this->mergeConfigFrom($file, $namespace.'.'.$name);
        }
    }

    /**
     * Vero solo se l'identità digitale (SPID/CIE) è stata abilitata esplicitamente.
     */
    public static function digitalIdentityRoutesEnabled(): bool
    {
        return config('civic.auth.spid.enabled') === true;
    }
}
