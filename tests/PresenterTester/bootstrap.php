<?php

$dirs = array('../../vendor/', '../../libs/');

$find = FALSE;
foreach ($dirs as $dir) {
    $autoload = __DIR__ . "/" . $dir . "autoload.php";
    if (is_file($autoload)) {
        $find = TRUE;
        require_once $autoload;
        break;
    }
}

if (!class_exists('Tester\Assert')) {
    echo "Install Nette Tester using `composer update --dev`\n";
    exit(1);
}

Tester\Helpers::setup();

define('TEMP_DIR', __DIR__ . '/../tmp/' . getmypid());
Tester\Helpers::purge(TEMP_DIR);

$configurator = new Nette\Configurator;

$configurator->setDebugMode(FALSE);
$configurator->setTempDirectory(TEMP_DIR);
$configurator->createRobotLoader()
        ->addDirectory(__DIR__ . '/helpers')
        ->register();

return $configurator->createContainer();
