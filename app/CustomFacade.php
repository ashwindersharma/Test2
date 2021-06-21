<?php

namespace App;


class CustomFacade
{
    private $height;
    private $width;
    private $length;

    public function __construct($height,$width,$length) {
            $this->height = $height;
            $this->width = $width;
            $this->length = $length;
         }

          public function hello($message,$email){
              dump( "the  mail is sent to the given email ".$message);
          }


}
