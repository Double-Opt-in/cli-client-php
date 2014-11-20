<?php namespace DoubleOptIn\PhpCli\Console\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ValidateCommand
 *
 * @package DoubleOptIn\PhpCli\Console\Command
 */
class ValidateCommand extends ClientApiCommand
{
	protected function configure()
	{
		$this->setName('validate')
			->setDescription('Validates an email')
			->addArgument('email', InputArgument::REQUIRED, 'email for validation')
			->addOption('scope', 's', InputOption::VALUE_OPTIONAL, 'scope for validation', '');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$hash = $input->getArgument('email');
		$scope = $input->getOption('scope');

		$command = new \DoubleOptIn\ClientApi\Client\Commands\ValidateCommand($hash, $scope);

		$output->writeln(print_r($this->client()->send($command), true));
	}
}