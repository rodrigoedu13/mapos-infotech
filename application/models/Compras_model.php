<?php
class Compras_model extends CI_Model {

    /**
     * author: Ramon Silva 
     * email: silva018-mg@yahoo.com.br
     * 
     */
    
    function __construct() {
        parent::__construct();
    }

    
    function get($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->order_by('idClientes','desc');
        $this->db->limit($perpage,$start);
        if($where){
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
    
    function getCompras(){
        $this->db->order_by('idCompra', 'desc');
        $this->db->join('fornecedores','fornecedores.idFornecedor = compras.fornecedor_id');
        $query = $this->db->get('compras');
        return $query->result();
    }

    function getById($id){
        $this->db->where('idCompra',$id);
        $this->db->join('fornecedores','fornecedores.idFornecedor = compras.fornecedor_id');
        $this->db->limit(1);
        return $this->db->get('compras')->row();
    }
    
    function add($table,$data){
        $this->db->insert($table, $data);         
        if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;       
    }
    
    function edit($table,$data,$fieldID,$ID){
        $this->db->where($fieldID,$ID);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() >= 0)
		{
			return TRUE;
		}
		
		return FALSE;       
    }
    
    function delete($table,$fieldID,$ID){
        $this->db->where($fieldID,$ID);
        $this->db->delete($table);
        if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;        
    }

    function count($table) {
        return $this->db->count_all($table);
    }
    
    public function getProdutos($id = null){
        
        $this->db->select('produtos_compras.*, produtos.*');
        $this->db->from('produtos_compras');
        $this->db->join('produtos','produtos.idProdutos = produtos_compras.produtos_id');
        $this->db->where('compras_id',$id);
        return $this->db->get()->result();
    }

}