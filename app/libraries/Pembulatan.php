<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pembulatan {
    public function keAtas($uang){
        $selisih = 0;

        if(strlen($uang) < 4){
            if(substr($uang, 1) < 50){
                $selisih = 50 - substr($uang, 1);
            }else{
                $selisih = 100 - substr($uang, 1);
            }
        }else{
            if(substr($uang, 1) < 500){
                $selisih = 500 - substr($uang, -3);
            }else{
                $selisih = 1000 - substr($uang, -3);
            }
        }

        return $uang + $selisih;
    }
}