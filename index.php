<?php require "include/header.php"; ?>
<?php require_once 'include/bootstrap.php' ;

$db = App::getDatabase();



if (!empty($_POST)) {

    $erreurs = array();

    if (empty($_POST['username'])) {

        $erreurs['username'] = "Le login est incorrect";
    }
    if (empty($_POST['username'])) {

        $erreurs['password'] = "Le mot de passe est incorrect";
    }

    if (empty($_POST['object'])) {

        $erreurs['object'] = "l'object du message ne peut pas etre  vide";
    }

    if (empty($_POST['text'])) {

        $erreurs['password'] = "le libelle du message ne peut pas etre  vide";
    }

    if (empty($erreurs)) {

        $mess = new Message($db);

        $mess->insertMessage($_POST['object'], $_POST['text']);

        $abonnes = $db->query('select * from Abonnes')->fetchAll();
        $response = '';
        try {
            foreach ($abonnes as $abonne) {
                $response =  $mess->sendSms($abonne->numTel,$_POST['text'], $_POST['username'], $_POST['password']);
            }
        }catch (Exception $ex) {
            echo $ex->getMessage();
        }

    }

}

?>



    <h1>Bienvenu sur la plateforme infocampus</h1>

<?php if (!empty($erreurs)): ?>
    <div class="alert alert-danger">
        <p>Vous n'avez pas rempli le formulaire correctement</p>
        <ul>
            <?php foreach ($erreurs as $err): ?>
                <li><?= $err; ?></li>

            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="object">Login</label>

            <input type="text" name="username" class="form-control">

        </div>
        <div class="form-group">
            <label for="object">Mot de passe</label>

            <input type="text" name="password" class="form-control">

        </div>
        <div class="form-group">
            <label for="object">Objet</label>

            <input type="text" name="object" class="form-control">

        </div>
        <div class="form-group">

            <label for="object">Libellé</label>

            <textarea  name="text" class="form-control"></textarea>

        </div>

        <input type="submit" class="btn btn-primary" value="Envoyer">
    </form>


<?php require  "include/footer.php"; ?>