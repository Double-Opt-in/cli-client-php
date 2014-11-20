<?php namespace DoubleOptIn\PhpCli\Console\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class LogCommand
 *
 * @package DoubleOptIn\PhpCli\Console\Command
 */
class LogCommand extends ClientApiCommand
{
	protected function configure()
	{
		$this->setName('log')
			->setDescription('Logs an action')
			->addArgument('email', InputArgument::REQUIRED, 'email to log')
			->addOption('action', 'a', InputOption::VALUE_REQUIRED, 'action to log for email')
			->addOption('scope', 's', InputOption::VALUE_OPTIONAL, 'scope for logging', '');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$hash = $input->getArgument('email');
		$action = $input->getOption('action');
		$scope = $input->getOption('scope');

		$command = new \DoubleOptIn\ClientApi\Client\Commands\LogCommand($hash, $action, $scope);

		$output->writeln(print_r($this->client()->send($command), true));
	}
}