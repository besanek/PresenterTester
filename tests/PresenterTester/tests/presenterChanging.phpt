<?php

use Tester\Assert;
use PresenterTester\PresenterTester;

$container = require __DIR__ . '/../bootstrap.php';

////////////////////////////////////////////////////////////////////////////////

$tester = new PresenterTester($container->getByType('\Nette\Application\IPresenterFactory'));
$tester->setPresenter('Dump');
$tester->setAction('default');

$presenter = $tester->getPresenterComponent();
$presenter->value = "foobar";

$response = $tester->run();

Assert::type("Nette\Application\Responses\TextResponse", $response);
Assert::equal("foobar", $response->getSource());

$presenter = $tester->getPresenterComponent();
Assert::equal("deleted", $presenter->value);

$tester->clean();

$presenter = $tester->getPresenterComponent();
Assert::equal(NULL, $presenter->value);
