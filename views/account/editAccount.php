<section>
    <h2>Editer son compte</h2>
    <form action="" method="post">
        <label for="lastname">Nom de famille</label>
        <input type="text" name="lastname" id="lastname" placeholder=<?=$_SESSION["user_lastname"] ?>>
        <label for="firstname">Prénom</label>
        <input type="text" name="firstname" id="firstname" placeholder=<?=$_SESSION["user_firstname"] ?>>
        <label for="email">Adresse Mail</label>
        <input type="text" name="email" id="email" placeholder=<?=$_SESSION["user_email"] ?>>

        <br>

        <label for="password">Mot de passe</label>
        <input type="text" name="password" id="password">
        <label for="passwordConf">Confirmer le mot de passe</label>
        <input type="text" name="passwordConf" id="passwordConf">

        <br>

        <input type="submit" value="Editer son compte" name="editAccount">
    </form>
</section>