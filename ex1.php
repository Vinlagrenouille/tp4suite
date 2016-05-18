<!DOCTYPE html>
<html>

<head>
  <meta charset="latin1">
  <meta name="viewport" content="width=device-width">
  <title>Films</title>
</head>

<body>
  <h1>
    Films
  </h1>
  <FORM method='get' action='filmexo2.php'>
    <SELECT name='real'>
      <?php
      $link = mysqli_connect("http://dwarves.iut-fbleau.fr","navales","JwLy54NVALVQDRAn","navales");
      if(!$link){
        die("<p>Connexion au serveur impossible</p>");
      }
      $res = mysqli_query($link,"select distinct nom from Artiste, Film where idMes = idArtiste");
      echo "<option value=\"tous\" > Tous ";
      foreach($res as $value){
        echo "<option value=".$value['nom'].">".$value['nom'];
      }
      ?>
      <INPUT TYPE="submit" ></INPUT>
    </SELECT>
  </FORM>
  <table>
    <thead>
      <tr>
        <th>Titre</th>
        <th>Annee</th>
        <th>Genre</th>
        <th>Real</th>
      </tr>
    </thead>
    <?php
        if(isset($_GET['real'])){
          $real=$_GET['real'];
        }
        else if(empty($_GET['real'])){
          $real = "tous";
        }
      $link = mysqli_connect("http://dwarves.iut-fbleau.fr","navales","JwLy54NVALVQDRAn","navales");
      if(!$link){
        die("<p>Connexion au serveur impossible</p>");
      }
      if($real == "tous"){
        $res = mysqli_query($link,"select f.titre,f.annee,f.genre,a.nom from Film f, Artiste a where f.idMes = a.idArtiste");
      }
      else{
        $res = mysqli_query($link,"select f.titre,f.annee,f.genre,a.nom from Film f, Artiste a where f.idMes = a.idArtiste and nom =\"$real\"");
      }
      if(!$res){
        die("<p>Resultat non-disponible</p>");
      }
      else{
        foreach($res as $value){
          echo "<tr>";
          echo "<td>".$value['titre']."</td>";
          echo "<td>".$value['annee']."</td>";
          echo "<td>".$value['genre']."</td>";
          echo "<td>".$value['nom']."</td>";
          echo "</tr>";
        }
       }
    mysqli_close($link);
    ?>
  </table>
</body>

</html>