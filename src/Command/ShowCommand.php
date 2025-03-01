<?php
namespace Cheatux\Command;

use Cheatux\Storage\CommandStorage;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ShowCommand extends Command {

	public function __construct() {
		parent::__construct('cheatux'); // Explicitly set the command name
	}

	protected function configure() {
		$this
			->setDescription('Show examples for a Linux command.')
			->addArgument('query', InputArgument::REQUIRED, 'The command to look up.'); // ✅ Rename argument
	}

	protected function execute(InputInterface $input, OutputInterface $output): int {
		$query = $input->getArgument('query'); // Update variable name
		$storage = new CommandStorage();
		$examples = $storage->getExamples($query);

		// Check if the array is empty OR if the first example contains an error message
		if (empty($examples) || (count($examples) === 1 && str_starts_with($examples[0], 'No examples found'))) {
			$output->writeln("<error>No examples found for '$query'</error>");
			return Command::FAILURE;
		}

		$table = new \Symfony\Component\Console\Helper\Table($output);
		$table->setHeaders(['Example','Description'])
			->setRows($examples)
			->render();

		return Command::SUCCESS;
	}
}
