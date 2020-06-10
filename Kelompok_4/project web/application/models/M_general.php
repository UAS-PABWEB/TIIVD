<?php
class M_General extends CI_Model{
	
	public function gDataA($table){
		return $this->db->get($table);
	}
	public function gDataW($table,$where){
		return $this->db->select()->from($table)->where($where)->get();
	}
	public function gDataL($table,$limit){
		$query = $this->db->limit($limit)->get($table);
		return $query;
	}
	public function iData($table,$value){
		 $this->db->insert($table,$value);
		 return $this->db->insert_id();
	}
	public function gDataLi($table,$column,$keyword){
		$this->db->like($column, $keyword);
		$query = $this->db->get($table);
		return $query;
	}
	public function gDataJ($table,$ref,$column){
		$this->db->join($ref,''.$ref.'.'.$column.'='.$table.'.'.$column.'');
		$query = $this->db->get($table);
        return $query;
	}
	public function gDataJW($table,$ref,$column,$where,$desc_order=''){
		if($desc_order!=''){
			$this->db->order_by($desc_order,'desc');
		}
		$this->db->where($where);
		$this->db->join($ref,''.$ref.'.'.$column.'='.$table.'.'.$column.'');
		$query = $this->db->get($table);
        return $query;
	}
	public function uData($table,$value,$where){
		return $this->db->update($table,$value,$where);
	}
	public function dData($table,$where){
		return $this->db->delete($table,$where);
	}
    public function login($username,$password){
		$get = $this->db->select()->from('user')->where(array('username'=>$username,'password'=>$password))->get()->num_rows();
		if($get==0){
			return false;
		}else{
			return true;
		}
    }
    public function info($id){
    	$get = $this->db->get_where('user',array('id_user'=>$id));
    	return $get->row();
    }
	public function gPesanan($id_pesanan){
		$this->db->where('id_pesanan',$id_pesanan);
		$this->db->join('user','user.id_user = pesanan.id_user');
		$this->db->join('apartemen','apartemen.id_apartemen = pesanan.id_apartemen');
		$this->db->join('kota','kota.id_kota = apartemen.id_kota');
		$query = $this->db->get('pesanan');
        return $query;
	}
	public function gListPesanan($desc_order){
		if($desc_order!=''){
			$this->db->order_by($desc_order,'desc');
		}
		$this->db->join('user','user.id_user = pesanan.id_user');
		$this->db->join('apartemen','apartemen.id_apartemen = pesanan.id_apartemen');
		$this->db->join('kota','kota.id_kota = apartemen.id_kota');
		$query = $this->db->get('pesanan');
        return $query;
	}


}