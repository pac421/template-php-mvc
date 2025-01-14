<?php

class UserModel
{
  public function getUserByEmail($email)
  {
    $db = Database::getInstance();
    $sql = "SELECT * FROM Utilisateur WHERE email = :email LIMIT 1";
    $statement = $db->getConnection()->prepare($sql);
    $statement->bindParam(':email', $email);
    $statement->execute();
    $result = $statement->fetchAll();
    if (count($result) == 0) return null;
    return $result[0];
  }

  public function createUser($nom, $prenom, $email, $mot_de_passe)
  {
    $db = Database::getInstance();
    $sql = "INSERT INTO Utilisateur (nom, prenom, email, mot_de_passe, role) VALUES (:nom, :prenom, :email, :mot_de_passe, :role)";
    $statement = $db->getConnection()->prepare($sql);
    $statement->bindParam(':nom', $nom);
    $statement->bindParam(':prenom', $prenom);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':mot_de_passe', $mot_de_passe);
    $statement->bindValue(':role', "client");
    $statement->execute();
    return $statement->rowCount();
  }
}
