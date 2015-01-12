<?php namespace DoubleOptIn\PhpCli\Console\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class LogCommand
 *
 * Command for logging an action for an email
 *
 * @package DoubleOptIn\PhpCli\Console\Command
 */
class LogCommand extends ClientApiCommand
{
	/**
	 * configure the command
	 */
	protected function configure()
	{
		$this->setName('log')
			->setDescription('Logs an action')
			->addArgument('action', InputArgument::REQUIRED, 'action to log for email [e.g. register, approved; lowercased actions recommended]')
			->addArgument('email', InputArgument::REQUIRED, 'email to log')
			->addOption('scope', 's', InputOption::VALUE_OPTIONAL, 'scope for logging [e.g. newsletter, webspecial; lowercased scopes recommended]', '')
			->addOption('data', 'd', InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'data assigned to the logging action');
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
		$action = $input->getArgument('action');
		$scope = $input->getOption('scope');
		$data = $input->getOption('data');

		$command = new \DoubleOptIn\ClientApi\Client\Commands\LogCommand($hash, $action, $scope);
		if ( ! empty($data))
			$command->setData($data);

		$response = $this->client()->send($command);
		if ($response->fails()) {
			$output->writeln('<error>' . $response->errorMessage() . '</error>');
			return;
		}

		$action = $response->action();
		if ($action !== null)
			$output->writeln('User is logged with action: <info>' . $action->getAction() . '</info>');

		if ($output->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE)
			$output->writeln((string)$response->limiter());
	}
}