<?php

use Tester\Assert;
use PresenterTester\PresenterTester;

$container = require __DIR__ . '/../bootstrap.php';

////////////////////////////////////////////////////////////////////////////////

$tester = new PresenterTester($container->getByType('\Nette\Application\IPresenterFactory'));
$tester->setPresenter('Dump');
$tester->setAction('default');

$request = $tester->getRequest();
$parameters = $request->parameters;
$parameters['parameter'] = 'string';
$request->parameters = $parameters;

$response = $tester->run();

Assert::type("Nette\Application\Responses\TextResponse", $response);
Assert::equal("string", $response->getSource());

$request = $tester->getRequest();
Assert::same($parameters, $request->parameters);

$tester->clean();

$request = $tester->getRequest();
Assert::same(array('action' => 'default'), $request->parameters);