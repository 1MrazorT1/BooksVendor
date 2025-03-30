<?php
header("Content-Type: application/json; charset=UTF-8");
if (!isset($_GET['debnom'])) {
    echo json_encode([]);
    exit;
}
$debnom = $_GET['debnom'];
$host   = 'localhost';
$port   = '1234';
$dbname = 'livres';
$user   = 'postgres';
$pass   = 'BokuBoku123';
try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT code, nom, prenom FROM auteurs WHERE nom ILIKE :search ORDER BY nom";
    $stmt = $pdo->prepare($sql);
    $search = "%" . $debnom . "%";
    $stmt->bindParam(':search', $search, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($results);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>

