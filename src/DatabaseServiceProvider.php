<?php

declare(strict_types=1);

namespace Yard\Database;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class DatabaseServiceProvider extends PackageServiceProvider
{
	public function configurePackage(Package $package): void
	{
		$package->name('wp-database');
	}
}
