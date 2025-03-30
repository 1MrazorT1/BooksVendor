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
    echo "Veuillez vous inscrire ou vous connecter.";
    exit;
}

$code_client = $_COOKIE['code_client'];
$sql = "SELECT o.nom AS titre, ed.nom AS editeur, p.quantite, e.prix
        FROM panier p
        JOIN exemplaire e ON p.code_exemplaire = e.code
        JOIN ouvrage o ON e.code_ouvrage = o.code
        JOIN editeurs ed ON e.code_editeur = ed.code
        WHERE p.code_client = :code_client";
$stmt = $pdo->prepare($sql);
$stmt->execute([':code_client' => $code_client]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (!$rows) {
    echo "Votre panier est vide.";
    exit;
}
$total = 0;
$html = "<table border='1' cellspacing='0' cellpadding='5'>";
$html .= "<tr><th>Titre</th><th>Éditeur</th><th>Quantité</th><th>Prix Unitaire</th><th>Total Ligne</th></tr>";
foreach ($rows as $row) {
    $ligneTotal = $row['quantite'] * $row['prix'];
    $total += $ligneTotal;
    $html .= "<tr>";
    $html .= "<td>" . htmlspecialchars($row['titre']) . "</td>";
    $html .= "<td>" . htmlspecialchars($row['editeur']) . "</td>";
    $html .= "<td>" . htmlspecialchars($row['quantite']) . "</td>";
    $html .= "<td>" . htmlspecialchars($row['prix']) . " €</td>";
    $html .= "<td>" . $ligneTotal . " €</td>";
    $html .= "</tr>";
}
$html .= "<tr><td colspan='4' style='text-align:right;'><strong>Prix Total :</strong></td><td><strong>" . $total . " €</strong></td></tr>";
$html .= "</table>";
$html .= "<button onclick='commander()'>Commander</button> ";
$html .= "<button onclick='fermerPanier()'>Fermer</button>";

echo $html;
?>
