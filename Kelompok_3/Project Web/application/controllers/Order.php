<?php
	class Order extends CI_Controller{
		public function index(){		
	        $user = $this->session->userdata('auth_user');
	        if(!$user){
	            redirect('home');
	        }
			$data['title'] = 'Konfirmasi Pesanan';
			$data['content'] = 'order';
			$data['cart'] = $this->session->userdata('cart');
			$this->load->view('template',$data);
		}
		public function checkout(){		
	        $user = $this->session->userdata('auth_user');
	        if(!$user){
	            redirect('home');
	        }		
			$data['title'] = 'Konfirmasi Pesanan';
			$data['content'] = 'checkout';
			$data['cart'] = $this->session->userdata('cart');
			$this->load->view('template',$data);
		}
		public function Cart(){
			$id_rute = $_POST['id_rute'];
			$jumlah = $_POST['jumlah'];
			$get = $this->m_general->gDataW('rute',array('id_rute'=>$id_rute))->row();
			$harga = $get->price*$jumlah;
			if(empty($this->session->userdata('cart'))){
				$this->session->set_userdata('cart',array());
			}
			$old = $this->session->userdata('cart');
			array_push($old, array('id_rute'=>$id_rute,'jumlah'=>$jumlah,'harga'=>$harga));
			$this->session->set_userdata('cart',$old);
			// print_r($this->session->userdata('cart'));
		}
		public function dCart(){
			$hackers =  $this->session->userdata('cart');
			$id_rute = $_POST['id_rute'];
			foreach($hackers as $key => $value){
				$search = $id_rute;
				if($value['id_rute']==$search){
					$old = $this->session->userdata('cart');
					unset($old[$key]);
					$this->session->set_userdata('cart',$old);
				}
			}
		}
		public function cekCart(){
			print_r($this->session->userdata('cart'));
			count($this->session->userdata('cart'));
		}
		public function cekPP(){
			$cek = count($this->session->userdata('cart'));
			if($cek>0){
				$result = 1;
			}else{
				$result = 0;
			}
			echo $result;
		}
		public function check_code($code,$harga){		
	        $user = $this->session->userdata('auth_user');
	        if(!$user){
	            redirect('home');
	        }
			$cek = $this->m_general->gDataW('promo_code',array('promo_code'=>$code));
			if($cek->num_rows()==0){
				$result = array('result'=>0);
			}else{
				$d = $cek->row();
	            if($d->promo_price!=0){
	                $total = $harga-$d->promo_price;
	            }elseif($d->promo_percentage!=0){
	                $total = $harga-($harga*$d->promo_percentage/100);
	            }else{
	                $total = $harga;
	            }
	            $min = rupiah($harga-$total);
				$result = array('result'=>1,'total'=>rupiah($total),'totall'=>$total,'code'=>$code,'min'=>$min);
			}
			echo json_encode($result);
		}
		public function tabelconfirm(){
			$cart = $this->session->userdata('cart');
			echo '
          <table class="oconfirm">
              <tbody>';
              foreach($cart as $c){
        	$i = $this->m_general->gRuteW($c['id_rute']);
                echo'<tr>
                <td width="80px">
                  <img style="width: 60px" src="'.site_url().'assets/images/company_logo/'.$i[0]->company_logo.'"></td>
                <td>'.$i[0]->company_name.'<br><span class="light">'.$i[0]->class_name.'</span>
                </td>
                  <td style="text-align:center">
                    <span class="t">'.stime($i[0]->depart_time).'</span>
                    <p>'.$i[0]->place_name_from.'</p>
                  </td>
                  <td style="text-align:center">
                    <i class="material-icons inline-text blue-text">arrow_forward</i>
                  </td>
                  <td style="text-align:center">
                    <span class="t">'.stime($i[0]->arrive_time).'</span>
                    <p>'.$i[0]->place_name_to.'</p>
                  </td>
                  <td>
                    <b class="blue-text">'.rupiah($i[0]->price).'</b>
                  </td>
                </tr>';
            	}
                echo'
              </tbody>
            </table>
            ';
		}
		public function pay(){		
	        $user = $this->session->userdata('auth_user');
	        if(!$user){
	            redirect('home');
	        }
			$order_time = date('H:i:s');
			$order_date = date('Y-m-d');
			if($this->session->userdata('auth_user')){
				$id_costumer = $this->session->userdata('auth_user');
			}else{
				$id_costumer = 0;
			}
			$payment_type = $_POST['method'];
			if($payment_type==2){
				$status = 'Terbayar';
			}else{
				$status = 'Tertunda';
			}
			$buyer_name = $_POST['buyer_name'];
			$buyer_email = $_POST['buyer_email'];
			$buyer_phone = $_POST['buyer_phone'];
			$promo_code = $_POST['promo_code'];
			$cek = $this->m_general->gDataW('promo_code',array('promo_code'=>$promo_code));
			$d = $cek->row();	
			$cart = $this->session->userdata('cart');
			$final_price = 0;
			$id_promo_code = 0;
    		$jml = 0;
			foreach($cart as $c){
      			$jml = $c['jumlah'];
				$q = $this->m_general->gDataW('rute',array('id_rute'=>$c['id_rute']))->row();		
				if($cek->num_rows()==0){
					$final_price = $final_price+$q->price;
					$id_promo_code = 0;
				}else{
		            if($d->promo_price!=0){
		                $final_price = $final_price+$q->price-$d->promo_price;
		            }elseif($d->promo_percentage!=0){
		                $final_price = $final_price+$q->price-($q->price*$d->promo_percentage/100);
		            }else{
		                $final_price = $final_price+$q->price;
		            }
		            $id_promo_code = $d->id_promo_code;
				}
			}
			$input = array('order_date'=>$order_date,'order_time'=>$order_time,'id_costumer'=>$id_costumer,'id_promo_code'=>$id_promo_code,'final_price'=>$final_price,'id_payment_type'=>$payment_type,'buyer_name'=>$buyer_name,'buyer_phone'=>$buyer_phone,'buyer_email'=>$buyer_email,'status'=>$status);
			$in = $this->m_general->iData('order',$input);

		    for ($i=1; $i <= $jml ; $i++) {
		    	
		    	$p_full_name = $_POST['p_full_name'.$i];

		    	$p_title = $_POST['p_title'.$i];

		    	$ticket_code = 'TG'.strtoupper(ranS(9,'all'));

		    	$this->m_general->iData('passenger',array('id_order'=>$in,'p_full_name'=>$p_full_name,'p_title'=>$p_title,'ticket_code'=>$ticket_code));
		    }

			foreach($cart as $c){
				$q = $this->m_general->gDataW('rute',array('id_rute'=>$c['id_rute']))->row();
				$reservation_code = ranS(10,'number');
				$in_res = $this->m_general->iData('reservation',array('id_rute'=>$c['id_rute'],'reservation_code'=>$reservation_code,'id_order'=>$in));
			}

			if($in){
				$result = array('result'=>1,'id_order'=>$in);
			}else{
				$result = array('result'=>0);
			}
			$this->session->set_userdata('cart',array());
			echo json_encode($result);

		}
		public function complete($id_order){		
	        $user = $this->session->userdata('auth_user');
	        if(!$user){
	            redirect('home');
	        }
			$data['o'] = $this->m_general->gOrder($id_order);
			$data['res'] = $this->m_general->gDataW('reservation',array('id_order'=>$id_order))->result();
			$data['title'] = 'Pemesanan Sukses';
			$data['content'] = 'checkout_success';
			$this->load->view('template',$data);

		}
	}