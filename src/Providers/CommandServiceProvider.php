<?php

namespace Grilar\PluginManagement\Providers;

use Grilar\Base\Supports\ServiceProvider;
use Grilar\PluginManagement\Commands\ClearCompiledCommand;
use Grilar\PluginManagement\Commands\IlluminateClearCompiledCommand as OverrideIlluminateClearCompiledCommand;
use Grilar\PluginManagement\Commands\PackageDiscoverCommand;
use Grilar\PluginManagement\Commands\PluginActivateAllCommand;
use Grilar\PluginManagement\Commands\PluginActivateCommand;
use Grilar\PluginManagement\Commands\PluginAssetsPublishCommand;
use Grilar\PluginManagement\Commands\PluginDeactivateAllCommand;
use Grilar\PluginManagement\Commands\PluginDeactivateCommand;
use Grilar\PluginManagement\Commands\PluginDiscoverCommand;
use Grilar\PluginManagement\Commands\PluginInstallFromMarketplaceCommand;
use Grilar\PluginManagement\Commands\PluginListCommand;
use Grilar\PluginManagement\Commands\PluginRemoveAllCommand;
use Grilar\PluginManagement\Commands\PluginRemoveCommand;
use Illuminate\Foundation\Console\ClearCompiledCommand as IlluminateClearCompiledCommand;
use Illuminate\Foundation\Console\PackageDiscoverCommand as IlluminatePackageDiscoverCommand;

class CommandServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->extend(IlluminatePackageDiscoverCommand::class, function () {
            return $this->app->make(PackageDiscoverCommand::class);
        });

        $this->app->extend(IlluminateClearCompiledCommand::class, function () {
            return $this->app->make(OverrideIlluminateClearCompiledCommand::class);
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                PluginAssetsPublishCommand::class,
                ClearCompiledCommand::class,
                PluginDiscoverCommand::class,
                PluginInstallFromMarketplaceCommand::class,
            ]);
        }

        $this->commands([
            PluginActivateCommand::class,
            PluginActivateAllCommand::class,
            PluginDeactivateCommand::class,
            PluginDeactivateAllCommand::class,
            PluginRemoveCommand::class,
            PluginRemoveAllCommand::class,
            PluginListCommand::class,
        ]);
    }
}
