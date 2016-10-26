<?php


      // Si le titre est vide on redirige le client sur la page loacation...
    var_dump($_POST);

    if (empty($_POST['title'])) {
        header('Location: add_book.php');
    }
      //On importe la connexion en base de donnés
    include('db.php');
      //On convertila date insérer dans le formulaire
      // en Timestamp()
      // le 1er janvier 1977
    $date = strtotime($_POST['publish_date']);

      //On insère les données du livre en base de donnée
      //grâce à une requete SQL
    $query = $db->prepare("INSERT INTO book (title, author, publish_date, body) VALUES (:title, :author, :publish_date, :body)");
    $query->bindValue(':title', $_POST['title']);
    $query->bindValue(':author', $_POST['author']);
    $query->bindValue(':publish_date', $date);
    $query->bindValue(':body', $_POST['body']);

    //on execute le succes
    $result = $query->execute();
        //debuggage
    var_dump($query->errorInfo());
    var_dump($query);
    var_dump($result);
        //on redirige vers la page du formulaire
    header('location:add_book.php');
?>
