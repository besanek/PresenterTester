PresenterTester
===============

Creating Nette presenters for testing purposes has never been easier.

Simplest example
----------------
This will run Homepage presenter with default action.
```php
$tester = new PresenterTester($container->getByType('\Nette\Application\IPresenterFactory'));
$tester->setPresenter('Homepage');
$response = $tester->run();
```

More complex example
---------------------------------
```php
$tester = new PresenterTester($container->getByType('\Nette\Application\IPresenterFactory'));
$tester->setPresenter('Article');
$tester->setAction('edit');
$tester->setHandle('form-save')
$tester->setParams(array('id' => 1));

$article = array(
  'content' => 'Lorem ipsum',
  'save' => 'save',
);

$tester->setPost($article);
$response = $tester->run();
```

This can edit and save the article with id 1.

Limitations
-----------
- You can not runs twice the presenter. You must clear internal cache with *clean()*.

Future
----------
- Ajax support
- Native support for formular sending

[![Build Status](https://travis-ci.org/besanek/PresenterTester.png?branch=master)](https://travis-ci.org/besanek/PresenterTester)
