<div>
  <h1>Connexion</h1>
  <form action="/?do=login" method="post" style="display: flex; flex-direction: column; width: 300px; gap: 10px;">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>
    <label for="mot_de_passe">Mot de passe</label>
    <input type="mot_de_passe" name="mot_de_passe" id="mot_de_passe" required>
    <input type="submit" value="Connexion">
  </form>
  <button onclick="window.location.href='/?do=register'">Inscription</button>
</div>