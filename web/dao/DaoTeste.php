<?php


/**
 * Description of DaoUsuario
 *
 * @author gabriel.novais
 */

require_once(__DIR__ . '/Dao.php');
require_once(__DIR__ . '/../model/ModelTeste.php');

class DaoTeste extends Dao{
    //put your code here
    
    private $daoTeste;

    function __construct() {
        parent::__construct();
    }

    function teste() {
        try {

                                    
            $this->daoTeste = new DaoTeste();
            $this->plsql = "SELECT to_char(SYSDATE,'DD/MM/YYYY HH24:MI:SS') AS DATA FROM DUAL";
            $statement = $this->OCI_parse($this->plsql);

            $this->OCI_executar($statement);

            //return $this->buscarDoResultadoAssoc();
            
            $lista = array();
            
            while($row = $this->OCI_fetch_array($statement)){
                
                $teste = new ModelTeste();
                    //setando os valores
                $teste->setSysdate($row['DATA']);
                                
                $lista[] = $teste;
            }
            
            //$this->OCI_free_statement($statement);
            //$this->OCI_close($this->connOCI);
           
            if (!empty($lista)) {
                return $lista;
            }else{
                return false;
            }
        } catch (Exception $e) {
            $this->adicionarErro("Error!: " . $e->getMessage());
            echo '{"erro":"' . $e->getMessage() . '"}';
        }
    }
}
