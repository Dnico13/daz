
document.querySelector('form').addEventListener('submit', function (event) {
    const confirmation = confirm("✉️ Tout est prêt ! On appuie sur \"Envoyer\" ??");
    if (!confirmation) {
        event.preventDefault(); // Annule l'envoi du formulaire
    }
});
