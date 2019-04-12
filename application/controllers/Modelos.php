<?php

class Modelos extends CI_Controller {

    /**
     * author: Ramon Silva 
     * email: silva018-mg@yahoo.com.br
     * 
     */
    function __construct() {
        parent::__construct();
        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('mapos/login');
        }

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('modelos_model', '', TRUE);
        $this->data['menuModelos'] = 'Modelos';
        $this->data['menuCadastros'] = 'Cadastros';
        
    }

    function index() {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar produtos.');
            redirect(base_url());
        }
        $this->data['results'] = $this->modelos_model->getModelos();
        $this->data['view'] = 'modelos/modelos';
        $this->load->view('tema/topo', $this->data);

    }


    function adicionar() {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar produtos.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        
        $this->load->model('marcas_model');
        $this->data['marcas'] = $this->marcas_model->getMarcasDropdown();

        if ($this->form_validation->run('modelos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $dthora = date('Y-m-d H:i:s');
            $situacao = 0;
            $data = array(
                'modelos' => set_value('modelo'),
                'marcas_id' => set_value('marca'),
                'cadastro' => $dthora,
                'situacao' => $situacao,
            );

            if ($this->modelos_model->add('modelos', $data) == TRUE) {
                $this->session->set_flashdata('success', 'Modelo cadastrado com sucesso!');
                redirect(base_url() . 'index.php/modelos/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
            }
        }
        $this->data['view'] = 'modelos/adicionarModelo';
        $this->load->view('tema/topo', $this->data);
    }

    function editar() {

        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar produtos.');
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        
        $this->load->model('marcas_model');
        $this->data['marcas'] = $this->marcas_model->getMarcasDropdown();
        
        if ($this->form_validation->run('modelos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'marcas_id' => $this->input->post('marca'),
                'modelos' => $this->input->post('modelo'),
                'situacao' => $this->input->post('situacao')
            );

            if ($this->marcas_model->edit('modelos', $data, 'idModelos', $this->input->post('idModelos')) == TRUE) {
                $this->session->set_flashdata('success', 'Modelo editado com sucesso!');
                redirect(base_url() . 'index.php/modelos/editar/' . $this->input->post('idModelos'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured</p></div>';
            }
        }

        $this->data['result'] = $this->modelos_model->getById($this->uri->segment(3));

        $this->data['view'] = 'modelos/editarModelo';
        $this->load->view('tema/topo', $this->data);
    }

    function excluir() {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'dProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir produtos.');
            redirect(base_url());
        }


        $id = $this->input->post('id');
        if ($id == null) {

            $this->session->set_flashdata('error', 'Erro ao tentar excluir produto.');
            redirect(base_url() . 'index.php/modelos');
        }

        if ($this->modelos_model->getModelosOs($id) == TRUE) {
            $this->session->set_flashdata('error', 'Esse modelo esta cadastrado em uma Os, não é possivel excluir!');
            redirect(base_url() . 'index.php/modelos');
        } else {
            $this->modelos_model->delete('modelos', 'idModelos', $id);
            $this->session->set_flashdata('success', 'Modelo excluida com sucesso!');
            redirect(base_url() . 'index.php/modelos');
        }
    }

}
