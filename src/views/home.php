<div>
  <span>Welcome <?= $_SESSION['user']['prenom'] ?> <?= $_SESSION['user']['nom'] ?></span>
  <?= $text ?>
  <a href="/?do=logout">Se déconnecter</a>
</div>