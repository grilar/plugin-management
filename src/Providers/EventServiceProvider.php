<?php

namespace Grilar\PluginManagement\Providers;

use Grilar\Installer\Events\InstallerFinished;
use Grilar\PluginManagement\Listeners\ClearPluginCaches;
use Illuminate\Contracts\Database\Events\MigrationEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        MigrationEvent::class => [
            ClearPluginCaches::class,
        ],
        InstallerFinished::class => [
            ClearPluginCaches::class,
        ],
    ];
}
