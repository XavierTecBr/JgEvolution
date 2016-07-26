<?php

class ConfigInfra {
    private $arquivoIni;
    
    public function __construct() {
        $this->arquivoIni = $this->carregarConfig();
    }
    
    private function carregarConfig(){
        return parse_ini_file(__DIR__."/../config.ini", TRUE);
    }
    
    public function getArquivoIni() {
        return $this->arquivoIni;
    }


}
