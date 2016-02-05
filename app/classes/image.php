<?php

class image
{

    private $sizes = [
        "big" => [800,600],
        "med" => [600,400],
        "min" => [300,200],
        "mic" => [101,101]
    ];

    private $mime;

    private $file;

    private $name;

    private $types = ["", "gif", "jpeg", "png"];

    private $originWidth;

    private $originHeight;

    private $type;

    private $originalImageResourse;

    private $imageCreateFunc;

    private $imageReanderFunc;

    private $config;

    private $cache;


    public function __construct($file){
        $this->config = require(__DIR__."/../../app/config.php");

        $this->file = $file;

        list($this->originWidth, $this->originHeight, $this->type) = getimagesize($this->file);

        $this->imageCreateFunc = "imagecreatefrom".$this->types[$this->type];
        $this->imageReanderFunc = "image".$this->types[$this->type];

        $f = $this->imageCreateFunc;
        $this->originalImageResourse = $f($file);

        // parse file name
        preg_match_all("/^.*\/([a-zA-Z0-9\_\-]+)\.[a-zA-Z]+$/si", $file, $matches);
        $this->name = $matches[1][0];
    }

    public function render($size = null)
    {

        header("Content-type:  {$this->mime}");

        $create = $this->imageCreateFunc;
        $render = $this->imageReanderFunc;
        $this->cache = $this->config['cache_path']."/".$this->name."_".$size.".".$this->types[$this->type];

        // render origin
        if(is_null($size)){
            $r = $create($this->file);
            $render($r);
        }else{

            // check cache
            if(!is_file($this->cache)){
                if(isset($this->sizes[$size])){
                    $this->resize($size);
                }else{
                    echo "Нет такого размера.";
                }
            }

            $this->resize($size);
            $render($create($this->cache));
        }

    }

    private function resize($size)
    {
        $w_o = $this->sizes[$size][0];
        $h_o = $this->sizes[$size][1];

        if (($w_o < 0) || ($h_o < 0)) {
            return false;
        }

        if (!$h_o) $h_o = $w_o / ($this->originWidth / $this->originHeight);
        if (!$w_o) $w_o = $h_o / ($this->originHeight / $this->originWidth);
        $img_o = imagecreatetruecolor($w_o, $h_o);
        imagecopyresampled($img_o, $this->originalImageResourse, 0, 0, 0, 0, $w_o, $h_o, $this->originWidth, $this->originHeight);

        $f = $this->imageReanderFunc;
        return $f($img_o, $this->cache);
    }


}