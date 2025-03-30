function recherche_auteurs() {
  var debnom = document.getElementById("menuInputAuteur").value;
  if (debnom.trim() === ""){
    document.getElementById("resultAuteur").innerHTML = "";
    return;
  }

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var auteurs = JSON.parse(xhr.responseText);
      var html = "<ol>";
      for (var i = 0; i < auteurs.length; i++) {
        var nom = auteurs[i].nom;
        var prenom = auteurs[i].prenom;
        var code = auteurs[i].code;
        html += '<li><a href="#" onclick="recherche_ouvrages_auteur(' + code + ')">' + nom + " " + prenom + "</a></li>";
      }
      html += "</ol>";
      document.getElementById("resultAuteur").innerHTML = html;
    }
  };
  xhr.open("GET", "recherche_auteurs.php?debnom=" + encodeURIComponent(debnom), true);
  xhr.send();
}


function recherche_ouvrages_titre() {
  var debtitre = document.getElementById("menuInputTitre").value;
  if (debtitre.trim() === ""){
      document.getElementById("resultTitre").innerHTML = "";
      return;
  }    
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var ouvrages = JSON.parse(xhr.responseText);
      var html = "<ol>";
      for (var i = 0; i < ouvrages.length; i++) {
          html += "<li>" + ouvrages[i].nom;
          if (ouvrages[i].exemplaires && ouvrages[i].exemplaires.length > 0) {
              html += affiche_exemplaires(ouvrages[i].exemplaires);
          }
          html += "</li>";
      }
      html += "</ol>";
      document.getElementById("resultTitre").innerHTML = html;
    }
  };
  xhr.open("GET", "recherche_ouvrages_titre.php?debtitre=" + encodeURIComponent(debtitre), true);
  xhr.send();
}
  
function affiche_exemplaires(exemplaires) {
  if (exemplaires.length === 0) return "";
  var ul = "<ul>";
  for (var j = 0; j < exemplaires.length; j++) {
    ul += "<li>" 
          + exemplaires[j].nom + ", " + exemplaires[j].prix + " euros "
          + "<a href=\"#\" onclick=\"ajouter_panier(" + exemplaires[j].code + ")\">[ajouter au panier]</a>"
          + "</li>";
  }
  ul += "</ul>";
  return ul;
}





function recherche_ouvrages_auteur(codeAuteur) {
    document.getElementById("resultTitre").innerHTML = "";
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var ouvrages = JSON.parse(xhr.responseText);
        affiche_ouvrages(ouvrages);
      }
    };
    xhr.open("GET", "recherche_ouvrages_auteur.php?code_auteur=" + encodeURIComponent(codeAuteur), true);
    xhr.send();
}

function affiche_ouvrages(ouvrages) {
  var html = "<ol>";
  for (var i = 0; i < ouvrages.length; i++) {
    html += "<li>" + ouvrages[i].nom;
    if (ouvrages[i].exemplaires && ouvrages[i].exemplaires.length > 0) {
      html += affiche_exemplaires(ouvrages[i].exemplaires);
    }
    html += "</li>";
  }
  html += "</ol>";
  document.getElementById("resultTitre").innerHTML = html;
}

function enregistrement() {
  var nom = document.getElementById("nom").value;
  var prenom = document.getElementById("prenom").value;
  var adresse = document.getElementById("adresse").value;
  var cp = document.getElementById("cp").value;
  var ville = document.getElementById("ville").value;
  var pays = document.getElementById("pays").value;
  
  var params = "nom=" + encodeURIComponent(nom) +
               "&prenom=" + encodeURIComponent(prenom) +
               "&adresse=" + encodeURIComponent(adresse) +
               "&cp=" + encodeURIComponent(cp) +
               "&ville=" + encodeURIComponent(ville) +
               "&pays=" + encodeURIComponent(pays);
  
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        var response = xhr.responseText.trim();
        if (response !== "no") {
          var expiryDate = new Date("2050-01-01T00:00:00Z").toUTCString();
          document.cookie = "code_client=" + response + "; expires=" + expiryDate + "; path=/";
          window.location.href = "index.php";
        } else {
          document.getElementById("inscriptionMessage").innerHTML = "Inscription échouée : un client existe déjà avec ces informations.";
        }
      } else {
        document.getElementById("inscriptionMessage").innerHTML = "Erreur lors de l'enregistrement.";
      }
    }
  };
  xhr.open("GET", "inscription.php?" + params, true);
  xhr.send();
}


function ajouter_panier(code_exemplaire) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      alert("L'article a été ajouté au panier");
    }
  };
  xhr.open("GET", "ajouter_panier.php?code_exemplaire=" + encodeURIComponent(code_exemplaire), true);
  xhr.send();
}

function consulter_panier() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      document.getElementById("panierContent").innerHTML = xhr.responseText;
    }
  };
  xhr.open("GET", "consulter_panier.php", true);
  xhr.send();
}

function commander() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      alert(xhr.responseText);
      document.getElementById("panierContent").innerHTML = "";
    }
  };
  xhr.open("GET", "commander.php", true);
  xhr.send();
}

function fermerPanier() {
  document.getElementById("panierContent").innerHTML = "";
}

function vider_panier() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      alert("Le panier a été vidé");
    }
  };
  xhr.open("GET", "vider_panier.php", true);
  xhr.send();
}
