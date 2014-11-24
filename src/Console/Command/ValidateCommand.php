<?php namespace DoubleOptIn\PhpCli\Console\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ValidateCommand
 *
 * Command for validating an email
 *
 * @package DoubleOptIn\PhpCli\Console\Command
 */
class ValidateCommand extends ClientApiCommand
{
	/**
	 * configure the command
	 */
	protected function configure()
	{
		$this->setName('validate')
			->setDescription('Validates an email')
			->addArgument('email', InputArgument::REQUIRED, 'email for validation')
			->addOption('scope', 's', InputOption::VALUE_OPTIONAL, 'scope for validation', '');
	}

	/**
	 * execute the command
	 *
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 *
	 * @return void
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$hash = $input->getArgument('email');
		$scope = $input->getOption('scope');

		$command = new \DoubleOptIn\ClientApi\Client\Commands\ValidateCommand($hash, $scope);

		$response = $this->client()->send($command);

		if ($response->fails()) {
			$output->writeln($response->errorMessage());
			return;
		}

		$output->writeln($response->toString());

		if ($output->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE)
			$output->writeln((string)$response->limiter());
	}
}