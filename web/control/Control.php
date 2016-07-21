<?php

/*
 * System control Class
 */

/**
 * Description of Control : Ftp Access, list and Download
 *
 * @author gabriel.novais
 * @since 2016-07-21
 */
class Control {
    private $arrVersion;
    
    function __construct() {
    
        
    }

    
    
    function getArrVersion() {
        return $this->arrVersion[0];
    }

    private function setArrVersion($arrVersion) {
        $this->arrVersion[] = $arrVersion;
    }

    function loadVersionFile(){
        // define some variables
        $local_file = 'util/version.ini';
        $server_file = 'version.ini';

        $ftp_server = "localhost";
        $ftp_port   = 21;
        $ftp_user_name = "ftpuser_1";
        $ftp_user_pass = "pass1";
        
        // set up a connection or die
        $conn_id = ftp_connect($ftp_server,$ftp_port) or die("Couldn't connect to $ftp_server"); 
        
        // login with username and password
        $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

        // try to download $server_file and save to $local_file
        if (!ftp_get($conn_id, $local_file, $server_file, FTP_BINARY)) {
            
            echo "Couldn't connect to FTP Server\n";
        }

        // close the connection
        ftp_close($conn_id);
    }
    
}
