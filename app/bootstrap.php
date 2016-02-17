<?php
require_once __DIR__.'/bootstrap.php.cache';
require_once __DIR__.'/AppKernel.php';

use Symfony\Bundle\FrameworkBundle\Console\Application;

$kernel = new AppKernel('test', true); // create a "test" kernel
$kernel->boot();

$application = new Application($kernel);


