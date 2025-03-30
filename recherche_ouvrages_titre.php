<?php
header("Content-Type: application/json; charset=UTF-8");

if (!isset($_GET['debtitre'])) {
    echo json_encode([]);
    exit;
}

$debtitre = $_GET['debtitre'];

$host   = 'localhost';
$port   = '1234';
$dbname = 'livres';
$user   = 'postgres';
$pass   = 'BokuBoku123';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT o.code AS ouvrage_code, o.nom AS ouvrage_nom, 
                   e.code AS exemplaire_code, e.prix AS prix, ed.nom AS editeur_nom
            FROM ouvrage o
            LEFT JOIN exemplaire e ON o.code = e.code_ouvrage
            LEFT JOIN editeurs ed ON e.code_editeur = ed.code
            WHERE o.nom ILIKE :search
            ORDER BY o.nom, ed.nom";   
    $stmt = $pdo->prepare($sql);
    $search = "%" . $debtitre . "%";
    $stmt->bindParam(':search', $search, PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $ouvrages = [];
    foreach ($rows as $row) {
        $ouvrage_code = $row['ouvrage_code'];
        if (!isset($ouvrages[$ouvrage_code])) {
            $ouvrages[$ouvrage_code] = [
                "code" => $ouvrage_code,
                "nom" => $row['ouvrage_nom'],
                "exemplaires" => []
            ];
        }
        if ($row['exemplaire_code'] !== null) {
            $ouvrages[$ouvrage_code]["exemplaires"][] = [
                "nom" => $row['editeur_nom'],
                "code" => $row['exemplaire_code'],
                "prix" => $row['prix']
            ];
        }
    }
    echo json_encode(array_values($ouvrages));
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
