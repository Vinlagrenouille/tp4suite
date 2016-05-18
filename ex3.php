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
  <FORM method='get' action='ex3.php'>
      <p>
        Nom<br>
        <input type="text" name="nom"/><br>Film<br>
        <SELECT name='film'>
          <?php
          $link = mysqli_connect("dwarves.iut-fbleau.fr","navales","JwLy54NVALVQDRAn","navales");
          if(!$link){
            die("<p>Connexion au serveur impossible</p>");
          }
          $res = mysqli_query($link,"select idFilm,titre from Film");
          foreach($res as $value){
            echo "<option value=".$value['idFilm'].">".$value['titre'];
          }
          ?>
        </SELECT>
        <br/>Artiste<br/>
        <SELECT name='real'>
          <?php
           $res = mysqli_query($link,"select distinct nom,idArtiste from Artiste");
           foreach($res as $value){
              echo "<option value=".$value['idArtiste'].">".$value['nom'];
           }
          ?>
         </SELECT>
        <br/>
        <input type="submit" value="Valider" />
      </p>
    <?php
      extract($_GET);
      if(isset($_GET['nom'])){
        $nom = $_GET['nom'];
      }
      if(isset($_GET['film'])){
        $film = $_GET['film'];
      }
      if(isset($_GET['real'])){
        $real = $_GET['real'];
      }
      if(isset($nom) && isset($film) && isset($real)){
        mysqli_query($link,"insert into Role(idFilm, idActeur, nomRole) values (\"$film\",\"$real\",\"$nom\")");
      }
    ?>
  </FORM>
  <h1>
    Films
  </h1>
  <table>
    <thead>
      <tr>
        <th>Nom</th>
        <th>Film</th>
        <th>Role</th>
      </tr>
    </thead>
    <?php
        if(isset($_GET['real'])){
          $real=$_GET['real'];
        }
        else if(empty($_GET['real'])){
          $real = "tous";
        }
      $res = mysqli_query($link,"select nom, titre, nomRole from Film, Artiste, Role where Film.idFilm = Role.idFilm and idArtiste=idActeur ");
      if(!$res){
        die("<p>Resultat non-disponible</p>");
      }
      else{
        foreach($res as $value){
          echo "<tr>";
          echo "<td>".$value['nom']."</td>";
          echo "<td>".$value['titre']."</td>";
          echo "<td>".$value['nomRole']."</td>";
          echo "</tr>";
        }
       }
    mysqli_close($link);
    ?>
  </table>
</body>

</html>