<?php
    extract($_POST);
    $nom = $_FILES['photo']['name'];
    $type = $_FILES['photo']['type'];
    if ($type == "image/jpeg" || $type == "image/png" $type == "image/jpg")
    {
        if ($taille <= 500)
        {
            $name_tmp = $_FILES['photo']['tmp_name'];
            $dossier = "./images/";
            $uploading = false;
            if (move_uploaded_file($name_tmp, $dossier.utf8_decode($nom)))
            {
                $uploading = true;
                echo "<img src = \"".$name_tmp."\">";
            }
            else
                echo "<br>File not uploaded...";

        }
        else
            echo "<br>ERROR #002 : size is bigger than 500ko";
    }
    else
        echo "ERROR #001 : FILE IS NOT IMAGE";

    
