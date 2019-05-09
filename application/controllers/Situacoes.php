<?php

class Situacoes extends CI_Controller {

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
        $this->load->model('situacoes_model', '', TRUE);
        $this->data['menuSituacoes'] = 'Situacoes';
        $this->data['menuCadastros'] = 'Cadastros';
    }

    function index() {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar produtos.');
            redirect(base_url());
        }
        $this->data['results'] = $this->situacoes_model->getSituacoes();
        $this->data['view'] = 'situacoes/situacoes';
        $this->load->view('tema/topo', $this->data);

    }


    function adicionar() {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar produtos.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('situacoes') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'idSituacao' => set_value('situacao'),
                'cor' => set_value('cor'),
                'ativo' => 0,
            );

            if ($this->situacoes_model->add('situacoes', $data) == TRUE) {
                $this->session->set_flashdata('success', 'Situação cadastrada com sucesso!');
                redirect(base_url() . 'index.php/situacoes/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
            }
        }
        $this->data['view'] = 'situacoes/adicionarSituacao';
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

        if ($this->form_validation->run('marcas') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $marca = $this->input->post('marca');
            $situacao = $this->input->post('situacao');
            $data = array(
                'marca' => $this->input->post('marca'),
                'situacao' => $this->input->post('situacao')
            );

            if ($this->marcas_model->edit('marcas', $data, 'idMarcas', $this->input->post('idMarcas')) == TRUE) {
                $this->session->set_flashdata('success', 'Marca editada com sucesso!');
                redirect(base_url() . 'index.php/marcas/editar/' . $this->input->post('idMarcas'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured</p></div>';
            }
        }

        $this->data['result'] = $this->marcas_model->getById($this->uri->segment(3));

        $this->data['view'] = 'marcas/editarMarca';
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
            redirect(base_url() . 'index.php/situacoes');
        }

        if ($this->situacoes_model->getSituacaoOs($id) == TRUE) {
            $this->session->set_flashdata('error', 'Essa Situação esta cadastrada em uma Os, não é possivel excluir!');
            redirect(base_url() . 'index.php/situacoes');
        } else {
            $this->situacoes_model->delete('situacoes', 'idSituacao', $id);
            $this->session->set_flashdata('success', 'Situação excluida com sucesso!');
            redirect(base_url() . 'index.php/situacoes');
        }
    }

}
