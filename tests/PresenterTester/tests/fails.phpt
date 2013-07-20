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
Assert::exception(function () use ($tester) {
            $tester->setPresenter('foo');
        }, 'PresenterTester\LogicException');

////////////////////  Getting response before runing presenter /////////////////

$tester->clean();

Assert::exception(function () use ($tester) {
            $tester->getResponse();
        }, 'PresenterTester\LogicException');

//////////////////////  Changing params after create request ///////////////////

$tester->clean();
$tester->getRequest();

Assert::exception(function () use ($tester) {
            $tester->setAction('foo');
        }, 'PresenterTester\LogicException');

Assert::exception(function () use ($tester) {
            $tester->setParams(array('foo' => 'bar'));
        }, 'PresenterTester\LogicException');

Assert::exception(function () use ($tester) {
            $tester->setPost(array('foo' => 'bar'));
        }, 'PresenterTester\LogicException');

Assert::exception(function () use ($tester) {
            $tester->setHandle('foo');
        }, 'PresenterTester\LogicException');