<?php
  require("../head.php");
  require("../menu.php"); 
?>
<style>
  body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

header {
  background-color: lightblue;
  color: white;
  padding: 1rem 0;
  text-align: center;
  margin-top: 80;
}

.container {
  max-width: 800px;
  margin: auto;
  padding: 2rem;
}

.contact-section {
  text-align: center;
}

.whatsapp-btn {
  display: inline-block;
  background-color: #25D366;
  color: white;
  padding: 12px 20px;
  font-size: 1rem;
  border-radius: 8px;
  text-decoration: none;
  transition: background-color 0.3s ease;
}

.whatsapp-btn:hover {
  background-color: #1eb85c;
}

footer {
  text-align: center;
  padding: 1rem;
  background-color: #f2f2f2;
  margin-top: 2rem;
}
.profile-pic {
  width: 140px;
  height: 140px;
  border-radius: 50%;
  object-fit: cover;
  margin-bottom: 1rem;
  border: 3px solid #25D366;
}

</style>  
</head>
<body>
  <header>
    <h1>Contact</h1>
  </header>

  <main class="container">
    <section class="contact-section">
      <img src="profil.png" alt="Photo du développeur" class="profile-pic">
      <h2>Contactez-moi</h2>

      <p>
        <i class="fab fa-whatsapp"></i> <strong>WhatsApp :</strong><br>
        Cliquez ici pour discuter directement :
      </p>

      <a href="https://wa.me/212612345678" class="whatsapp-btn" target="_blank">
   Envoyer un message sur WhatsApp
</a>

      <p style="margin-top: 1rem;">
        Ou ajoutez manuellement : <strong>+212 6 12 34 56 78</strong>
      </p>

      <hr style="margin: 2rem 0;">

      <p>
        <strong>Mon GitHub :</strong><br>
        <a href="https://github.com/monprofil" target="_blank">github.com/monprofil</a>
      </p>

      <p>
        <strong>Mon Portfolio :</strong><br>
        <a href="https://monportfolio.com" target="_blank">monportfolio.com</a>
      </p>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Gestion de la Paie - Tous droits réservés</p>
  </footer>
</body>
</html>
