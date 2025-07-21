

    document.addEventListener('DOMContentLoaded', () => {
      const form = document.getElementById('form-avis');
      const feedback = document.getElementById('feedback');

      if (!form) {
        console.warn("🛑 Le formulaire #form-avis est introuvable. Vérifie ton HTML et le moment où ton script est chargé.");
        return;
      }

      form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const data = {
          prenom: form.querySelector('[name="prenom"]').value.trim(),
          ville: form.querySelector('[name="ville"]').value.trim(),
          notation: form.querySelector('[name="notation"]').value.trim(),
          avis: form.querySelector('[name="avis"]').value.trim()
        };

        try {
          const response = await fetch('http://localhost:3000/function/avis/sendAvis1.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
          });

          const result = await response.json();

          if (result.success) {
            feedback.innerHTML = `<div class="alert alert-success">Merci pour votre avis !</div>`;
            form.reset();
          } else {
            feedback.innerHTML = `<div class="alert alert-danger">${result.message || "Une erreur est survenue."}</div>`;
          }
        } catch (error) {
          feedback.innerHTML = `<div class="alert alert-danger">Erreur réseau ou serveur.</div>`;
        }
      });
    });

