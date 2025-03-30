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

include 'counter.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Catalogue de la Bibliothèque Virtuelle</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <section id="visites">
      Visites : <?php echo $visits; ?>
    </section>
    <section id="titre">
      Catalogue Bibliothèque
    </section>
    <section id="user">
    <?php
      if (!isset($_COOKIE['code_client'])) {
          echo '<a id="lienInscription" href="#" onclick="toggleInscriptionForm()">Inscription</a>';
      } else {
          if (!isset($_SESSION['nom']) || !isset($_SESSION['prenom'])) {
              $code_client = $_COOKIE['code_client'];
              $stmt = $pdo->prepare("SELECT nom, prenom FROM client WHERE code_client = :code_client");
              $stmt->execute([':code_client' => $code_client]);
              if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  $_SESSION['nom'] = $row['nom'];
                  $_SESSION['prenom'] = $row['prenom'];
                  $_SESSION['code_client'] = $code_client;
              }
          }
          if (isset($_SESSION['nom']) && isset($_SESSION['prenom'])) {
              echo "Bienvenue " . htmlspecialchars($_SESSION['prenom']) . " " . htmlspecialchars($_SESSION['nom']) . "<br>";
              echo "Quitter";
          } else {
              echo '<a id="lienInscription" href="#" onclick="toggleInscriptionForm()">Inscription</a>';
          }
      }
      ?>
      <a href="#" onclick="consulter_panier()">Consulter le panier</a>
      <a href="#" onclick="vider_panier()">Vider le panier</a>
    </section>
  </header>

  <nav>
    <input type="text" id="menuInputAuteur" placeholder="Auteur" onkeyup="recherche_auteurs()">
    <input type="text" id="menuInputTitre" placeholder="Titre" onkeyup="recherche_ouvrages_titre()">
  </nav>

  <main>
    <section class="main-content">
      <p>Bienvenu sur le site de la bibliothèque virtuelle.</p>
      <div id="panierContent"></div>
      <div id="resultAuteur"></div>
      <div id="resultTitre"></div>
      <!--
      <p id="lienInscription" onclick="toggleInscriptionForm()" style="cursor: pointer; color: blue; text-decoration: underline;">
        Inscription
      </p>-->
      <div id="formInscription" style="display: none;">
        <h2>Inscription d'un client</h2>
        <form id="inscriptionForm" onsubmit="event.preventDefault(); enregistrement();">
          <label for="nom">Nom :</label><br>
          <input type="text" id="nom" name="nom" required><br><br>
          
          <label for="prenom">Prénom :</label><br>
          <input type="text" id="prenom" name="prenom" required><br><br>
          
          <label for="adresse">Adresse :</label><br>
          <input type="text" id="adresse" name="adresse" required><br><br>
          
          <label for="cp">Code Postal :</label><br>
          <input type="text" id="cp" name="cp" required><br><br>
          
          <label for="ville">Ville :</label><br>
          <input type="text" id="ville" name="ville" required><br><br>
          
          <label for="pays">Pays :</label><br>
          <input type="text" id="pays" name="pays" required><br><br>
          
          <input type="submit" value="Envoyer">
        </form>
        <div id="inscriptionMessage"></div>
      </div>
    </section>
  </main>

  <script src="script.js"></script>
  <script>
    function toggleInscriptionForm() {
      var formDiv = document.getElementById("formInscription");
      if (formDiv.style.display === "none" || formDiv.style.display === "") {
        formDiv.style.display = "block";
      } else {
        formDiv.style.display = "none";
      }
    }
  </script>
</body>
</html>
