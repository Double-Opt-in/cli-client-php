<?php namespace DoubleOptIn\PhpCli\Console\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ActionsCommand
 *
 * Command for retrieving all actions
 *
 * @package DoubleOptIn\PhpCli\Console\Command
 */
class ActionsCommand extends ClientApiCommand
{
	/**
	 * configure the command
	 */
	protected function configure()
	{
		$this->setName('actions')
			->setDescription('Get all actions for an email')
			->addArgument('email', InputArgument::REQUIRED, 'email to look for')
			->addOption('action', 'a', InputOption::VALUE_OPTIONAL, 'action for filtering the entries returned [use "-" to set the action to an empty filter]', null)
			->addOption('scope', 's', InputOption::VALUE_OPTIONAL, 'scope for filtering the entries returned [use "-" to set the scope to an empty filter]', null);
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
		$email = $input->getArgument('email');
		$action = $input->getOption('action');
		$scope = $input->getOption('scope');

		if ($action === '-')
			$action = '';
		if ($scope === '-')
			$scope = '';

		$command = new \DoubleOptIn\ClientApi\Client\Commands\ActionsCommand($email, $action, $scope);

		$response = $this->client()->send($command);

		if ($response->fails()) {
			$output->writeln('<error>' . $response->errorMessage() . '</error>');
			return;
		}

		/** @var \Symfony\Component\Console\Helper\TableHelper $table */
		$table = $this->getHelper('table');
		$table->setHeaders(['created at', 'action', 'scope', 'data', 'ip', 'useragent']);

		$crypto = $this->client()->getCryptographyEngine();

		foreach ($response->all() as $action)
			$table->addRow([
				$action->getCreatedAt()->format('Y-m-d H:i:s'),
				$action->getAction(),
				$action->getScope(),
				$crypto->decrypt($action->getData(), $email),
				$action->getIp(),
				$action->getUseragent()
			]);

		$table->render($output);

		if ($output->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE)
			$output->writeln((string)$response->limiter());
	}
}