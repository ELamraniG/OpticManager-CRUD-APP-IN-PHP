<?php

function redirection($url)
{
	if (headers_sent())
		print('<meta http-equiv="refresh" content="0;URL='.$url.'">');
	else 
		header("Location: $url");
}

function fct_prenom($prenom)
{
	$prenom = strtoupper(substr($prenom, 0, 1)).strtolower(substr($prenom,1,strlen($prenom)-1));
	return($prenom);
}
function moncrypte($mdp)
{
	$mon_mdp = "";
	for ($i=0; $i<=strlen($mdp); $i++)
		$mon_mdp .=ord($mdp[$i]);
	
	$mon_mdp.=strlen($mdp);
	return $mon_mdp;
}

function get_image($photo)
{
    $nom = $_FILES['photo']['name'];
    $type = $_FILES['photo']['type'];
    if ($type == "image/jpeg" || $type == "image/png" || $type == "image/jpg")
    {
            $name_tmp = $_FILES['photo']['tmp_name'];
            $dossier = "../images/employe-profile/";
            if (move_uploaded_file($name_tmp, $dossier.utf8_decode($nom)))
                return $nom;
            else
            {
                echo "<br>File not uploaded...";
                return "error"; 
            }
    }
    else
        echo "ERROR #001 : FILE IS NOT IMAGE <br>";
        return "error";
}
?>