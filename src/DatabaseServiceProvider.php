<?php

declare(strict_types=1);

namespace Yard\Database;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Yard\Database\Console\DatabaseCommand;

class DatabaseServiceProvider extends PackageServiceProvider
{
	public function configurePackage(Package $package): void
	{
		$package
			->name('wp-database')
			->hasConfigFile()
			->hasViews()
			->hasCommand(DatabaseCommand::class);
	}

	public function packageRegistered(): void
	{
		$this->app->singleton(Database::class, fn () => new Database($this->app));
	}

	public function packageBooted(): void
	{
		$this->app->make(Database::class);
	}
}
