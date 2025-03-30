<?php
header("Content-Type: text/plain; charset=UTF-8");

if (!isset($_GET['nom'], $_GET['prenom'], $_GET['adresse'], $_GET['cp'], $_GET['ville'], $_GET['pays'])) {
    echo "Paramètres manquants";
    exit;
}

$nom     = $_GET['nom'];
$prenom  = $_GET['prenom'];
$adresse = $_GET['adresse'];
$cp      = $_GET['cp'];
$ville   = $_GET['ville'];
$pays    = $_GET['pays'];

$host   = 'postgres';
$port   = '5432';
$dbname = 'db';
$user   = 'nome';
$pass   = 'ensicaen';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT inscription(:nom, :prenom, :adresse, :cp, :ville, :pays) AS code_client";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
    $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
    $stmt->bindParam(':cp', $cp, PDO::PARAM_STR);
    $stmt->bindParam(':ville', $ville, PDO::PARAM_STR);
    $stmt->bindParam(':pays', $pays, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $code_client = $result['code_client'];
    echo ($code_client == 0) ? "no" : $code_client;
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>
