<?php

class Equipamentos extends CI_Controller {

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
        $this->load->model('equipamentos_model', '', TRUE);
        $this->data['menuEquipamentos'] = 'Equipamentos';
        $this->data['menuCadastros'] = 'cadastros';
    }

    function index() {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar produtos.');
            redirect(base_url());
        }
        $this->data['results'] = $this->equipamentos_model->getEquipamentos();
        $this->data['view'] = 'equipamentos/equipamentos';
        $this->load->view('tema/topo', $this->data);

    }

    function adicionar() {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar produtos.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('equipamentos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $dthora = date('Y-m-d H:i:s');
            $situacao = 0;
            $data = array(
                'equipamento' => set_value('equipamento'),
                'cadastro' => $dthora,
                'situacao' => $situacao,
            );

            if ($this->equipamentos_model->add('equipamentos', $data) == TRUE) {
                $this->session->set_flashdata('success', 'Marca cadastrada com sucesso!');
                redirect(base_url() . 'index.php/equipamentos/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
            }
        }
        $this->data['view'] = 'equipamentos/adicionarEquipamento';
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

        if ($this->form_validation->run('equipamentos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'equipamento' => $this->input->post('equipamento'),
                'situacao' => $this->input->post('situacao')
            );

            if ($this->equipamentos_model->edit('equipamentos', $data, 'idEquipamentos', $this->input->post('idEquipamentos')) == TRUE) {
                $this->session->set_flashdata('success', 'Equipamento editado com sucesso!');
                redirect(base_url() . 'index.php/equipamentos/editar/' . $this->input->post('idEquipamentos'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured</p></div>';
            }
        }

        $this->data['result'] = $this->equipamentos_model->getById($this->uri->segment(3));

        $this->data['view'] = 'equipamentos/editarEquipamento';
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
            redirect(base_url() . 'index.php/equipamentos');
        }

        if ($this->equipamentos_model->getEquipamentosOs($id) == TRUE) {
            $this->session->set_flashdata('error', 'Esse equipamentos já esta cadastrado em uma Os, não é possivel excluir!');
            redirect(base_url() . 'index.php/equipamentos');
        } else {
            $this->equipamentos_model->delete('equipamentos', 'idEquipamentos', $id);
            $this->session->set_flashdata('success', 'Equipamento excluido com sucesso!');
            redirect(base_url() . 'index.php/equipamentos');
        }
    }

}
