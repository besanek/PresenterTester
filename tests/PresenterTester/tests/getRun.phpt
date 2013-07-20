<?php

use Tester\Assert;
use PresenterTester\PresenterTester;

$container = require __DIR__ . '/../bootstrap.php';

////////////////////////////////////////////////////////////////////////////////

$tester = new PresenterTester($container->getByType('\Nette\Application\IPresenterFactory'));
$tester->setPresenter('Dump');
$tester->setAction('default');
$response = $tester->run();

Assert::type("Nette\Application\Responses\TextResponse", $response);
Assert::equal("default", $response->getSource());