<?php

include 'autoloader.php';

foreach (new DirectoryIterator(__DIR__) as $file) {

    if (!str_ends_with($file->getFilename(), 'Test.php')) {
        continue;
    }

    $className = substr($file->getFilename(), 0, -4);
    $testClass = new $className();

    $methods = get_class_methods($testClass);

    foreach ($methods as $method) {

        if (!str_ends_with($method, 'Test')) {
            continue;
        }

        $testClass->$method();
    }
}
