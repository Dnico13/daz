import Route from "./Route.js";

//Définir ici vos routes
export const allRoutes = [
    new Route("/", "Accueil", "./Pages/home.html"),
    new Route("/presentationDavidZinghini", "Présentation de David ZINGHINI", "./Pages/presentationDavidZinghini.html"),
    new Route("/roleEtMissions", "Rôle et Missions de l'expertise Immobiliére", "./Pages/roleEtMissions.html"),
    new Route("/perimetreDintervention", "Périmétre d'intervention", "./Pages/perimetreDintervention.html"),
    new Route("/methodologie", "Methodologie d'estimation", "./Pages/methodologie.html"),
    new Route("/rapport", "Le rapport d'expertise", "./Pages/rapport.html"),
    new Route("/deontologie", "Le code de déontologie", "./Pages/deontologie.html"),
    new Route("/expertise", "L'expertise Immobilière", "./Pages/expertise.html"),
    new Route("/partenaires", "Partenaires experts", "./Pages/partenaires.html"),
    new Route("/contact", "Contactez DAZ Expertise Immobilière – Estimation en valeur vénale", "./Pages/contact.html"),
    new Route("/actualites", "Actualités immobilières – Marché & valeur vénale ", "./Pages/actualites.php"),
    new Route("/temoignages", "Témoignage", "./Pages/temoignage.html"),
    new Route("/sommaire-actualites", "sommaire", "./Pages/sommaire-actualites.php"),
    new Route("/avis-client", "Avis clients – Estimations en valeur vénale ", "./Pages/avis.php"),
    new Route("/ajouter-avis", "Avis clients – Ajouter un avis ", "./Pages/ajouterAvisFront.php"),
    new Route("/ajouterAvis", " Ajouter un Avis clients – Estimations en valeur vénale ", "./Pages/AjouterAvisFront.php"),
    
    
    new Route("/admin", "Dasboard du site", "./back/admin.php"),
    new Route("/log-Out", "Déconnexion au Dashboard", "./back/logout.php"),
    new Route("/log-In", "Connexion au Dashboard", "./back/login.php"),
    
    

];

//Le titre s'affiche comme ceci : Route.titre - websitename
export const websiteName = "DAZ L'expertise Immobiliere";