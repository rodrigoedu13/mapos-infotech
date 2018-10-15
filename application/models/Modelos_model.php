<?php

class Modelos_model extends CI_Model {

    /**
     * author: Ramon Silva 
     * email: silva018-mg@yahoo.com.br
     * 
     */
    function __construct() {
        parent::__construct();
    }

    function getModelos() {
        $this->db->select('modelos.idModelos, modelos.modelos, modelos.cadastro, modelos.situacao, marcas.marca');
        //$this->db->order_by('idModelos', 'desc');
        $this->db->join('marcas','marcas.idMarcas = modelos.marcas_id');
        $query = $this->db->get('modelos');
        return $query->result();
    }

    function getById($id) {
        $this->db->select('modelos.idModelos, modelos.modelos, modelos.cadastro, modelos.situacao, marcas.marca, marcas.idMarcas, modelos.marcas_id');
        $this->db->where('idModelos', $id);
        $this->db->join('marcas','marcas.idMarcas = modelos.marcas_id');
        $this->db->limit(1);
        return $this->db->get('modelos')->row();
    }

    function add($table, $data) {
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }

        return FALSE;
    }

    function edit($table, $data, $fieldID, $ID) {
        $this->db->where($fieldID, $ID);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        }

        return FALSE;
    }

    function delete($table, $fieldID, $ID) {
        $this->db->where($fieldID, $ID);
        $this->db->delete($table);
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }

        return FALSE;
    }
    
    function getModelosOs($id){
        $this->db->where('modelos_id',$id);
        return $this->db->get('os')->row();
    }

    function getModelosbyMarcas($id){
        $this->db->where('marcas_id',$id);
        $this->db->where('situacao',0);
        $this->db->order_by('modelos');
        $query = $this->db->get('modelos');
        return $query;
    }

}
