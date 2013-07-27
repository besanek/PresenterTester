<?php

use Tester\Assert;
use PresenterTester\PresenterTester;

$container = require __DIR__ . '/../bootstrap.php';

///////////////////////////      Twice run        //////////////////////////////

$tester = new PresenterTester($container->getByType('\Nette\Application\IPresenterFactory'));
$tester->setPresenter('Dump');
$tester->setAction('default');
$tester->setHandle('change');
$tester->run();
Assert::exception(function () use ($tester) {
            $tester->run();
        }, 'PresenterTester\LogicException');

//////////////////////  Changing name after create presenter ///////////////////

$tester->clean();
$tester->getPresenterComponent();

Assert::error(function () use ($tester) {
            $tester->setPresenter('foo');
        }, E_USER_NOTICE);

////////////////////  Getting response before runing presenter /////////////////

$tester->clean();

Assert::exception(function () use ($tester) {
            $tester->getResponse();
        }, 'PresenterTester\LogicException');

//////////////////////  Changing params after create request ///////////////////

$tester->clean();
$tester->getRequest();

Assert::error(function () use ($tester) {
            $tester->setAction('foo');
        }, E_USER_NOTICE);

Assert::error(function () use ($tester) {
            $tester->setParams(array('foo' => 'bar'));
        }, E_USER_NOTICE);

Assert::error(function () use ($tester) {
            $tester->setPost(array('foo' => 'bar'));
        }, E_USER_NOTICE);

Assert::error(function () use ($tester) {
            $tester->setHandle('foo');
        }, E_USER_NOTICE);