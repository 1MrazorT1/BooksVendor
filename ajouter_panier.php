<?php
session_start();

$host   = 'postgres';
$port   = '5432';
$dbname = 'db';
$user   = 'nome';
$pass   = 'ensicaen';
$dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
$pdo = new PDO($dsn, $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!isset($_COOKIE['code_client'])) {
    echo "Non connecté";
    exit;
}
$code_client = $_COOKIE['code_client'];
if (!isset($_GET['code_exemplaire'])) {
    echo "Code exemplaire manquant";
    exit;
}
$code_exemplaire = $_GET['code_exemplaire'];
$stmt = $pdo->prepare("SELECT quantite FROM panier WHERE code_client = ? AND code_exemplaire = ?");
$stmt->execute([$code_client, $code_exemplaire]);
if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $newQty = $row['quantite'] + 1;
    $stmtUpdate = $pdo->prepare("UPDATE panier SET quantite = ? WHERE code_client = ? AND code_exemplaire = ?");
    $stmtUpdate->execute([$newQty, $code_client, $code_exemplaire]);
} else {
    $stmtInsert = $pdo->prepare("INSERT INTO panier (code_client, code_exemplaire, quantite) VALUES (?, ?, 1)");
    $stmtInsert->execute([$code_client, $code_exemplaire]);
}
echo "Ajout réussi";
?>
