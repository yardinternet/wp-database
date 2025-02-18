<?php

declare(strict_types=1);

namespace Yard\Database\Console;

use Illuminate\Console\Command;
use Yard\Database\Database;

class DatabaseCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'database';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'My custom Acorn command.';

	/**
	 * Execute the console command.
	 */
	public function handle(): void
	{
		$this->info(
			app(Database::class)->getQuote()
		);
	}
}
