<?php
$host   = 'postgres';
$port   = '5432';
$dbname = 'db';
$user   = 'nome';
$pass   = 'ensicaen';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT code, nom, prenom, naissance 
            FROM auteurs 
            WHERE nom ILIKE '%ar%'";
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ob_start();
    echo "<!DOCTYPE html>\n";
    echo "<html lang='fr'>\n";
    echo "<head>\n";
    echo "    <meta charset='UTF-8'>\n";
    echo "    <title>Requête BDD Livres</title>\n";
    echo "</head>\n";
    echo "<body>\n";
    echo "    <h1>Liste des auteurs (nom contenant 'ar')</h1>\n";
    if (count($results) > 0) {
        echo "    <table border='1' cellpadding='5' cellspacing='0'>\n";
        echo "        <tr>\n";
        echo "            <th>Code</th>\n";
        echo "            <th>Nom</th>\n";
        echo "            <th>Prénom</th>\n";
        echo "            <th>Date de Naissance</th>\n";
        echo "        </tr>\n";
        foreach ($results as $row) {
            $code       = $row['code']       ?? '';
            $nom        = $row['nom']        ?? '';
            $prenom     = $row['prenom']     ?? '';
            $naissance  = $row['naissance']  ?? '';
            echo "        <tr>\n";
            echo "            <td>" . htmlspecialchars($code) . "</td>\n";
            echo "            <td>" . htmlspecialchars($nom) . "</td>\n";
            echo "            <td>" . htmlspecialchars($prenom) . "</td>\n";
            echo "            <td>" . htmlspecialchars($naissance) . "</td>\n";
            echo "        </tr>\n";
        }
        echo "    </table>\n";
    } else {
        echo "    <p>Aucun auteur trouvé avec ce critère.</p>\n";
    }
    echo "</body>\n";
    echo "</html>\n";
    ob_end_flush();
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
