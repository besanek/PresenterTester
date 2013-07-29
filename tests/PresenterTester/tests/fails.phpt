<?php

use Tester\Assert;
use PresenterTester\PresenterTester;

$container = require __DIR__ . '/../bootstrap.php';

/////////////////////  Getting response before run    //////////////////////////

$tester = new PresenterTester($container->getByType('\Nette\Application\IPresenterFactory'));
$tester->setPresenter('Dump');
$tester->setAction('default');
$tester->setHandle('change');

Assert::exception(function () use ($tester) {
            $tester->getResponse();
        }, 'PresenterTester\LogicException');

