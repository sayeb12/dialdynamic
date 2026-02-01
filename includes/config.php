<?php
// Configuration file for Dial Dynamic Ltd.

// Site Configuration
define('SITE_NAME', 'Dial Dynamic Ltd.');
define('SITE_URL', 'https://dialdynamic.com');
define('SITE_EMAIL', 'connect@dialdynamic.com');
define('SITE_PHONE', '+1 (555) 123-4567');

// Database Configuration (if needed later)
define('DB_HOST', 'localhost');
define('DB_NAME', 'dialdynamic_db');
define('DB_USER', 'root');
define('DB_PASS', '');

// Feature Toggles
define('ENABLE_CALL_EXPERIENCE', true);
define('ENABLE_ANALYTICS', true);
define('ENABLE_CONTACT_FORM', true);

// Session Configuration
session_set_cookie_params([
    'lifetime' => 86400 * 7, // 7 days
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => isset($_SERVER['HTTPS']),
    'httponly' => true,
    'samesite' => 'Strict'
]);

// Error Reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Timezone
date_default_timezone_set('America/New_York');

// Security Functions
function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

function generate_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}