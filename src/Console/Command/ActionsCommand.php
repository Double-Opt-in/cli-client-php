<?php namespace DoubleOptIn\PhpCli\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ActionsCommand
 *
 * @package DoubleOptIn\PhpCli\Console\Command
 */
class ActionsCommand extends ClientApiCommand
{
	protected function configure()
	{
		$this->setName('actions')
			->setDescription('Get all actions');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeln(print_r($this->client()->send(new \DoubleOptIn\ClientApi\Client\Commands\ActionsCommand()), true));
	}
}