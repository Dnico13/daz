<div class="col-md-2 d-flex flex-column">
    <div class="list-group" id="nav-links">
        <a href="admin.php" class="list-group-item list-group-item-action">Accueil</a>
        <!-- <a href="users.php" class="list-group-item list-group-item-action">Gestion des utilisateurs</a>-->
        <a href="contenu-admin.php" class="list-group-item list-group-item-action">Gestion des Actualités</a>
        <a href="etudes-admin.php" class="list-group-item list-group-item-action">Gestion des cas concrets </a>
        <a href="avis-admin.php" class="list-group-item list-group-item-action">Gestion des avis clients</a>
        <a href="partenaires-admin.php" class="list-group-item list-group-item-action">Gestion des Partenaires</a>
        <a href="messages-admin.php" class="list-group-item list-group-item-action">Gestion des Messages</a>
        <a href="logout.php" class="list-group-item list-group-item-action">Déconnexion</a>
    </div>
</div>

<script>
    // Récupère le chemin de la page actuelle (ex: "avis-admin.php")
    const currentPage = window.location.pathname.split('/').pop();

    // Récupère tous les liens dans la liste
    const links = document.querySelectorAll('#nav-links a');

    // Boucle sur chaque lien pour ajouter la classe active si le href correspond
    links.forEach(link => {
        if (link.getAttribute('href') === currentPage) {
            link.classList.add('active');
        }
    });
</script>