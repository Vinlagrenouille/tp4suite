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
  <FORM method='get' action='ex2.php'>
      <p>
        Nom<br>
        <input type="text" name="nom"/><br>Genre<br>
        <SELECT name='genre'>
          <?php
          $link = mysqli_connect("dwarves.iut-fbleau.fr","navales","JwLy54NVALVQDRAn","navales");
          if(!$link){
            die("<p>Connexion au serveur impossible</p>");
          }
          $res = mysqli_query($link,"select distinct code from Genre");
          foreach($res as $value){
            echo "<option value=".$value['code'].">".$value['code'];
          }
          ?>
        </SELECT>
        <br/>Pays<br/>
        <SELECT name='pays'>
          <?php
          $link = mysqli_connect("dwarves.iut-fbleau.fr","navales","JwLy54NVALVQDRAn","navales");
          if(!$link){
            die("<p>Connexion au serveur impossible</p>");
          }
          $res = mysqli_query($link,"select distinct code from Pays");
          foreach($res as $value){
            echo "<option value=".$value['code'].">".$value['code'];
          }
          ?>
        </SELECT>
        <br/>Realisateur<br/>
        <SELECT name='real'>
          <?php
           $res = mysqli_query($link,"select distinct nom,idMes from Artiste, Film where idMes = idArtiste");
           foreach($res as $value){
              echo "<option value=".$value['idMes'].">".$value['nom'];
           }
          ?>
         </SELECT>
        <br>Resume<br>
        <input type="text" name="resume"/>
        <br>Annee<br>
        <input type="text" name="annee"/><br>
        <input type="submit" value="Valider" />
      </p>
    <?php
      extract($_GET);
      if(isset($_GET['nom'])){
        $nom = $_GET['nom'];
      }
      if(isset($_GET['genre'])){
        $genre = $_GET['genre'];
      }
      if(isset($_GET['pays'])){
        $pays = $_GET['pays'];
      }
      if(isset($_GET['real'])){
        $real = $_GET['real'];
      }
      if(isset($_GET['resume'])){
        $resume = $_GET['resume'];
      }
      if(isset($_GET['annee'])){
        $annee = $_GET['annee'];
      }
      if(isset($nom) && isset($genre) && isset($annee) && isset($pays) && isset($real) && isset($resume)){
        mysqli_query($link,"insert into Film(titre,annee,idMes,genre,resume,codePays) values (\"$nom\",\"$annee\",\"$real\",\"$genre\",\"$resume\",\"$pays\")");
      }
    ?>
  </FORM>
  <h1>
    Films
  </h1>
  <table>
    <thead>
      <tr>
        <th>Titre</th>
        <th>Genre</th>
      </tr>
    </thead>
    <?php
        if(isset($_GET['real'])){
          $real=$_GET['real'];
        }
        else if(empty($_GET['real'])){
          $real = "tous";
        }
      $res = mysqli_query($link,"select f.titre,f.genre from Film f ");
      if(!$res){
        die("<p>Resultat non-disponible</p>");
      }
      else{
        foreach($res as $value){
          echo "<tr>";
          echo "<td>".$value['titre']."</td>";
          echo "<td>".$value['genre']."</td>";
          echo "</tr>";
        }
       }
    mysqli_close($link);
    ?>
  </table>
</body>

</html>