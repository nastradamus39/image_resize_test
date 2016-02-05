<?php

    define("ROOT_PATH",realpath(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR) );

    return [
        "app_path" => ROOT_PATH.DIRECTORY_SEPARATOR."app",
        "gallery_path" => realpath(ROOT_PATH."/public/gallery"),
        "cache_path" => realpath(ROOT_PATH."/app/cache")
    ];