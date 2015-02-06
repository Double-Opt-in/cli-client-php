#!/usr/bin/env php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DoubleOptIn\PhpCli\Console\Command\ActionsCommand;
use DoubleOptIn\PhpCli\Console\Command\LogCommand;
use DoubleOptIn\PhpCli\Console\Command\StatusCommand;
use DoubleOptIn\PhpCli\Console\Command\ValidateCommand;
use Symfony\Component\Console\Application;

$config = \DoubleOptIn\ClientApi\Config\ConfigFactory::fromFile(__DIR__.'/config.php');
//$config->setHttpClientConfig(['verify' => false]);

$client = new DoubleOptIn\ClientApi\Client\Api($config);

$application = new Application('Double Opt-in cli', '1.0.0');
$application->add(new ActionsCommand($client));
$application->add(new LogCommand($client));
$application->add(new ValidateCommand($client));
$application->add(new StatusCommand($client));
$application->run();