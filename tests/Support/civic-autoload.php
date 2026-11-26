<?php

declare(strict_types=1);

/**
 * Autoload PSR-4 di Civic per i test del tema.
 *
 * Il Composer dell'host non conosce i temi: li registra a runtime `Modules\Xot\Actions\Composer\RegisterRuntimePsr4NamespacesAction`
 * con un elenco scritto a mano in cui Civic non c'e'. Finche' quella voce non c'e', senza questo file
 * `Themes\Civic\...` non si carica e ogni test che usa una classe del tema muore con «Class not found».
 * Il file e' idempotente e non sostituisce la voce dell'host: quando c'e', il primo registrato vince e punta alla stessa cartella.
 *
 * @see docs/adr/0005-attivazione-civic-e-convivenza-con-sixteen.md
 */
spl_autoload_register(static function (string $class): void {
    $themeRoot = dirname(__DIR__, 2);

    foreach (['Themes\\Civic\\Tests\\' => 'tests/', 'Themes\\Civic\\' => 'app/'] as $prefix => $directory) {
        if (! str_starts_with($class, $prefix)) {
            continue;
        }

        $file = $themeRoot.'/'.$directory.str_replace('\\', '/', substr($class, strlen($prefix))).'.php';
        if (is_file($file)) {
            require_once $file;
        }

        return;
    }
});
