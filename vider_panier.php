<?php
session_start();

$host   = 'localhost';
$port   = '1234';
$dbname = 'livres';
$user   = 'postgres';
$pass   = 'BokuBoku123';
$dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
$pdo = new PDO($dsn, $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!isset($_COOKIE['code_client'])) {
    echo "Vous n'êtes pas connecté.";
    exit;
}
$code_client = $_COOKIE['code_client'];
$stmt = $pdo->prepare("DELETE FROM panier WHERE code_client = :code_client");
$stmt->execute([':code_client' => $code_client]);
echo "Le panier a été vidé.";
?>
