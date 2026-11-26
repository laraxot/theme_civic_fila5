<?php

declare(strict_types=1);

namespace Themes\Civic\View\Composers;

use Illuminate\View\View;
use Themes\Civic\Events\BuildingCivicMenu;
use Themes\Civic\Services\MenuBuilder;

/**
 * View Composer per il tema Civic
 *
use Themes\Civic\Actions\MenuBuilderAction;
use Themes\Civic\Events\BuildingCivicMenu;

/**
 * View Composer per il tema Civic
 * 
 * Questo composer inietta le configurazioni del tema e i menu
 * costruiti dinamicamente nelle viste del layout
 */
class CivicComposer
{
    public function __construct(
        protected MenuBuilderAction $menuBuilder
    ) {}

    /**
     * Componi la vista con i dati del tema
     */
    public function compose(View $view): void
    {
        // Configurazioni base del tema
        $config = config('civic', []);

        // Costruzione dinamica dei menu tramite eventi
        $this->buildMenus();

        
        // Costruzione dinamica dei menu tramite eventi
        $this->buildMenus();
        
        // Inietta i dati nella vista
        $view->with([
            'civicConfig' => $config,
            'slimHeaderMenu' => $this->menuBuilder->getSlimHeader(),
            'headerMenu' => $this->menuBuilder->getHeader(),
            'footerMenu' => $this->menuBuilder->getFooter(),
            'footerBarMenu' => $this->menuBuilder->getFooterBar(),
            'themeInfo' => [
                'name' => 'Civic',
                'version' => config('civic.version', '1.0.0'),
                'agid_compliant' => true,
                'bootstrap_italia' => true,
                'tailwind_css' => true,
            ],
        ]);
    }

    /**
     * Costruisce i menu usando il sistema di eventi
     */
    protected function buildMenus(): void
    {
        // Inizializza i menu con quelli della configurazione
        $this->initializeMenusFromConfig();

        // Lancia eventi per permettere modifiche dinamiche
        $locations = ['slim_header', 'header', 'footer', 'footer_bar'];

        
        // Lancia eventi per permettere modifiche dinamiche
        $locations = ['slim_header', 'header', 'footer', 'footer_bar'];
        
        foreach ($locations as $location) {
            event(new BuildingCivicMenu($this->menuBuilder, $location));
        }
    }

    /**
     * Inizializza i menu con i dati dalla configurazione
     */
    protected function initializeMenusFromConfig(): void
    {
        $menuConfig = config('civic.menu', []);

        if (isset($menuConfig['slim_header'])) {
            $this->menuBuilder->addSlimHeader($menuConfig['slim_header']);
        }

        if (isset($menuConfig['header'])) {
            $this->menuBuilder->addHeader($menuConfig['header']);
        }

        if (isset($menuConfig['footer'])) {
            $this->menuBuilder->addFooter($menuConfig['footer']);
        }

        
        if (isset($menuConfig['slim_header'])) {
            $this->menuBuilder->addSlimHeader($menuConfig['slim_header']);
        }
        
        if (isset($menuConfig['header'])) {
            $this->menuBuilder->addHeader($menuConfig['header']);
        }
        
        if (isset($menuConfig['footer'])) {
            $this->menuBuilder->addFooter($menuConfig['footer']);
        }
        
        if (isset($menuConfig['footer_bar'])) {
            $this->menuBuilder->addFooterBar($menuConfig['footer_bar']);
        }
    }
}




