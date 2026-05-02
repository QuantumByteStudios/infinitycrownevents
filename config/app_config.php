<?php declare(strict_types=1);

if (defined('BASE_URL')) {
	return;
}

$https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
	|| (isset($_SERVER['SERVER_PORT']) && (string) $_SERVER['SERVER_PORT'] === '443');
$scheme = $https ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$script = $_SERVER['SCRIPT_NAME'] ?? '/';
$dir = dirname(str_replace('\\', '/', $script));
if ($dir === '/' || $dir === '\\' || $dir === '.') {
	$dir = '';
} else {
	$dir = rtrim($dir, '/');
}

define('BASE_URL', $dir === '' ? $scheme . '://' . $host : $scheme . '://' . $host . $dir);
