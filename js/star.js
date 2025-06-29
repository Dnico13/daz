





window.onload = function () {
  // Récupérer l'élément HTML qui contient la note
  let noteElement = document.getElementsByClassName('star').value;

// Vérifier si l'élément existe







  // Récupérer la note
  //let note = noteElement.innerHTML;
  console.log(noteElement);

  // Afficher des étoiles en fonction de la note
  switch (noteElement) {
    case "1":
      document.getElementsByClassName("star").innerHTML = "★";
      break;
    case "2":
      document.getElementsByClassName("star").innerHTML = "★★";

      break;
    case "3":
      document.getElementsByClassName("star").innerHTML = "★★★";

      break;
    case "4":
      document.getElementsByClassName("star").innerHTML = "★★★★";

      break;
    case "5":
      document.getElementsByClassName("star").innerHTML = "★★★★★";

      break;
    default:
      console.error("Valeur inattendue :", noteElement);
      break;
  }
};
