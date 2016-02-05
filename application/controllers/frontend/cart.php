<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/application.php");

class Cart extends Application {

	public $data;
	public function __construct(){
        parent::__construct();
        $this->load->library("cart");           
    }

	public function index()
	{
		$this->data['title']	= 'Trang giỏ hàng';
		if ($this->input->post(NULL, TRUE)) {
			$postdata   = $this->input->post(NULL, TRUE);

			if (is_array($postdata['cart']) && !empty($postdata['cart'])) {
				foreach ($postdata['cart'] as $key => $value) {
					$listcart = $this->cart->contents();
					foreach ($listcart as $item) {
						$max_qty = $item['option']['max-qty'];
						if ($item['id'] == $key && $item['rowid'] == $value['rowid']) {
							/*Add New with same Item*/
							$item_new                    = $item;
							$item_new['qty']             = $value['qty'];
							$item_new['qty']             = $item_new['qty'] > 5 ? ($max_qty > 5 ? 5 : $max_qty) : ($item_new['qty'] > $max_qty ? $max_qty : $item_new['qty']);
							$item_new['option']['color'] = $value['color'];
							$item_new['option']['size']  = $value['size'];
							$this->cart->insert($item_new);
							/*Delete Item*/
							/*$delOne = $delOne = array("rowid" => $item['rowid'], "qty" => 0);
							$this->cart->update($delOne);*/
						}
					}
				}
			}

		}
		/*Get items in cart*/
		$this->data['list_item']=$this->cart->contents();

		if ($this->input->get('p')) {
			$this->data['show_button'] = FALSE;
			$this->load->view('frontend/cart/index', $this->data);
		}
		else {
			$this->data['template'] = 'frontend/cart/index';
			$this->load->view('frontend/layout', $this->data);
		}
	}

	public function addItem()
	{
		$isPost = TRUE;
		if ($this->input->post(NULL, TRUE) || $this->input->get(NULL, TRUE)) {
			if ($this->input->get(NULL, TRUE)) {
				$isPost = FALSE;
			}
			$addItem   = $this->input->post(NULL, TRUE) ? $this->input->post(NULL, TRUE) : $this->input->get(NULL, TRUE);
			$this->load->model('Mproduct');
			$detailItem= $this->Mproduct->getItem($addItem['item_id']);

			if($detailItem) {
				$max_qty = $detailItem[0]['amount'];
				$list_item = $this->cart->contents();
				$checkAdd  = TRUE;
				foreach ($list_item as $item) {
					if ($item['id'] == $addItem['item_id']) {
						$item['qty'] += $addItem['qty'];
						$item['qty'] = $item['qty'] > 5 ? ($max_qty > 5 ? 5 : $max_qty) : ($item['qty'] > $max_qty ? $max_qty : $item['qty']);
						$this->cart->update($item);
						$checkAdd = FALSE;
						break;
					}
				}

				$ajax = new AjaxResponse();

				if ($checkAdd) {
					$error = FALSE;
					if (!isset($addItem['qty']) || !$addItem['qty']) {
						$error = TRUE;
					}
					if (!isset($addItem['size']) || !$addItem['size']) {
						$error = TRUE;
					}
					if (!isset($addItem['color']) || !$addItem['color']) {
						$error = TRUE;
					}

					if (!$error) {
						$i_img        = '';
						$deal_percent = round(100*$detailItem[0]['deal']/$detailItem[0]['buy_price']);
						$a_img        = explode('|', $detailItem[0]['images']);
						foreach ($a_img as $img) {
							if ($img) {
								$i     = pathinfo($img);
								$i_img = base_url('public/uploads/products/'.$i['dirname'].'/110x110-'.$i['filename'].'_thumb.'.$i['extension']);
								break;
							}
						}
						$data = array(
							'id'     => $addItem['item_id'],
							'name'   => $this->vn_str_filter($detailItem[0]['title']),
							'qty'    => $addItem['qty'] > 5 ? ($max_qty > 5 ? 5 : $max_qty) : ($addItem['qty'] > $max_qty ? $max_qty : $addItem['qty']),
							'price'  => intval($detailItem[0]['buy_price'] - $detailItem[0]['deal']),
							'option' => array(
								'price'        => $detailItem[0]['buy_price'], 
								'color'        => $addItem['color'], 
								'colors'       => $detailItem[0]['colors'], 
								'deal'         => $detailItem[0]['deal'], 
								'deal_percent' => $deal_percent, 
								'size'         => $addItem['size'], 
								'sizes'        => $detailItem[0]['sizes'], 
								'images'       => $i_img,
								'slug'		   => $this->vn_str_filter($detailItem[0]['title']),
								'max-qty'	   => $detailItem[0]['amount'],
								'name'		   => $detailItem[0]['title']
							)
						);
						if($this->cart->insert($data)){
							if (isset($addItem['ajax']) && $isPost) {
								$ajax->type    = AjaxResponse::SUCCESS;
								$ajax->element = 'success';
								$ajax->message = 'Đã thêm sản phẩm vào giỏ hàng';
								$ajax->qty     = $this->cart->total_items();
				                echo $ajax->toString();
							}
							
							if ($this->input->get('p', TRUE)) {
								redirect('/checkout','refresh');
							}
							else {
								redirect('/checkout/cart','refresh');
							}
						}
						else {

							die(json_encode($this->cart->contents()));
							redirect('/404','refresh');
						}
					}
					else {
							redirect('/404','refresh');
					}
				}
				else {
					if (isset($addItem['ajax']) && $isPost) {
						$ajax->type    = AjaxResponse::SUCCESS;
						$ajax->element = 'success';
						$ajax->message = 'Đã thêm sản phẩm vào giỏ hàng';
						$ajax->qty     = $this->cart->total_items();
						echo $ajax->toString();
					}
					if ($this->input->get('p', TRUE)) {
						redirect('/checkout','refresh');
					}
					else {
						redirect('/checkout/cart','refresh');
					}
				}
			}
			else {
				redirect('/404','refresh');
			}
		}
		else {
			redirect('/404','refresh');
		}
	}

	public function removeItem($itemId, $itemSecret) {
		$data = $this->cart->contents();
        foreach ($data as $item){
            if($item['id'] == $itemId && $item['rowid'] == $itemSecret){
                $item['qty'] = 0;
                $delOne = array("rowid" => $item['rowid'], "qty" => $item['qty']);
            }
        }
        $this->cart->update($delOne);
        redirect('/checkout/cart','refresh');
	}

	public function checkout() {
		$this->data['title']	= 'Thanh toán - Checkout - eShop';
		/*Get items in cart*/
		if ($this->cart->total_items() && $this->cart->total()) {
			$this->load->model(array('Mlocation', 'Mproduct', 'Morders'));
			$this->data['list_item'] = $this->cart->contents();
			$type     = 1; /*Thanh pho*/
			$parentId = 0; /*Cap cao nhat*/
			$this->data['provinces'] = $this->Mlocation->getItems($type, $parentId);

			/*Get DATA*/
			if ($orders = $this->input->post(NULL, TRUE)) {
				if ($this->checkCompleteCart($orders)) {
					/*Get Info Buyer*/
					$buyer_session = $this->data['logger'];
					$buyerId = $buyer_session['id'] ? $buyer_session['id'] : '';
					$pMethod = $orders['payment']['method'] == 'paymentsm' ? 2 : 1;
					/*Insert Orders*/
					$dt_order       = array(
						'buyer_id'             => $buyerId,
						'buyer_username'       => $orders['billing']['fullname'],
						'buyer_phone'          => $orders['billing']['telephone'],
						'buyer_email'          => $orders['billing']['email'],
						'buyer_address'        => $orders['fulldist'],
						'buyer_payment_method' => $pMethod,
						'total_price'          => $this->cart->total(),
						'total_item'           => $this->cart->total_items(),
						'status'               => 0,
						'time_created'         => time(),
					);
					$orderId = $this->Morders->insertOrder($dt_order);

					if ($orderId) {
						foreach ($this->data['list_item'] as $key => $value) {
							foreach ($orders['cart'] as $k => $v) {
								if ($k == $value['id']) {
									$value['name'] = $v['name'];
								}
							}
							/*Insert Items with OrderId*/
							$dt_order_items = array(
								'order_id'          => $orderId,
								'item_id'           => $value['id'],
								'item_title'        => $value['name'],
								'item_link'         => base_url('product-'.$value['option']['slug'].'-'.$value['id']).'.html',
								'item_image'        => $value['option']['images'],
								'item_quantity'     => $value['qty'],
								'item_price'        => $value['price'],
								'data'              => '',
								'item_sale_percent' => $value['option']['deal_percent'],
								'item_buy_price'    => $value['option']['price']
							);
							$this->Morders->insertOrderItem($dt_order_items);
							/*Update amount product*/
							$this->Mproduct->_updateAmout($value['id'], DOWN_AMOUNT, $value['qty']);
						}

						/*Destroy cart*/
						$this->cart->destroy();

						/*Session checkout-success*/
						$this->session->set_userdata('checkout-success', array('id'=>$orderId,'phone'=>$orders['billing']['telephone']));
						redirect('/checkout/success','refresh');
					}
				}
				else {

				}
			}

			$this->data['template']  = 'frontend/cart/onepagecheckout';
			$this->load->view('frontend/layout', $this->data);
		}
		else {
			redirect('/checkout/cart','refresh');
		}
	}

	public function getDistrict() {
		if ($this->input->get('cityId', TRUE)) {
			$cityId = $this->input->get('cityId', TRUE);
			$this->load->model('Mlocation');

			$type = 2;
			$list_district       = '<option value="" selected="selected">Quận / Huyện</option>';
			$lists               = $this->Mlocation->getItems($type, $cityId);
			foreach ($lists as $l) {
				if ($l['districtid'] && $l['name']) {
					$list_district .= '<option value="'.$l['districtid'].'">'.$l['name'].'</option>';
				}
			}

			$ajax                = new AjaxResponse();
			$ajax->type          = AjaxResponse::SUCCESS;
			$ajax->element       = 'success';
			$ajax->message       = '';
			$ajax->list_district = $list_district;
			echo ($ajax->toString());
		}
	}

	public function getWard() {
		if ($this->input->get('districtId', TRUE)) {
			$districtId = $this->input->get('districtId', TRUE);
			$this->load->model('Mlocation');

			$type      = 3;
			$list_ward = '<option value="" selected="selected">Xã / Phường</option>';
			$lists     = $this->Mlocation->getItems($type, $districtId);
			foreach ($lists as $l) {
				if ($l['wardid'] && $l['name']) {
					$list_ward .= '<option value="'.$l['wardid'].'">'.$l['name'].'</option>';
				}
			}

			$ajax                = new AjaxResponse();
			$ajax->type          = AjaxResponse::SUCCESS;
			$ajax->element       = 'success';
			$ajax->message       = '';
			$ajax->list_ward     = $list_ward;
			echo ($ajax->toString());
		}
	}

	public function checkCompleteCart($orders) {
		return TRUE;
	}

	public function checkout_success() {
		$this->data['title']	= 'Đặt hàng thành công - eShop';
		/*Get items in cart*/
		if ($this->cart->total_items() && $this->cart->total()) {
			redirect('checkout','refresh');
		}
		elseif (!$this->session->userdata('checkout-success')) {
			redirect('','refresh');
		}

		$orders = $this->session->userdata('checkout-success');
		$this->data['orders'] = $orders;
		$this->session->unset_userdata('checkout-success');
		$this->data['template']  = 'frontend/cart/success';
		$this->load->view('frontend/layout', $this->data);
	}
}