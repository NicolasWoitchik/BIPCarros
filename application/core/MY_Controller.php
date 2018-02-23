<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MY_Controller extende CI_Controller para usar suas libraries
 * @access public
 * @version 1.0
 * @author 
 * @package MY_Controller
 */
class MY_Controller extends CI_Controller 
{
    /**
     * @access public
     * @var null sessao 
     */
    public $sessao = NULL;
    
    /**
     * valida_login, grava_log quando true
     * carrega library necessarias para o sistema 
     * gravação de log quando necessario
     * carrega model necessario para o sistema  
     * gravação de log quando necessario
     * requisita conexão com banco de dados
     *  
     * @param boolean $verifica_login
     * @param boolean $log 
     * @version 1.0
     * @access public
     * @author pow internet carlos claro
     */
    public function __construct( $verifica_login = TRUE, $log = FALSE, $db = 'tep' ) 	
    {		
        parent::__construct();		
        $this->load->library('layout');		
        $this->load->library('listagem');		
        $this->load->library('pagination');		
//        $this->load->library('menu');
//        $this->load->model(array('usuario_model'));
        date_default_timezone_set('America/Sao_Paulo');
        if ( isset($_GET['debug']) )
            {
                error_reporting(-1);
		ini_set('display_errors', 1);
            }
    }	
    
    /**
     * iniciação da paginação
     * criando um array para inicializar a paginação
     * @param int $total_itens 
     * @param string $url base da url
     * @return string - link da paginação
     * @version 1.0
     * @access public
     * 
     */
    public function init_paginacao($total_itens = 0, $url) 
    {
        $config = array(			
            'page_query_string'         => TRUE,			
            'base_url' 			=> $url,			
            'total_rows' 		=> $total_itens,			
            'per_page' 			=> N_ITENS,			
            'next_link'			=> '<span class="btn btn-primary glyphicon glyphicon-forward"></span>',			
            'prev_link'			=> '<span class="btn btn-primary glyphicon glyphicon-backward"></span>',
            'use_page_numbers'          => FALSE,			
            'num_tag_open'		=> '<span class="btn btn-primary" >',			
            'num_tag_close'		=> '</span>',
            'cur_tag_open'              => '<span class="btn btn-info">',
            'cur_tag_close'             => '</span>'
            );
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }
}
