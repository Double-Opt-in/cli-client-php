<?php namespace DoubleOptIn\PhpCli\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
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
			->setDescription('Get all actions');
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
		$output->writeln(print_r($this->client()->send(new \DoubleOptIn\ClientApi\Client\Commands\ActionsCommand()), true));
	}
}