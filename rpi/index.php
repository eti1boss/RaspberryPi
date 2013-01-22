<html>
<head>
<script type="text/javascript" src="script.js"></script>
</head>
<body>
<form>
	<input type="button" value="Tout cocher" onClick="GereChkbox('div_chck','1');">
        <input type="button" value="Tout decocher" onClick="GereChkbox('div_chck','0');">
        <input type="button" value="Inverser la selection" onClick="GereChkbox('div_chck','2');">
</form>
<form method="post" action="launch.php">
<input type="submit">
<a href="stop.php" target="_blank"> <input type="button" value="Stop"></a><br/>
<?

$nom = $_GET["nom"];
$id=1;
if("" == $nom)$nom = "/";
?>
<div id="div_chck">
<?
$file = array();
liste($nom);

function liste($name)
{
	if ($handle = opendir($name))
	{
		//echo realpath(dirname(readdir($handle)))."<br/><br/>";
		while (false !== ($logFile = readdir($handle)))
		{
			$file[] = $logFile; 
		}
		closedir($handle);
		sort($file);
		for($i=0;$i<count($file);$i++)
		{
			if ($file[$i] == "..")
                        {
	                        $parent = realpath(dirname($name));
                                echo "<a href='index.php?nom=$parent'>Remonter</a><br/>";
                        }
                        else
                        {
				if (preg_match("#^.+\..+$#",$file[$i]) == 0) //si on a un dossier
				{
					$type = "dir";
					$path = realpath(dirname('+.file[$i].'));
					echo "<a href='index.php?nom=$name/$file[$i]'>$file[$i]</a><br/>";
				}
				else //sinon (c'est un fichier)
				{
					$type = "file";
					$pattern = array('/\s/','/\(/','/\)/');
					$replace = array('\ ','\(','\)');
					$fileWithoutSpace = preg_replace($pattern,$replace,$file[$i]);// transforme les espace en '\ 'pour le bash
					$pathWithoutSpace = preg_replace($pattern,$replace,$name.'/'.$file[$i]);//idem
					echo "<input type=\"checkbox\" id=\"n$id\"  name='$fileWithoutSpace' value='$pathWithoutSpace'>$name/$file[$i]<br/>";
					$id++;
				}
			}
		}
	}
}
?>
</div>
</form>
</body>
</html>
