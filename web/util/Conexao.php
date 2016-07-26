<?php


    require_once 'ConfigInfra.php';

class Conexao  {
    
    private static $instance;
    private static $OciInstance;
    private static $tns;
    private static $user;
    private static $pass;
    private static $db;
    private static $ip;
    private static $porta;
    private static $oracle;
    private static $config;
   
  
   
   
   private function __construct() {
       
   }
   
   public static function getInstanceMysql() {
        if (!isset(self::$instance)) {
            self::obterConfigMysql();
            self::$instance = new PDO('mysql:host='.self::$ip.';dbname='.self::$db,
                    self::$user,self::$pass,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",  
                    PDO::ATTR_PERSISTENT => true));
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }
        
        return self::$instance;
   }
 
   public static function getOciInstance(){
       if(!isset(self::$OciInstance)){
           self::obterConfigOracle();
           
           self::$OciInstance = oci_connect(self::$user, self::$pass,self::$tns);
       }
       
       return self::$OciInstance;
   }

      private static function obterConfigOracle(){
       self::$config = new ConfigInfra();                   
       $ini = self::$config->getArquivoIni();       
       self::$ip = $ini['oracle']['ip'];
       self::$porta = $ini['oracle']['porta'];
       self::$user = $ini['oracle']['user'];
       self::$pass = $ini['oracle']['pass'];
       self::$db = $ini['oracle']['db'];
       self::$tns = "(DESCRIPTION =
                            (ADDRESS = (PROTOCOL = TCP)(HOST = ".self::$ip.")(PORT = ".self::$porta."))
                                (CONNECT_DATA =
                                    (SERVER = DEDICATED)
                                    (SERVICE_NAME = ".self::$db.")
                                )
                        )";
       self::$oracle = "oci:dbname=".self::$tns;
   }
   
   private static function obterConfigMysql(){
       self::$config = new ConfigInfra();                   
       $ini = self::$config->getArquivoIni();       
       self::$ip = $ini['mysql']['ipMysql'];
       self::$user = $ini['mysql']['userMysql'];
       self::$pass = $ini['mysql']['passMysql'];
       self::$db = $ini['mysql']['dbMysql'];       
   }
   

 }
 
 ?>