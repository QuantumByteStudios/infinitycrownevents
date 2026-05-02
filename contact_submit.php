<?php declare(strict_types=1);
// Simple contact handler: validate POST, send HTML email. No database.
// Recipients: hi@infinitycrownevents.com; Bcc: quantumbytestudios@gmail.com

require_once __DIR__ . '/config/app_config.php';
require_once __DIR__ . '/config/session.php';
require_once __DIR__ . '/includes/helpers.php';

$home = rtrim(BASE_URL, '/') . '/index.html';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	redirect($home . '#contact');
}

$name = trim((string) ($_POST['name'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$phone = trim((string) ($_POST['phone'] ?? ''));
$subject = trim((string) ($_POST['subject'] ?? ''));
$message = trim((string) ($_POST['message'] ?? ''));

if ($name === '' || $email === '' || $phone === '' || $message === '') {
	set_flash('danger', 'Please fill in name, email, phone, and message.');
	redirect($home . '?inquiry=error#contact');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	set_flash('danger', 'Please enter a valid email address.');
	redirect($home . '?inquiry=error#contact');
}

$digits = preg_replace('/\D/', '', $phone);
if (strlen($digits) < 10 || strlen($digits) > 15) {
	set_flash('danger', 'Please enter a valid phone number (at least 10 digits).');
	redirect($home . '?inquiry=error#contact');
}

$to = 'hi@infinitycrownevents.com';
$subjectLine = 'Infinity Crown Events — enquiry from ' . substr($name, 0, 40);
if ($subject !== '') {
	$subjectLine .= ' — ' . substr($subject, 0, 60);
}

$submittedAt = date('Y-m-d H:i:s T');

$emailBody = '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"></head><body style="margin:0;padding:24px;background:#f6f7f9;font-family:system-ui,sans-serif;">'
	. '<div style="max-width:640px;margin:0 auto;background:#fff;border:1px solid #e5e7eb;border-radius:10px;padding:24px;">'
	. '<h1 style="margin:0 0 16px;font-size:18px;">New enquiry</h1>'
	. '<table style="width:100%;border-collapse:collapse;font-size:14px;">'
	. '<tr><td style="padding:8px 0;color:#6b7280;width:120px;">Name</td><td style="padding:8px 0;">' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '</td></tr>'
	. '<tr><td style="padding:8px 0;color:#6b7280;">Email</td><td style="padding:8px 0;"><a href="mailto:' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '</a></td></tr>'
	. '<tr><td style="padding:8px 0;color:#6b7280;">Phone</td><td style="padding:8px 0;">' . htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') . '</td></tr>'
	. '<tr><td style="padding:8px 0;color:#6b7280;vertical-align:top;">Subject</td><td style="padding:8px 0;">' . htmlspecialchars($subject !== '' ? $subject : '—', ENT_QUOTES, 'UTF-8') . '</td></tr>'
	. '<tr><td style="padding:8px 0;color:#6b7280;vertical-align:top;">Message</td><td style="padding:8px 0;white-space:pre-wrap;">' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</td></tr>'
	. '<tr><td style="padding:8px 0;color:#6b7280;">Received</td><td style="padding:8px 0;">' . htmlspecialchars($submittedAt, ENT_QUOTES, 'UTF-8') . '</td></tr>'
	. '</table></div></body></html>';

$headers = "MIME-Version: 1.0\r\nContent-Type: text/html; charset=UTF-8\r\n";
$headers .= "From: Infinity Crown Events <hi@infinitycrownevents.com>\r\n";
$headers .= 'Reply-To: ' . $name . ' <' . $email . ">\r\n";
$headers .= "Bcc: quantumbytestudios@gmail.com\r\n";

$mailSent = @mail($to, $subjectLine, $emailBody, $headers);

if ($mailSent) {
	set_flash('success', 'Thanks — your message was sent.');
	redirect($home . '?inquiry=sent#contact');
}

set_flash('danger', 'Your message could not be emailed. Please call or email us directly.');
redirect($home . '?inquiry=error#contact');
