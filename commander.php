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
$sql = "INSERT INTO commande (code_client, code_exemplaire, quantite, prix, date_commande)
        SELECT p.code_client, p.code_exemplaire, p.quantite, e.prix, CURRENT_DATE
        FROM panier p
        JOIN exemplaire e ON p.code_exemplaire = e.code
        WHERE p.code_client = :code_client";
$stmt = $pdo->prepare($sql);
$stmt->execute([':code_client' => $code_client]);
$sqlDelete = "DELETE FROM panier WHERE code_client = :code_client";
$stmtDelete = $pdo->prepare($sqlDelete);
$stmtDelete->execute([':code_client' => $code_client]);
echo "Commande effectuée avec succès !";
?>
