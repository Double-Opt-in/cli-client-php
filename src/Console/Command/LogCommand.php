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
			->addArgument('action', InputArgument::REQUIRED, 'action to log for email [e.g. register, approved; lowercased actions recommended]')
			->addArgument('email', InputArgument::REQUIRED, 'email to log')
			->addOption('scope', 's', InputOption::VALUE_OPTIONAL, 'scope for logging [e.g. newsletter, webspecial; lowercased scopes recommended]', '');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$hash = $input->getArgument('email');
		$action = $input->getArgument('action');
		$scope = $input->getOption('scope');

		$command = new \DoubleOptIn\ClientApi\Client\Commands\LogCommand($hash, $action, $scope);

		$output->writeln(print_r($this->client()->send($command), true));
	}
}