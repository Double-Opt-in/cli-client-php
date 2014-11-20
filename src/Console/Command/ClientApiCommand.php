<?php namespace DoubleOptIn\PhpCli\Console\Command;

use DoubleOptIn\ClientApi\Client\ApiInterface;
use Symfony\Component\Console\Command\Command;

/**
 * Class ClientApiCommand
 *
 *
 *
 * @package Console\Command
 */
class ClientApiCommand extends Command
{
	/**
	 * api client
	 *
	 * @var ApiInterface
	 */
	private $client;

	/**
	 * @param ApiInterface $client
	 * @param null $name
	 */
	public function __construct(ApiInterface $client, $name = null)
	{
		parent::__construct($name);

		$this->client = $client;
	}

	/**
	 * returns the api client
	 *
	 * @return ApiInterface
	 */
	protected function client()
	{
		return $this->client;
	}
}