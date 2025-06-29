<?php


require_once '../pdo.php';

?>






<div class="text-center container w-50 mt-3 py-5">

    <div class="form-signin">
        <form method="POST" action="../function/log.php">
            
            <h1 class="h3 mb-3 fw-normal">Connexion au Dashboard</h1>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" name="email" required>
                <label for="floatingInput">Adresse Mail</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" name="mdp" required>
                <label for="floatingPassword">Mot de passe </label>
            </div>

            
            <button class="w-50 btn btn-lg btn-primary mb-3" type="submit" name="submit">Connexion</button>
           
        </form>
    </div>





</div>