<?php
$dir = getcwd();
$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
foreach ($it as $f) {
    if ($f->isFile() && strtolower($f->getExtension()) === 'php') {
        $out = shell_exec('php -l ' . escapeshellarg($f->getPathname()) . ' 2>&1');
        if (strpos($out, 'No syntax errors detected') === false) {
            echo $f->getPathname() . PHP_EOL;
            echo $out . PHP_EOL;
        }
    }
}
