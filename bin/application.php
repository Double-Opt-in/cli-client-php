#!/usr/bin/env php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DoubleOptIn\PhpCli\Console\Command\ActionsCommand;
use DoubleOptIn\PhpCli\Console\Command\LogCommand;
use DoubleOptIn\PhpCli\Console\Command\ValidateCommand;
use Symfony\Component\Console\Application;

$apiEndpoint = 'http://localhost:8000';
$siteToken = '';
$clientId = '';
$clientSecret = '';

$config = new DoubleOptIn\ClientApi\Config\ClientConfig($clientId, $clientSecret, $siteToken, $apiEndpoint);

$client = new DoubleOptIn\ClientApi\Client\Api($config);

$application = new Application('Double Opt-in cli', '0.0.1');
$application->add(new ActionsCommand($client));
$application->add(new LogCommand($client));
$application->add(new ValidateCommand($client));
$application->run();