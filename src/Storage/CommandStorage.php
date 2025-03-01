<?php
namespace Cheatux\Storage;

class CommandStorage {
	private string $filePath;

	public function __construct(string $filePath = __DIR__ . '/../../data/commands.json') {
		$this->filePath = $filePath;
	}

	public function getExamples(string $command): array {
		if (!file_exists($this->filePath)) {
			return ["Error: JSON file not found."];
		}

		$data = json_decode(file_get_contents($this->filePath), true);

		return $data[$command] ?? ["No examples found for '$command'."];
	}
}
