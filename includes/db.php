<?php
// ============================================================
// Database Connection - PDO
// ============================================================
// Local Connection (Commented out)
define('DB_HOST', 'localhost');
define('DB_NAME', 'beauty_salon_db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Live Host Connection (InfinityFree)
// define('DB_HOST', 'sql202.infinityfree.com');
// define('DB_NAME', 'if0_41747859_beauty_salon_db');
// define('DB_USER', 'if0_41747859');
// define('DB_PASS', 'Y5jTQu7AbOC0zS5');
// define('DB_CHARSET', 'utf8mb4');

$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch (PDOException $e) {
    die(json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]));
}
