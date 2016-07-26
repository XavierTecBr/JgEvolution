<?php


/**
 * Description of DaoUsuario
 *
 * @author gabriel.novais
 */

require_once(__DIR__ . '/Dao.php');
require_once(__DIR__ . '/../model/ModelVersion.php');

class DaoVersion extends Dao{
    //put your code here
    
    

    function __construct() {
        parent::__construct();
    }

    function listAtualVersion() {
        try {

                                    
            
            $this->plsql = "SELECT VERSAO FROM VERSION_ERP WHERE ERP = 1 AND DATA = (SELECT MAX(DATA) FROM VERSION_ERP WHERE ERP = 1)";
            $statement = $this->OCI_parse($this->plsql);

            $this->OCI_executar($statement);

            //return $this->buscarDoResultadoAssoc();
            
            $lista = array();
            
            while($row = $this->OCI_fetch_array($statement)){
                
                $versao = new ModelVersion();
                    //setando os valores
                $versao->setVersion($row['VERSAO']);
                                
                $lista[] = $versao;
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
