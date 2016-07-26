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
class ModelVersion {
    //put your code here
    
    public $version;
    
    function __construct() {
        
    }

    function getVersion() {
        return $this->version;
    }

    function setVersion($version) {
        $this->version = $version;
    }



}
