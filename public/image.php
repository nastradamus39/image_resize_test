<?php

    $config = require_once(__DIR__."/../app/config.php");

    require_once($config["app_path"].DIRECTORY_SEPARATOR."classes".DIRECTORY_SEPARATOR."image.php");

    $image = $config['gallery_path']."/".$_GET['name'].".".$_GET['e'];

    if(file_exists($image)){

        $imageObj = new image($image);
        $imageObj->render($_GET['s']);

    }else{
        echo "Изображение не найдено";
    }