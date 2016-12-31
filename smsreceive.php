<?php
     require_once 'include/bootstrap.php' ;

     $db = App::getDatabase();

    $t=$_GET['t'];
    $a=$_GET['a'];
    $q=$_GET['q'];

    $numero = $q;
    $message = explode("+",$a);
    $motcletinfo = $message[0];
    $nom = $message[1];
    $prenom = $message[2];
    $dI = $message[3];
    $password = $message[4];

    $mess = new Message($db);
    if ($t && $q) {
        $num = explode("« ",$numero);
        $tel = $num[1];
        if ($motcletinfo == "info") {

            $db->query("INSERT INTO Abonnes SET numTel = ?, nom = ?, prenom = ?, domaineInteret= ?, password = ?"

                , [$tel, $nom, $prenom, $dI, $password]);

            $response = $mess->sendSms($tel,"Merci votre inscription sur la plateforme de SMS de Sanarsoft a reussi","kannel","kannel");


        }
        else {

            $response = $mess->sendSms($tel,"Veillez renseigner le bon mot-clé: info");
        }


    }
    else {

        echo "Connexion impossible";
    }

