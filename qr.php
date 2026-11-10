<?php
/**
 * Generate a UPI QR through the configured QR image service.
 * The browser never constructs an external QR URL directly; it requests this
 * same-origin endpoint with a validated UPI URI.
 */
$payload = isset($_GET['d']) ? (string) $_GET['d'] : '';
$size = isset($_GET['s']) ? (int) $_GET['s'] : 280;
$size = max(160, min(512, $size));

if ($payload === '' || strlen($payload) > 2000 || stripos($payload, 'upi://pay?') !== 0) {
    http_response_code(400);
    header('Content-Type: text/plain; charset=utf-8');
    exit('Invalid UPI QR payload');
}

$qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=' . $size . 'x' . $size . '&data=' . rawurlencode($payload);
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Location: ' . $qrUrl, true, 302);
exit;
?>
