<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Classe que gerencia o login no sistema, com verificação de status e hierarquia.
 * @access public
 * @version 0.1
 * @author Carlos Claro
 * @package Login
 * 
 */
class Painel extends MY_Controller
{

    public function __construct()
    {
        parent::__construct(FALSE);
        $this->load->model('estatisticas_model');
        set_time_limit(0);
        $this->load->library('twitterlib');
        $user = $this->config->item('user');
        $consumer_secret = $this->config->item('consumer_secret');
        $access_token = $this->config->item('access_token');
        $access_token_secret = $this->config->item('access_token_secret');
        $this->twitteroauth->create($user, $consumer_secret, $access_token, $access_token_secret);
    }

    /**
     * Função de entrada no sistema.
     * Variavel $data é passada para a view com os dados:
     * [itens] = Todos os itens encontrados na hora da atualização.
     * 
     * 
     * @param String $coluna - Responsável pela ordenação dos itens listados
     * @param String $ordem - Repsonsável pela ordem da listagem
     * @param Int $off_set - Responsável pela paginação
     */
    public function index($coluna = 'estatisticas.id', $ordem = 'DESC', $off_set = 0)
    {
//        $off_set = ( (isset($_GET['per_page'])) ? $_GET['per_page'] : 0 );
//        $classe = strtolower(__CLASS__);
//        $function = strtolower(__FUNCTION__);
//        $url = base_url() . $classe . '/' . $function . '/' . ($coluna) . '/' . $ordem . '/' . $off_set;
//        $valores = ( isset($_GET['b']) ? $_GET['b'] : array() );
//        $filtro = $this->_inicia_filtros($url, $valores);
//        $filter = $filtro->get_filtro();
//        $itens = $this->usuarios_model->get_itens($filter, $coluna, $ordem, $off_set);
//        $total = $this->usuarios_model->get_total_itens($filter);
//        $get_url = $filtro->get_url();
//        $url = $url . ( (empty($get_url) ) ? '?' : ($get_url) );
//        $data['paginacao'] = $this->init_paginacao($total, $url);
//        $data['filtro'] = $filtro->get_html();
//        $extras['url'] = base_url() . $classe . '/' . $function . '/[col]/[ordem]/' . $off_set . '/' . $filtro->get_url();
//        $extras['col'] = $coluna;
//        $extras['ordem'] = $ordem;
//        $extras['total_itens'] = $total;
//        $data['listagem'] = $this->_inicia_listagem($itens, $extras);
//        $this->layout
//                ->set_classe($classe)
//                ->set_function($function)
//                ->set_titulo('Listagem de usuários')
//                ->set_include('js/listar.js', TRUE)
//                ->set_breadscrumbs('Usuarios', 'usuarios', 0)
//                ->set_breadscrumbs('Listar', 'usuarios/listar', 1)
//                ->set_usuario()
//                ->set_menu($this->get_menu($classe, $function))
//                ->view('listar', $data);
        $data['itens'] = array();
        $this->layout
                ->set_titulo('Inicio')
                ->set_keywords('')
                ->set_description('')
                ->set_include('metronic/layouts/layout2/css/login-2.min.css', TRUE)
                ->set_include('js/login.js', TRUE)
                ->set_include('css/estilo.css', TRUE)
                ->view('painel', $data);
    }

    /**
     * cria a lista de contatos_site no estilo normal,
     * chama os campos necessarios para criar a cabeçalho e define id como chave
     * @param array $itens
     * @param array $extras
     * @param bool $exportar - se falso cabeçalho fica vazio
     * @return array $retorno - instancia com a classe listagem_etiqueta
     * @version 1.0
     * @access private
     */
    private function _inicia_listagem($itens, $extras = NULL, $exportar = FALSE)
    {
        if ($exportar)
        {
            $cabecalho = ' ';
        } else
        {
            $data['cabecalho'] = array(
                (object) array('chave' => 'id', 'titulo' => 'ID', 'link' => str_replace(array('[col]', '[ordem]'), array('id', ( ($extras['ordem'] == 'ASC' && $extras['col'] == 'id') ? 'DESC' : 'ASC' )), $extras['url']), 'class' => ( ($extras['col'] == 'id' ) ? 'ui-state-highlight' . ( ($extras['col'] == 'id' && $extras['ordem'] == 'ASC') ? ' ui-icon-caract-1-n' : ' ui-icon-caract-1-s' ) : 'ui-state-disabled ui-icon-caract-1-s' )),
                (object) array('chave' => 'nome', 'titulo' => 'Nome', 'link' => str_replace(array('[col]', '[ordem]'), array('nome', ( ($extras['ordem'] == 'ASC' && $extras['col'] == 'nome') ? 'DESC' : 'ASC' )), $extras['url']), 'class' => ( ($extras['col'] == 'nome' ) ? 'ui-state-highlight' . ( ($extras['col'] == 'nome' && $extras['ordem'] == 'ASC') ? ' ui-icon-caract-1-n' : ' ui-icon-caract-1-s' ) : 'ui-state-disabled ui-icon-caract-1-s' )),
                (object) array('chave' => 'telefone', 'titulo' => 'Telefone', 'link' => str_replace(array('[col]', '[ordem]'), array('nome', ( ($extras['ordem'] == 'ASC' && $extras['col'] == 'nome') ? 'DESC' : 'ASC' )), $extras['url']), 'class' => ( ($extras['col'] == 'nome' ) ? 'ui-state-highlight' . ( ($extras['col'] == 'nome' && $extras['ordem'] == 'ASC') ? ' ui-icon-caract-1-n' : ' ui-icon-caract-1-s' ) : 'ui-state-disabled ui-icon-caract-1-s' )),
                (object) array('chave' => 'celular', 'titulo' => 'Celular', 'link' => str_replace(array('[col]', '[ordem]'), array('nome', ( ($extras['ordem'] == 'ASC' && $extras['col'] == 'nome') ? 'DESC' : 'ASC' )), $extras['url']), 'class' => ( ($extras['col'] == 'nome' ) ? 'ui-state-highlight' . ( ($extras['col'] == 'nome' && $extras['ordem'] == 'ASC') ? ' ui-icon-caract-1-n' : ' ui-icon-caract-1-s' ) : 'ui-state-disabled ui-icon-caract-1-s' )),
                (object) array('chave' => 'email', 'titulo' => 'Email', 'link' => str_replace(array('[col]', '[ordem]'), array('nome', ( ($extras['ordem'] == 'ASC' && $extras['col'] == 'nome') ? 'DESC' : 'ASC' )), $extras['url']), 'class' => ( ($extras['col'] == 'nome' ) ? 'ui-state-highlight' . ( ($extras['col'] == 'nome' && $extras['ordem'] == 'ASC') ? ' ui-icon-caract-1-n' : ' ui-icon-caract-1-s' ) : 'ui-state-disabled ui-icon-caract-1-s' )),
            );

            $data['operacoes'] = array(
                (object) array('titulo' => 'Editar', 'class' => 'btn btn-primary font-white', 'icone' => '<span class="fa fa-pencil"></span>', 'link' => 'usuarios/editar/[id]'),
            );

            $data['chave'] = 'id';
            $data['itens'] = $itens['itens'];
            $data['extras'] = $extras;
            $this->listagem->inicia($data);
            $retorno = $this->listagem->get_html();
        }
        return $retorno;
    }

    /**
     * Cria um filtro por email, local_origem e nome para a listagem normal de contatos_site
     * cria os botões de exportar e adicionar
     * @param string $url
     * @param array $valores
     * @return array $retorno - instancia com a classe filtro
     * @version 1.0
     * @access private
     */
    private function _inicia_filtros($url = '', $valores = array())
    {
        $config['itens'] = array(
            array('name' => 'id', 'titulo' => 'Id: ', 'tipo' => 'text', 'valor' => '', 'classe' => 'form-control', 'where' => array('tipo' => 'like', 'campo' => 'id', 'valor' => '')),
            array('name' => 'nome', 'titulo' => 'Nome: ', 'tipo' => 'text', 'valor' => '', 'classe' => 'form-control', 'where' => array('tipo' => 'like', 'campo' => 'nome', 'valor' => '')),
            array('name' => 'email', 'titulo' => 'Email: ', 'tipo' => 'text', 'valor' => '', 'classe' => 'form-control', 'where' => array('tipo' => 'like', 'campo' => 'email', 'valor' => '')),
            array('name' => 'Telefone', 'titulo' => 'Telefone: ', 'tipo' => 'text', 'valor' => '', 'classe' => 'form-control', 'where' => array('tipo' => 'like', 'campo' => 'telefone', 'valor' => '')),
            array('name' => 'tipo', 'titulo' => 'tipo: ', 'tipo' => 'select', 'valor' => $this->_get_tipo_usuario(), 'classe' => 'form-control', 'where' => array('tipo' => 'where', 'campo' => 'tipo', 'valor' => '')),
        );

        $config['colunas'] = 4;
        $config['extras'] = '';
        $config['url'] = $url;
        $config['valores'] = $valores;
        $config['botoes'] = ' <a href="' . base_url() . strtolower(__CLASS__) . '/exportar[filtro]' . '" class="btn btn-default">Exportar</a>';
        $config['botoes'] .= ' <a href="' . base_url() . strtolower(__CLASS__) . '/editar' . '" class="btn btn-primary">Add Novo</a>';
        $filtro = $this->filtro->inicia($config);
        return $filtro;
    }
    public function stream()
    {
        $this->twitterlib->stream();
    }

    // search for tweets by hashtag
    public function search($cachetime=null)
    {
        $this->twitterlib->search($cachetime);
    }

    // search for tweets by hashtag using api v1.1
    public function searchone($cachetime=null)
    {
      $this->twitterlib->searchone($cachetime);
    }
}
