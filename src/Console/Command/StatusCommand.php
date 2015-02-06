<?php namespace DoubleOptIn\PhpCli\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class StatusCommand
 *
 * Status command for getting the status informations
 *
 * @package DoubleOptIn\PhpCli\Console\Command
 */
class StatusCommand extends ClientApiCommand
{
	/**
	 * configure the command
	 */
	protected function configure()
	{
		$this->setName('status')
			->setDescription('Get all status information');
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
		$command = new \DoubleOptIn\ClientApi\Client\Commands\StatusCommand();

		$response = $this->client()->send($command);

		if ($response->fails()) {
			$output->writeln('<error>' . $response->errorMessage() . '</error>');
			return;
		}

		$status = $response->status();
		if (null === $status) {
			$output->writeln('No status given');
		}

		/** @var \Symfony\Component\Console\Helper\TableHelper $table */
		$table = $this->getHelper('table');
		$table->setHeaders(['key', 'value']);

		foreach ($status->toArray() as $key => $value)
			$table->addRow(array($key, $value));

		$table->render($output);

		if ($output->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE)
			$output->writeln((string)$response->limiter());
	}
}