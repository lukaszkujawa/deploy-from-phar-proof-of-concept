<?php

$path = realpath('.');

$phar = new Phar('demo.phar', 0, 'demo.phar');
$phar->buildFromIterator(
		new RecursiveIteratorIterator(
				new RecursiveDirectoryIterator( $path, FilesystemIterator::SKIP_DOTS ) ),
		$path);

$phar->setStub( $phar->createDefaultStub( 'phar-build/main.php' ) );