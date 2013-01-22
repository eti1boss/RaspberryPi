<?
echo 'nombre de valeur : '.count($_POST).'<br/>';
foreach($_POST as &$value){
	echo "$value<br/>";
	$command = $command . ("omxplayer -o hdmi -o local $value;");
}

echo "Vous avez demande: $command<br/>";

$ret = ssh('localhost', 'pi', 'raspberry', $command);
echo '<pre>' . $ret . '</pre>';


function ssh($host, $login, $mdp, $command){
    if (!function_exists("ssh2_connect")) die("function ssh2_connect doesn't exist");
    if(!($con = ssh2_connect($host, 22))){
        echo "echec connexion\n";
    } else {
        echo "connexion etablie<br/>";
        if(!ssh2_auth_password($con, $login, $mdp)) {
            echo "echec authentification\n";
        } else {
        echo "authentification reussie<br/>";
            // execute a command
            if (!($stream = ssh2_exec($con, $command ))) {
                echo "echec de l'execution de la commande\n";
            } else {
                echo "commande executee avec succes<br/>";
                // collect returning data from command
                stream_set_blocking($stream, true);
                $data = "";
                while ($buf = fread($stream,4096)) {
                    $data .= $buf;
                }
                fclose($stream);
                return $data;
            }
        }
    }
}

?>
