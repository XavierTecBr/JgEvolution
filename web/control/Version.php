<?php

include_once __DIR__.'/Control.php';
include_once __DIR__.'/../dao/DaoVersion.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Version: Has methods that will list ftp version, aplly evolution or fall back
 *
 * @author gabriel.novais
 * @since 2016-07-21
 */
class Version extends Control{
    
    function __construct() {
        parent::__construct();
    }

    
    function get_listVersion(){
        $list = array();
        parent::loadVersionFile();
        $file = parse_ini_file(__DIR__."/../util/version.ini", TRUE);
        
        foreach ($file as $key => $value) {
            $list[] = $file[$key];
        }
        
        return array_reverse($list);
    }
    
     function get_atualVersion(){
        $this->daoVersion = new DaoVersion();
        return $this->daoVersion->listAtualVersion();
        //return 'oi';
    }
    
    
}
