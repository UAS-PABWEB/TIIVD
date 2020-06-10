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
	}
	public function uData($table,$value,$where){
		return $this->db->update($table,$value,$where);
	}
	public function dData($table,$where){
		return $this->db->delete($table,$where);
	}
	public function auth_login($username,$password){
		$get = $this->db->select()->from('user')->where(array('username'=>$username,'password'=>$password,'level_id'=>2))->get()->num_rows();
		if($get==0){
			return false;
		}else{
			return true;
		}
	}
	public function auth_login_admin($username,$password){
		$get = $this->db->select()->from('user')->where(array('username'=>$username,'password'=>$password,'level_id'=>1))->get()->num_rows();
		if($get==0){
			return false;
		}else{
			return true;
		}
	}
	
	public function gIDCostumer($email){
		return $this->db->get_where('costumer',array('email'=>$email))->row()->id_costumer;
	}
	public function gIDUser($email){
		return $this->db->get_where('costumer',array('email'=>$email))->row()->id_user;
	}
	public function usrInfo($id_costumer){
		$this->db->where('costumer.id_costumer',$id_costumer);
		$this->db->join('user','user.id_user=costumer.id_user');
		$query = $this->db->get('costumer');
		return $query->row();
	}
	public function gCostumer(){
		$this->db->join('user','user.id_user=costumer.id_user');
		$query = $this->db->get('costumer');
		return $query->result();
	}
	public function gPlaceW($where){
		$this->db->where($where);
		$this->db->join('city','city.id_city = place.id_city');
		$this->db->join('transportation_type','transportation_type.id_transportation_type = place.id_transportation_type');
		$query = $this->db->get('place');
		return $query;
	}
	public function searchFlight($date_g,$from,$to,$class){
		$this->db->where('rute.id_transportation_type',1);
		if(!empty($class)){
			$this->db->where('transportation.id_transportation_class',$class);	
		}
		$this->db->where('depart_at',$date_g);
		$this->db->where('id_place_from',$from);
		$this->db->where('id_place_to',$to);
		$this->db->join('transportation','transportation.id_transportation=rute.id_transportation');
		$this->db->join('transportation_class','transportation_class.id_transportation_class=transportation.id_transportation_class');
		$this->db->join('transportation_company','transportation_company.id_transportation_company=transportation.id_transportation_company');
		$query = $this->db->get('rute')->result();
		$x=0;
		foreach($query as $d){
			$p_from = $this->gPlaceW(array('id_place'=>$from))->row();
			$p_to = $this->gPlaceW(array('id_place'=>$to))->row();
			$query[$x]->place_name_from = $p_from->city_name.' ('.$p_from->place_code.')';
			$query[$x]->place_name_to = $p_to->city_name.' ('.$p_to->place_code.')';
			$x++;
		}
		return $query;
	}
	public function searchTrain($date_g,$from,$to,$class){
		$this->db->where('rute.id_transportation_type',2);
		if(!empty($class)){
			$this->db->where('transportation.id_transportation_class',$class);	
		}
		$this->db->where('depart_at',$date_g);
		$this->db->where('id_place_from',$from);
		$this->db->where('id_place_to',$to);
		$this->db->join('transportation','transportation.id_transportation=rute.id_transportation');
		$this->db->join('transportation_class','transportation_class.id_transportation_class=transportation.id_transportation_class');
		$this->db->join('transportation_company','transportation_company.id_transportation_company=transportation.id_transportation_company');
		$query = $this->db->get('rute')->result();
		$x=0;
		foreach($query as $d){
			$p_from = $this->gPlaceW(array('id_place'=>$from))->row();
			$p_to = $this->gPlaceW(array('id_place'=>$to))->row();
			$query[$x]->place_name_from = $p_from->city_name.' ('.$p_from->place_code.')';
			$query[$x]->place_name_to = $p_to->city_name.' ('.$p_to->place_code.')';
			$x++;
		}
		return $query;
	}
	public function gRuteW($id_rute){
		$this->db->where('id_rute',$id_rute);
		$this->db->join('transportation','transportation.id_transportation=rute.id_transportation');
		$this->db->join('transportation_class','transportation_class.id_transportation_class=transportation.id_transportation_class');
		$this->db->join('transportation_company','transportation_company.id_transportation_company=transportation.id_transportation_company');
		$query = $this->db->get('rute')->result();
		$x=0;
		foreach($query as $d){
			$p_from = $this->gPlaceW(array('id_place'=>$d->id_place_from))->row();
			$p_to = $this->gPlaceW(array('id_place'=>$d->id_place_to))->row();
			$query[$x]->place_name_from = $p_from->city_name.' ('.$p_from->place_code.')';
			$query[$x]->place_name_to = $p_to->city_name.' ('.$p_to->place_code.')';
			$query[$x]->p_name_from = $p_to->place_name;
			$query[$x]->p_name_to = $p_from->place_name;
			$x++;
		}
		return $query;
	}

	public function gOrder($id_order){
		$this->db->where('id_order',$id_order);
		$this->db->join('payment_type','payment_type.id_payment_type=order.id_payment_type');
		$query = $this->db->get('order');
		return $query->row();
	}

	public function gOrderA(){
		$this->db->join('payment_type','payment_type.id_payment_type=order.id_payment_type');
		$query = $this->db->get('order')->result();
		$x=0;
		foreach($query as $d){
			if($d->status=='Terbayar'){
				$color = "green";
			}elseif($d->status=='Tertunda'){
				$color = "orange";
			}elseif($d->status=='Batal'){
				$color = "red";
			}
			$query[$x]->time = tgl_indo($d->order_date).' '.stime($d->order_time);
			$query[$x]->price = rupiah($d->final_price);
			$query[$x]->pay_status = '<span class="label-flat '.$color.'">'.$d->status.'</span>';
			$x++;
		}
		return $query;
	}
	public function gOrderW($where){
		$this->db->where($where);
		$this->db->join('payment_type','payment_type.id_payment_type=order.id_payment_type');
		$query = $this->db->get('order')->result();
		$x=0;
		foreach($query as $d){
			if($d->status=='Terbayar'){
				$color = "green";
			}elseif($d->status=='Tertunda'){
				$color = "orange";
			}elseif($d->status=='Batal'){
				$color = "red";
			}
			$query[$x]->time = tgl_indo($d->order_date).' '.stime($d->order_time);
			$query[$x]->price = rupiah($d->final_price);
			$query[$x]->pay_status = '<span class="label-flat '.$color.'">'.$d->status.'</span>';
			$x++;
		}
		return $query;
	}
	public function gOrderDate($start,$end){
		$this->db->where('order_date >=',$start);
		$this->db->where('order_date <=',$end);
		$this->db->join('payment_type','payment_type.id_payment_type=order.id_payment_type');
		$query = $this->db->get('order')->result();
		$x=0;
		foreach($query as $d){
			if($d->status=='Terbayar'){
				$color = "green";
			}elseif($d->status=='Tertunda'){
				$color = "orange";
			}elseif($d->status=='Batal'){
				$color = "red";
			}
			$query[$x]->time = tgl_indo($d->order_date).' '.stime($d->order_time);
			$query[$x]->price = rupiah($d->final_price);
			$query[$x]->pay_status = '<span class="label-flat '.$color.'">'.$d->status.'</span>';
			$x++;
		}
		return $query;
	}
	public function gOrderC(){
		$this->db->join('order','order.id_order=order_cancel.id_order');
		$this->db->join('payment_type','payment_type.id_payment_type=order.id_payment_type');
		$query = $this->db->get('order_cancel')->result();
		$x=0;
		foreach($query as $d){
			if($d->status=='Terbayar'){
				$color = "green";
			}elseif($d->status=='Tertunda'){
				$color = "orange";
			}elseif($d->status=='Batal'){
				$color = "red";
			}
			$query[$x]->time = tgl_indo($d->order_date).' '.stime($d->order_time);
			$query[$x]->price = rupiah($d->final_price);
			$query[$x]->pay_status = '<span class="label-flat '.$color.'">'.$d->status.'</span>';
			$x++;
		}
		return $query;
	}

	public function gReservation(){
		$this->db->join('rute','rute.id_rute=reservation.id_rute');
		$query = $this->db->get('reservation');
		return $query;
	}
	public function gReservationW($where){
		$this->db->where($where);
		$this->db->join('rute','rute.id_rute=reservation.id_rute');
		$query = $this->db->get('reservation');
		return $query;
	}

}