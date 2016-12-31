<?php


class Message
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function insertMessage($objet, $message) {

        $this->db->query("INSERT INTO Messages SET objet = ?, libelle = ?,dateEnvoi = ?, statut = ?",
            [$objet,$message,date('Y-m-d'),'envoi']
            );

    }

    public function sendSms($numero, $text, $login, $password) {

        $url = 'http://localhost:14000/cgi-bin/sendsms?from=Sanarsoft&username='.$login.'&password='.$password.'&to='.$numero.'&text='.urlencode($text);
       // passthru("php -S http://localhost:14000.$url");
        $results = curl_init();
        curl_setopt($results, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($results,CURLOPT_URL,$url);
        curl_setopt($results, CURLOPT_HEADER, 0);
        $response = curl_exec($results);
        curl_close($results);
        echo "Message sent";
        return $response;
    }

}