<?php
// Free Fire UID lookup proxy; API credentials stay server-side.
declare(strict_types=1);
header("Content-Type: application/json; charset=utf-8");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("X-Content-Type-Options: nosniff");
$uid = isset($_GET["uid"]) ? trim((string)$_GET["uid"]) : "";
if (!preg_match("/^\\d{6,12}$/", $uid)) {
    http_response_code(400);
    echo json_encode(["status"=>"error", "message"=>"Enter a valid Free Fire UID (6-12 digits)."], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    exit;
}
$url = "https://spadexhub.xyz/ffuid2info/ffinfo.php?api=spade_5bcca99bad91cde6&uid=" . rawurlencode($uid);
$body = false; $httpCode = 0;
if (function_exists("curl_init")) {
    $ch = curl_init($url);
    curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER=>true, CURLOPT_FOLLOWLOCATION=>true, CURLOPT_MAXREDIRS=>3, CURLOPT_CONNECTTIMEOUT=>8, CURLOPT_TIMEOUT=>25, CURLOPT_SSL_VERIFYPEER=>true, CURLOPT_SSL_VERIFYHOST=>2, CURLOPT_HTTPHEADER=>["Accept: application/json", "User-Agent: ZeroSpade-FreeFire-UID-Verifier/1.0"]]);
    $body = curl_exec($ch); $httpCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE); curl_close($ch);
} elseif (ini_get("allow_url_fopen")) {
    $ctx = stream_context_create(["http"=>["timeout"=>25, "ignore_errors"=>true, "header"=>"Accept: application/json\\r\\nUser-Agent: ZeroSpade-FreeFire-UID-Verifier/1.0\\r\\n"], "ssl"=>["verify_peer"=>true, "verify_peer_name"=>true]]);
    $body = @file_get_contents($url, false, $ctx); $httpCode = ($body !== false) ? 200 : 0;
} else {
    http_response_code(500); echo json_encode(["status"=>"error", "message"=>"Enable PHP cURL or allow_url_fopen."], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES); exit;
}
$result = ($body !== false) ? json_decode($body, true) : null;
if ($body === false || $httpCode < 200 || $httpCode >= 300 || !is_array($result) || json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(502); echo json_encode(["status"=>"error", "message"=>"UID lookup service is temporarily unavailable. Please try again."], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES); exit;
}
if (($result["status"] ?? "") !== "success" || !isset($result["data"]["basicInfo"]) || !is_array($result["data"]["basicInfo"])) {
    echo json_encode(["status"=>"error", "message"=>(string)($result["message"] ?? "No Free Fire account was found for this UID.")], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES); exit;
}
// Preserve the API's original JSON structure; js/app.js normalizes data.basicInfo.
echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
?>
