<?php

use Tester\Assert;
use PresenterTester\PresenterTester;

$container = require __DIR__ . '/../bootstrap.php';

///////////////////////////      All is ok        //////////////////////////////

$tester = new PresenterTester($container->getByType('\Nette\Application\IPresenterFactory'), $container->getByType('\Nette\Http\IResponse'));
$tester->setPresenter('Dump');
$tester->setAction('default');
$tester->run();

Assert::same(200, $tester->getHttpCode());

///////////////////////////      Bad action       //////////////////////////////

$tester->clean();
$tester->setAction('NotFound');
$tester->run();

Assert::same(404, $tester->getHttpCode());

//////////////////////   Uncaught exception ///////////////////

$tester->clean();
$tester->setAction('exception');
$tester->run();

Assert::same(500, $tester->getHttpCode());