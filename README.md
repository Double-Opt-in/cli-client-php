# Cli client for Double Opt-in (PHP)
[![Latest Stable Version](https://poser.pugx.org/Double-Opt-in/cli-client-php/v/stable.svg)](https://packagist.org/packages/Double-Opt-in/cli-client-php) [![Latest Unstable Version](https://poser.pugx.org/Double-Opt-in/cli-client-php/v/unstable.svg)](https://packagist.org/packages/Double-Opt-in/cli-client-php) [![License](https://poser.pugx.org/Double-Opt-in/cli-client-php/license.svg)](https://packagist.org/packages/Double-Opt-in/cli-client-php) [![Total Downloads](https://poser.pugx.org/Double-Opt-in/cli-client-php/downloads.svg)](https://packagist.org/packages/Double-Opt-in/cli-client-php)

This is a demonstration package for die Client API in PHP for the double-opt.in service.

You get an console application to manage your double-opt.in account for a site.


## Installation

Add to your composer.json following lines

	"require": {
		"double-opt-in/cli-client-php": "~1.0"
	}


## Usage

You can call `vendor/bin/doi-cli` to see all your options and commands. It is a symfony console application. So just ask
 when you do not understand what is going on there. Or use the manual for symfony console component.


### Preparation

This is just for demonstration, so to configure the console application is a bit hard. You have to create a config.php 
 file within the `vendor/bin` folder with the following content:

	<?php
	
	return array(
		'api' => 'https://double-opt.in/api',
		'client_id' => 'YOUR_CLIENT_ID',
		'client_secret' => 'YOUR_CLIENT_SECRET',
		'site_token' => 'YOUR_SITE_TOKEN',
	);

This is not so convenient, but it is okay for demonstrating the PHP client api.


### Built-in commands

Listing all built-in commands:

	$> ./vendor/bin/doi-cli

#### Logging an action

Retrieving all arguments and options:

	$> ./vendor/bin/doi-cli help log

Logging an email with action:

	$> ./vendor/bin/doi-cli log register test@example.com

Logging an email with action and scope:

	$> ./vendor/bin/doi-cli log register test@example.com --scope="newsletter"

#### Retrieving all actions

Getting help for the command:

	$> ./vendor/bin/doi-cli help actions

Getting actions for email:

	$> ./vendor/bin/doi-cli actions test@example.com

#### Validate an email

Getting help for the command:

	$> ./vendor/bin/doi-cli help validate

Validate an email:

	$> ./vendor/bin/doi-cli validate test@example.com

