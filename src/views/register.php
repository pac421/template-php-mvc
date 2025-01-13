<div>
  <h1>Inscription</h1>
  <form action="/?do=register" method="post" style="display: flex; flex-direction: column; width: 300px; gap: 10px;">
    <label for="prenom">Prénom</label>
    <input type="text" name="prenom" id="prenom" required>
    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom" required>
    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>
    <label for="mot_de_passe">Mot de passe</label>
    <input type="mot_de_passe" name="mot_de_passe" id="mot_de_passe" required>
    <input type="submit" value="Inscription">
  </form>
  <button onclick="window.location.href='/?do=login'">Connexion</button>
</div>