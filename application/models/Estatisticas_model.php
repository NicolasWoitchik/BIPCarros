<?php
class Estatisticas_Model extends MY_Model {

    private $database = NULL;
    
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();		
        $this->database = array('db' => 'default', 'table' => 'estatisticas');
    }
	
    public function adicionar( $data = array() )
    {
        return $this->adicionar_($this->database, $data);
    }
    
    public function editar($data = array(),$filtro = array())
    {
        return $this->editar_($this->database, $data, $filtro);
    }
    
    public function excluir($filtro)
    {
        return $this->excluir_($this->database, $filtro);
    }
    
    public function get_item( $id = '' )
    {
    	$data['coluna'] = '*,valores.id as id_valor';
    	$data['tabela'] = array(
                                array('nome' => 'valores'),
                            );
        
    	$data['filtro'] = 'valores.id = '.$id;
    	$retorno = $this->get_itens_($data);
    	return $retorno['itens'][0];
    }
    
    
    public function get_item_completo( $id = '' )
    {
    	$data['coluna'] = '
                            *,
                            valores.id as id_valor,
                            (SELECT count(usuarios.id_valor) FROM usuarios WHERE usuarios.id_valor = valores.id )as qtde,
                        ';
    	$data['tabela'] = array(
                                array('nome' => 'valores'),
                            );
        
    	$data['filtro'] = 'valores.id = '.$id;
    	$retorno = $this->get_itens_($data);
    	return $retorno['itens'][0];
    }
    
    public function get_select( $filtro = array() )
    {
    	$data['coluna'] = 'valores.id as id, valores.nome as descricao';
    	$data['tabela'] = array(
                                array('nome' => 'valores'),
                                );
    							
    	$data['filtro'] = $filtro;
    	$data['ordem'] = 'ASC';
    	$data['col'] = 'valores.nome';
    	$retorno = $this->get_itens_($data);
    	return $retorno['itens'];
    }
    
    public function get_total_itens ( $filtro = array() )
    {
        $data['coluna'] = '	
                            valores.id as id,
                            ';
    	$data['tabela'] = array(
                                array('nome' => 'valores'),
                                );
    	$data['filtro'] = $filtro;
        $data['group'] = 'id';
    	$retorno = $this->get_itens_($data);
    	
    	return $retorno['qtde'];
    }
    
    public function get_itens( $filtro = array(), $coluna = 'id', $ordem = 'DESC', $off_set = NULL )
    {
    	$data['coluna'] = '
                            valores.*,
                            (SELECT count(usuarios.id_valor) FROM usuarios WHERE usuarios.id_valor = valores.id )as qtde,
                            ';
    	$data['tabela'] = array(
                                array('nome' => 'valores'),
                                );
    	$data['filtro'] = $filtro;
    	if ( isset($off_set) )
    	{
    		$data['off_set'] = $off_set;
    	}
    	$data['col'] = $coluna;
    	$data['ordem'] = $ordem;
        $data['group'] = 'valores.id';
        //$data['group'] = 'usuarios.id';
    	$retorno = $this->get_itens_($data);
    	
    	return $retorno;
    }
    
}