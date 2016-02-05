<!DOCTYPE html>
<html lang="en">

    <head>

        <script type="text/javascript" src="/bower_components/jquery/dist/jquery.js"></script>
        <link rel="stylesheet" href="/bower_components/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
        <script type="text/javascript" src="/bower_components/fancybox/source/jquery.fancybox.pack.js"></script>


        <script>
            $(document).ready(function() {
                $('.fancybox').fancybox();
            });
        </script>

    </head>

    <body>

    <?php
        $config = require_once(__DIR__."/../app/config.php");
        $list = scandir($config['gallery_path']);
    ?>


    <? foreach($list as $file): ?>

        <? if(preg_match("/^[a-zA-Z0-9\_\-]+\.(jpg|jpeg|png|gif)+$/si", $file)): ?>
            <a href="/gallery/<?=$file?>?s=big" class="fancybox" rel="gallery" title=""><img src="/gallery/<?=$file?>?s=min" /></a>
        <? endif ?>

    <? endforeach ?>


    </body>

</html>
