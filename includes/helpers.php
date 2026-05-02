<?php declare(strict_types=1);

function redirect(string $url): never {
	header('Location: ' . $url, true, 302);
	exit;
}

/**
 * @param 'success'|'danger'|'warning'|'info' $type
 */
function set_flash(string $type, string $message): void {
	$_SESSION['_flash'] = ['type' => $type, 'message' => $message];
}
