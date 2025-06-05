<?php
  require("../head.php");
  require("../menu.php"); 
?>
<style>
  body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  line-height: 1.6;
  margin: 0;
  padding: 0;
  background-color: #f9f9f9;
  color: #333;
}

header {
  background-color: lightblue;
  color: white;
  padding: 1rem 0;
  text-align: center;
  margin-top: 80;
}

.container {
  max-width: 960px;
  margin: 2rem auto;
  padding: 0 1rem;
}

.about-section h2 {
  color: #004080;
  margin-top: 1.5rem;
}

.about-section ul {
  list-style-type: disc;
  padding-left: 1.5rem;
}

.about-section a {
  color: #004080;
  text-decoration: none;
}

.about-section a:hover {
  text-decoration: underline;
}

footer {
  background-color: #eee;
  text-align: center;
  padding: 1rem;
  margin-top: 2rem;
  font-size: 0.9rem;
  color: #555;
}
</style>
</head>
<body>

  <header>
    <h1>À propos</h1>
  </header>

  <main class="container">
    <section class="about-section">
      <h2>Notre Plateforme</h2>
      <p>
        Ce site de gestion de la paie a été conçu pour simplifier le traitement des salaires du personnel. 
        Il offre aux entreprises, écoles, associations et autres structures un outil complet pour automatiser la gestion de la paie.
      </p>

      <h2>Nos Objectifs</h2>
      <p>
        L’objectif est de fournir une solution intuitive, sécurisée et adaptée aux besoins locaux pour faciliter le travail des responsables des ressources humaines.
      </p>

      <h2>Fonctionnalités Clés</h2>
      <ul>
          <li>Gestion centralisée des employés et de leurs profils détaillés</li>
  <li>Organisation et gestion des différents services/departements</li>
  <li>Affectation des employés à leurs services respectifs</li>
  <li>Suivi et gestion des pointages du personnel</li>
  <li>Génération automatique des états de sortie (rapports, relevés, etc.)</li>
  <li>Consultation de l’historique complet des paiements</li>
  <li>Gestion des utilisateurs et des droits d’accès (rôles administratifs)</li>
  <li>Garantie de la sécurité et de la confidentialité des données</li>
  <li>Assistance intégrée et guide d’utilisation de l’application</li>
      </ul>

      <h2>À Qui S’adresse Cette Plateforme ?</h2>
      <p>
        Cette solution s’adresse aux PME, établissements scolaires, associations et tout autre organisme ayant besoin de gérer la paie de façon efficace.
      </p>

      <h2>À propos du développeur</h2>
<p>
  Ce site a été développé par <strong>Mohamed B.</strong>, développeur web passionné par les solutions de gestion numérique.  
  Il s'agit d'un projet personnel visant à répondre aux besoins de gestion de la paie dans les petites et moyennes structures.
</p>
<p>
  Technologies utilisées : PHP, MySQL, HTML, CSS, JavaScript.
</p>
<p>
  Vous pouvez consulter d'autres réalisations sur mon <a href="https://github.com/tonprofil" target="_blank">GitHub</a> ou me contacter via la page <a href="contact.html">Contact</a>.
</p>

    </section>
  </main>

  <footer>
    <p>&copy; 2025 Gestion de la Paie - Tous droits réservés</p>
  </footer>
</body>
</html>
