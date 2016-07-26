<?php

include_once __DIR__.'/Control.php';
include_once __DIR__.'/../dao/DaoTeste.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Teste
 *
 * @author gabriel.novais
 */
class Teste extends Control{
    
    function __construct() {
        parent::__construct();
    }

    
    function get_teste(){
        $this->daoTeste = new DaoTeste();
        return $this->daoTeste->teste();
        //return 'oi';
    }
}

