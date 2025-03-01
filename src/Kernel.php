<?php
namespace Cheatux;

use Symfony\Component\Console\Application;
use Cheatux\Command\ShowCommand;

class Kernel {
	public function run(): void {
		$app = new Application('Cheatux', '1.0.0');
		$app->add(new ShowCommand());
		$app->run();
	}
}
