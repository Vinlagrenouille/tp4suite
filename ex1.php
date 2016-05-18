<!DOCTYPE html>
<html>

<head>
  <meta charset="latin1">
  <meta name="viewport" content="width=device-width">
  <title>Films</title>
</head>

<body>
  <h1>
    Ajout
  </h1>
  <FORM method='get' action='ex1.php'>
      <p>
        Prenom<br>
        <input type="text" name="prenom"/><br>Nom<br>
        <input type="text" name="nom"/><br>Annee<br>
        <input type="text" name="annee"/><br>
        <input type="submit" value="Valider" />
      </p>
    <?php
      extract($_GET);
      if(isset($_GET['nom'])){
        $nom = $_GET['nom'];
      }
      if(isset($_GET['prenom'])){
        $prenom = $_GET['prenom'];
      }
      if(isset($_GET['annee'])){
        $annee = $_GET['annee'];
      }
      $link = mysqli_connect("dwarves.iut-fbleau.fr","navales","JwLy54NVALVQDRAn","navales");
      if(!$link){
        die("<p>Connexion au serveur impossible</p>");
      }
      if(isset($nom) && isset($prenom) && isset($annee)){
        mysqli_query($link,"insert into Artiste(nom,prenom,anneeNaiss) values (\"$nom\",\"$prenom\",\"$annee\")");
      }
      mysqli_close($link);
    ?>
  </FORM>
  <h1>
    Films
  </h1>
  <table>
    <thead>
      <tr>
        <th>Artiste</th>
        <th>Annee</th>
      </tr>
    </thead>
    <?php
      $link = mysqli_connect("dwarves.iut-fbleau.fr","navales","JwLy54NVALVQDRAn","navales");
      if(!$link){
        die("<p>Connexion au serveur impossible</p>");
      }
      $res = mysqli_query($link,"select nom, prenom, anneeNaiss from Artiste");
      if(!$res){
        die("<p>Resultat non-disponible</p>");
      }
      else{
        foreach($res as $value){
          echo "<tr>";
          echo "<td>".$value['nom']." ".$value['prenom']."</td>";
          echo "<td>".$value['anneeNaiss']."</td>";
          echo "</tr>";
        }
       }
    mysqli_close($link);
    ?>
  </table>
</body>

</html>