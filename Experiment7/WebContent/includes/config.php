<?php
// config.php - Global configuration settings

// Enable error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Site-wide settings
define('SITE_NAME', 'FBS eBooks');
define('BASE_URL', 'http://localhost/fbs-ebooks'); // Update with your actual path

// Session configuration
session_set_cookie_params([
    'lifetime' => 86400, // 1 day
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => false,    // Should be true in production with HTTPS
    'httponly' => true,
    'samesite' => 'Lax'
]);

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database configuration (can be overridden by db.php)
$dbConfig = [
    'host' => 'localhost',
    'name' => 'fbs_ebooks',
    'user' => 'root',
    'pass' => 'root'
];

// Include database connection
require_once __DIR__ . '/db.php';

// Helper functions
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function redirect($url) {
    header("Location: $url");
    exit();
}
?>