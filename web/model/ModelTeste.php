<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelTeste
 *
 * @author gabriel.novais
 */
class ModelTeste {
    //put your code here
    
    public $sysdate;
    
    function __construct() {
        
    }

    function getSysdate() {
        return $this->sysdate;
    }

    function setSysdate($sysdate) {
        $this->sysdate = $sysdate;
    }


}
