<?php

function __autoload($className) {
	$path = preg_replace('/\\\/', '/', $className);
	require APPLICATION_PATH . '/' . $path . ".php";
}

