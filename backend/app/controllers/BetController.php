<?php

require "app/models/Bets.php";
require "app/models/UsersBets.php";

class BetController
{
  public function getBets()
  {
    // TODO : Généricité
    $dbh = App::get('dbh');

    $req = "SELECT * FROM bets";
    $statement = $dbh->prepare($req);
    $statement->execute();

    // TODO : debate opt 1 vs opt 2
    /*$bets = $statement->fetchAll(PDO::FETCH_CLASS, "Bets");
    echo $bets;*/

      $bets = $statement->fetchAll(PDO::FETCH_ASSOC);
    // TODO : remove when not in dev
    header("Access-Control-Allow-Origin: *");
    echo json_encode($bets);
  }

  public function createBet()
  {
    $bet = new Bets;
    // TODO : remove when not in dev
    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = json_decode(file_get_contents("php://input"), true);

      $bet->setTitle($_POST["title"]);
      $bet->setDescription($_POST["description"]);
      $bet->setWinOpt1($_POST["option1"]);
      $bet->setWinOpt2($_POST["option2"]);
      $bet->setEventDate($_POST["eventDate"]);
      $bet->setParticipationPrice($_POST["participationPrice"]);

      $dbh = App::get('dbh');

      // TODO : vérifier bonne valeur passé à la db, check parameters
      $req = "INSERT INTO bets (title, description, eventDate, winOpt1, winOpt2, participationPrice) VALUES (?, ?, ?, ?, ?, ?)";
      $statement = $dbh->prepare($req);
      // TODO : pass by reference does not work
      $statement->bindParam(1, $_POST["title"]);
      $statement->bindParam(2, $_POST["description"]);
      $statement->bindParam(3, $_POST["eventDate"]);
      $statement->bindParam(4, $_POST["option1"]);
      $statement->bindParam(5, $_POST["option2"]);
      $statement->bindParam(6, $_POST["participationPrice"]);
      $statement->execute();

      exit(0);
    }
  }

  public function applyToBet(){

    // TODO : remove when not in dev
    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = json_decode(file_get_contents("php://input"), true);

      $dbh = App::get('dbh');

      // TODO : vérifier bonne valeur passé à la db, check parameters
      $req = "INSERT INTO users_bets VALUES (?, ?, ?)";
      $statement = $dbh->prepare($req);
      // TODO : pass by reference does not work
      $statement->bindParam(1, $_POST["userId"]);
      $statement->bindParam(2, $_POST["betId"]);
      $statement->bindParam(3, $_POST["betOpt"]);
      $statement->execute();

      exit(0);
    }
  }

  public function getUsersBets(){
    // TODO : change hard coded userid
    $userId = 1;
    $dbh = App::get('dbh');
    $req = "SELECT * FROM users_bets WHERE userId = ?";
		$statement = $dbh->prepare($req);
    $statement->bindParam(1, $userId);
		$statement->execute();
    // FIXME : Fetch class ?
		$results = $statement->fetchAll(PDO::FETCH_ASSOC);
    header("Access-Control-Allow-Origin: *");
    echo json_encode($results);
  }

  public function getBetById(){
    $betId = $_GET["betId"];
    $dbh = App::get('dbh');
    $req = "SELECT * FROM bets WHERE id = ?";
		$statement = $dbh->prepare($req);
    $statement->bindParam(1, $betId);
		$statement->execute();
    // FIXME : Fetch class ?
		$results = $statement->fetchAll(PDO::FETCH_ASSOC);
    header("Access-Control-Allow-Origin: *");
    echo json_encode($results);
  }

}
