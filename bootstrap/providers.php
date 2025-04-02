<?php

use App\Providers\AppServiceProvider;
use App\Providers\Filament\AdminPanelProvider;
use Artesaos\SEOTools\Providers\SEOToolsServiceProvider;

return [
    AppServiceProvider::class,
    AdminPanelProvider::class,
    SEOToolsServiceProvider::class
];
