<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/application.php");

class Home extends Application {

	public $data;

	public function index()
	{
		$this->load->model('Mproduct');
		$this->data['sliders']  = TRUE;

		if ($this->session->userdata('popup')) {
			$this->data['popup']	= FALSE;
		}
		else {
			$this->data['popup']	= TRUE;
			$this->session->set_userdata('popup', TRUE);
		}
		$this->data['template'] = 'frontend/home';

		/*Get categories*/
		/*Get items {HOT DEAL, NAM, NU, TRE EM, THUONG HIEU}*/
		$where = array('status' => 1, 'is_saleoff' => 1);
		$items_hotdeal = $this->Mproduct->getItems($where, NULL, 10, 0);
		$this->data['deals']      = $items_hotdeal;

		unset($where['is_saleoff']);
		$items = array(); $i = 0;

		foreach ($this->data['categories'] as $key => $value) {
			if ($value['show_home'] == 1) {
				$items[$i]['name']     = $value['title'];
				$items[$i]['slug']     = $value['slug'];
				$items[$i]['id']       = $value['id'];
				$like['category_id']   = '|'.$value['id'].'|';
				$items[$i]['items']    = $this->Mproduct->getItems($where, $like, 10, 0);
				$i++;
			}
		}
		$this->data['items'] = $items;
		
		/*Related*/
		$items_related               = $this->Mproduct->getItemsRelated($where, $this->session->userdata['related'], 10, 0);
		$this->data['items_related'] = $items_related;

		$this->load->view('frontend/layout', $this->data);
	}

	public function productDetail($pTitle, $pId) {
		$this->load->model('Mproduct');
		$this->data['detail']   = $this->Mproduct->getItem($pId);

		if ($this->data['detail'][0]) {
			if ($this->input->post(NULL, TRUE)) {
				$review  = $this->input->post(NULL, TRUE);
				$error   = FALSE;

				if (!Public_class::isValidEmail($review['email'])) {
					$error .= '<li>- Sai định dạng email</li>';
				}

				if (strlen($review['name']) < 3) {
					$error .= '<li>- Sai định dạng họ & tên</li>';
				}

				if (!Public_class::isValidPhoneNumber($review['telephone'])) {
					$error .= '<li>- Sai định dạng điện thoại</li>';
				}

				if (!$review['comment']) {
					$error .= '<li>- Chưa nhập nội dung</li>';
				}

				if (!$error) {
					$this->load->model('Mreview');
					$this->Mreview->rate($review['rating_point'], $pId);
					$dt = array(
						'fullname'   => $review['name'],
						'email'      => $review['email'],
						'phone'      => $review['telephone'],
						'comment'    => $review['comment'],
						'created_at' => time(),
						'point'      => $review['rating_point'],
						'item_id'    => $pId
					);
					$result = $this->Mreview->insertItem($dt);

					if ($result) {
						$this->data['alert_success'] = TRUE;
					}
					else {
						$error .= '<li>- Không thể gửi thông tin. Vui lòng thử lại sau</li>';
					}
				}
				$this->data['alert_error'] = $error;
				$this->data['detail']      = $this->Mproduct->getItem($pId);
			}
			$this->data['detail']   = $this->data['detail'][0];
			$attrs = unserialize($this->data['detail']['attributes']);
			$this->data['detail']['attributes'] = $attrs;
			$this->data['title']	= $this->data['detail']['title'];			
			$this->data['template'] = 'frontend/product/product-detail';

			/*Breadcrumbs*/
			$brcs = explode('|', $this->data['detail']['category_id']);
			$breadcrumbs = '';
			foreach ($brcs as $k => $v) {
				if ($v && is_numeric($v)) {
					foreach ($this->temp['category'] as $key => $value) {
						if ($v == $value['id']) {
							$breadcrumbs .= '<li> <a href="'.base_url('p/cat/'.$value['slug'].'-'.$value['id'].'.html').'"><span>'.$value['title'].'</span></a> <span class="separator">/ </span></li>';
						}
					}
				}
			}
			$breadcrumbs .= '<li class="product"> <strong>'.$this->data['title'].'</strong></li>';
			$this->data['breadcrumbs'] = $breadcrumbs;

			/*Related items*/
			/*Reviews*/
			/*Temps : colors, sizes*/
			$p_colors = explode('|', $this->data['detail']['colors']);
			$p_sizes  = explode('|', $this->data['detail']['sizes']);
			$a_colors = $a_sizes = array();
			foreach ($this->temp['temp'] as $key => $value) {
				foreach ($p_colors as $color) {
					if ($color && $value['id'] == $color && $value['t_type'] == T_COLOR) {
						$a_colors[] = $this->temp['temp'][$key];
					}
				}

				foreach ($p_sizes as $size) {
					if ($size && $value['id'] == $size && $value['t_type'] == T_SIZE) {
						$a_sizes[] = $this->temp['temp'][$key];
					}
				}
			}

			$this->data['p_colors'] = $a_colors;
			$this->data['p_sizes'] = $a_sizes;
			/*Update view*/
			$this->Mproduct->_updateViews($pId);

			/*Add to related session*/
			if ($this->session->userdata['related']) {
				$session_related = $this->session->userdata['related'];
				if (!in_array($pId, $session_related)) {
					array_push($session_related, $pId);
					$this->session->set_userdata('related', $session_related);
				}
			}
			else {
				/*Create*/
				$this->session->set_userdata('related', array($pId));
			}
			
			/*Reviews*/
			$this->data['reviews'] = $this->Mproduct->getReviews($pId);
			$this->data['reviews'] = $this->buildTree($this->data['reviews']);
			$this->load->view('frontend/layout', $this->data);
		}
		else {
			redirect('/404','refresh');
		}

	}

	public function cartProductDetail($pId) {
		$this->load->model('Mproduct');
		$this->data['detail']   = $this->Mproduct->getItem($pId);

		if ($this->data['detail'][0]) {
			$this->data['detail'] = $this->data['detail'][0];
			$attrs = unserialize($this->data['detail']['attributes']);
			$this->data['detail']['attributes'] = $attrs;

			/*Temps : colors, sizes*/
			$p_colors = explode('|', $this->data['detail']['colors']);
			$p_sizes  = explode('|', $this->data['detail']['sizes']);
			$a_colors = $a_sizes = array();
			foreach ($this->temp['temp'] as $key => $value) {
				foreach ($p_colors as $color) {
					if ($color && $value['id'] == $color && $value['t_type'] == T_COLOR) {
						$a_colors[] = $this->temp['temp'][$key];
					}
				}

				foreach ($p_sizes as $size) {
					if ($size && $value['id'] == $size && $value['t_type'] == T_SIZE) {
						$a_sizes[] = $this->temp['temp'][$key];
					}
				}
			}

			$this->data['p_colors'] = $a_colors;
			$this->data['p_sizes'] = $a_sizes;
		}
		$this->load->view('frontend/product/cart-product', $this->data);
	}

	public function catProducts($pTitle, $pId) {
		$this->load->model('Mproduct');
		$this->load->library('pagination');
		$this->data['onepage']  = TRUE;

		$GET = array(); $sort = 'created_at desc'; $where = array(); $like = array('category_id' => '|'.$pId.'|');
		if ($this->input->get(NULL, TRUE)) {
			$GET = $this->input->get(NULL, TRUE);
			foreach ($GET as $key => $value) {
				$GET[$key] = trim($value);
			}

			if (isset($GET['sortlist']) && $GET['sortlist']) {
				if ($GET['sortlist'] === 'product_sale_desc') {
					$sort = 'created_at desc, deal desc';
				}
				elseif ($GET['sortlist'] === 'product_saleoff_desc') {
					$sort = 'deal desc, created_at desc';
				}
				elseif ($GET['sortlist'] === 'product_sale_buy') {
					$sort = 'transaction_num desc, created_at desc';
				}
				elseif ($GET['sortlist'] === 'product_view_desc') {
					$sort = 'view_num desc, created_at desc';
				}
				elseif ($GET['sortlist'] === 'product_brand') {
					$where = array('brande REGEXP' => '[1-9]');
				}
			}

			if (isset($GET['color'])) {
				$like['colors'] = '|'.$GET['color'].'|';
			}

			if (isset($GET['size'])) {
				$like['sizes'] = '|'.$GET['size'].'|';
			}

			if (isset($GET['material'])) {
				$like['materials'] = '|'.$GET['material'].'|';
			}

			if (isset($GET['price'])) {
				if ($GET['price'] == 1) {
					$where['buy_price <= '] = '1000000';
				}
				elseif ($GET['price'] == 2) {
					$where['buy_price <= '] = '2000000';
					$where['buy_price >= '] = '1000000';
				}
				elseif ($GET['price'] == 3) {
					$where['buy_price <= '] = '3000000';
					$where['buy_price >= '] = '2000000';
				}
			}
		}

		if (count($_GET) > 0) $config['suffix']      = '?' . http_build_query($_GET, '', "&");
		$config['base_url']    = base_url('p/cat/'.$pTitle.'-'.$pId.'/p');
		$config['first_url']   = $config['base_url'].'/0'.http_build_query($_GET);
		$config['total_rows']  = $this->Mproduct->count_all($pId, $where, $like);
		$config['per_page']    = 40;
		$config['uri_segment'] = 5;
		$config['prev_link']   = '<span class="glyphicon glyphicon-triangle-left"></span>';
		$config['next_link']   = '<span class="glyphicon glyphicon-triangle-right"></span>';

        $this->pagination->initialize($config); 
		$list_item             = $this->Mproduct->list_all_item_category($config['per_page'], $this->uri->segment(5), $pId, $sort, $where, $like);

		/*title page*/
		$parents                   = array();
		$parentsNode               = $this->get_full_parent($this->temp['category'], $pId);
		$this->data['nodes']       = $parentsNode;
		$this->data['currentId']   = $pId;
		$this->data['currentLink'] = $this->curPageURL();
		$lastItem                  = end($parentsNode);
		if ($lastItem['title']) {
			$this->data['title']   = $lastItem['title'];
		}
		else {
			redirect('/404','refresh');
		}
		
		/*variables*/
		foreach ($GET as $key => $value) {
			$this->data['params'][$key] = $value;	
		}

		/*SortTab*/
		$this->data['index_tab_sort'] = isset($GET['sortlist']) && $GET['sortlist'] ? $GET['sortlist'] : 'product_new_desc';
		if ($list_item) {
			$this->data['list_item'] = $list_item;
		}
		$this->data['template'] = 'frontend/product/index';
		$this->load->view('frontend/layout', $this->data);
	}

	public function catProductsOption($pId) {
		$this->load->model('Mproduct');
		$this->load->library('pagination');

		$GET = array(); $sort = 'created_at desc'; $where = array(); $like = array();
		if ($pId == 1) {
			$where = array('`type`' => 0);
			$sort = 'deal desc, created_at desc';
			$this->data['title'] = 'Hot Deal';
		}
		elseif ($pId == 2) {
			$sort = 'view_num desc, created_at desc';
			$this->data['title'] = 'Xu Hướng';
		}
		elseif ($pId == 3) {
			$sort = 'created_at desc';
			$this->data['title'] = 'Hàng mới';
		}
		elseif ($pId == 4) {
			$where = array('`type`' => 0);
			$sort = 'transaction_num desc';
			$this->data['title'] = 'HOT nhất';
		}
		if ($this->input->get(NULL, TRUE)) {
			$GET = $this->input->get(NULL, TRUE);
			foreach ($GET as $key => $value) {
				$GET[$key] = trim($value);
			}

			if (isset($GET['sortlist']) && $GET['sortlist']) {
				if ($GET['sortlist'] === 'product_sale_desc') {
					$sort = 'created_at desc, deal desc';
				}
				elseif ($GET['sortlist'] === 'product_saleoff_desc') {
					$sort = 'deal desc, created_at desc';
				}
				elseif ($GET['sortlist'] === 'product_sale_buy') {
					$sort = 'transaction_num desc, created_at desc';
				}
				elseif ($GET['sortlist'] === 'product_view_desc') {
					$sort = 'view_num desc, created_at desc';
				}
			}

			if (isset($GET['color'])) {
				$like['colors'] = '|'.$GET['color'].'|';
			}

			if (isset($GET['size'])) {
				$like['sizes'] = '|'.$GET['size'].'|';
			}

			if (isset($GET['material'])) {
				$like['materials'] = '|'.$GET['material'].'|';
			}

			if (isset($GET['price'])) {
				if ($GET['price'] == 1) {
					$where['buy_price <= '] = '1000000';
				}
				elseif ($GET['price'] == 2) {
					$where['buy_price <= '] = '2000000';
					$where['buy_price >= '] = '1000000';
				}
				elseif ($GET['price'] == 3) {
					$where['buy_price <= '] = '3000000';
					$where['buy_price >= '] = '2000000';
				}
			}
		}
		if (count($_GET) > 0) $config['suffix']      = '?' . http_build_query($_GET, '', "&");
		$config['base_url']    = base_url($this->uri->segment(1).'/p');
		$config['first_url']   = $config['base_url'].'/0'.http_build_query($_GET);
		$config['total_rows']  = $this->Mproduct->count_all($pId, $where, $like);
		$config['per_page']    = 50;
		$config['uri_segment'] = 3;
		$config['prev_link']   = '<span class="glyphicon glyphicon-triangle-left"></span>';
		$config['next_link']   = '<span class="glyphicon glyphicon-triangle-right"></span>';

        $this->pagination->initialize($config); 
		$list_item             = $this->Mproduct->list_all_item_category($config['per_page'], $this->uri->segment(3), $pId, $sort, $where, $like);

		/*title page*/
		$this->data['currentLink'] = $this->curPageURL();
		$this->data['slug']        = $this->uri->segment(1);//$this->vn_str_filter($this->data['title']);
		
		/*variables*/
		foreach ($GET as $key => $value) {
			$this->data['params'][$key] = $value;	
		}

		/*SortTab*/
		$this->data['index_tab_sort'] = isset($GET['sortlist']) && $GET['sortlist'] ? $GET['sortlist'] : 'product_new_desc';
		if ($list_item) {
			$this->data['list_item'] = $list_item;
		}
		$this->data['onepage']  = TRUE;
		$this->data['template'] = 'frontend/product/option-product';
		$this->load->view('frontend/layout', $this->data);
	}

	public function brandeProducts($pId) {
		$this->load->model('Mproduct');
		$this->load->library('pagination');
		$this->data['onepage']  = TRUE;

		$GET = array(); $sort = 'created_at desc'; $where = array(); $like = $pId ? array('brande' => '|'.$pId.'|') : array();
		if ($this->input->get(NULL, TRUE)) {
			$GET = $this->input->get(NULL, TRUE);
			foreach ($GET as $key => $value) {
				$GET[$key] = trim($value);
			}

			if (isset($GET['sortlist']) && $GET['sortlist']) {
				if ($GET['sortlist'] === 'product_sale_desc') {
					$sort = 'created_at desc, deal desc';
				}
				elseif ($GET['sortlist'] === 'product_saleoff_desc') {
					$sort = 'deal desc, created_at desc';
				}
				elseif ($GET['sortlist'] === 'product_sale_buy') {
					$sort = 'transaction_num desc, created_at desc';
				}
				elseif ($GET['sortlist'] === 'product_view_desc') {
					$sort = 'view_num desc, created_at desc';
				}
				elseif ($GET['sortlist'] === 'product_brand') {
					$where = array('brande REGEXP' => '[1-9]');
				}
			}

			if (isset($GET['color'])) {
				$like['colors'] = '|'.$GET['color'].'|';
			}

			if (isset($GET['size'])) {
				$like['sizes'] = '|'.$GET['size'].'|';
			}

			if (isset($GET['material'])) {
				$like['materials'] = '|'.$GET['material'].'|';
			}

			if (isset($GET['price'])) {
				if ($GET['price'] == 1) {
					$where['buy_price <= '] = '1000000';
				}
				elseif ($GET['price'] == 2) {
					$where['buy_price <= '] = '2000000';
					$where['buy_price >= '] = '1000000';
				}
				elseif ($GET['price'] == 3) {
					$where['buy_price <= '] = '3000000';
					$where['buy_price >= '] = '2000000';
				}
			}
		}

		if (count($_GET) > 0) $config['suffix']      = '?' . http_build_query($_GET, '', "&");
		$config['base_url']    = base_url('brande-'.$pId.'/p');
		$config['first_url']   = $config['base_url'].'/0'.http_build_query($_GET);
		$config['total_rows']  = $this->Mproduct->count_all($pId, $where, $like, TRUE);
		$config['per_page']    = 40;
		$config['uri_segment'] = 3;
		$config['prev_link']   = '<span class="glyphicon glyphicon-triangle-left"></span>';
		$config['next_link']   = '<span class="glyphicon glyphicon-triangle-right"></span>';

        $this->pagination->initialize($config); 
		$list_item             = $this->Mproduct->list_all_item_category($config['per_page'], $this->uri->segment(3), $pId, $sort, $where, $like, TRUE);

		/*title page*/
		$this->data['currentId']   = $pId;
		$this->data['currentLink'] = $this->curPageURL();

		foreach ($this->temp['temp'] as $temp) {
			if ($temp['t_type'] == T_BRANDE && $pId == $temp['id']) {
				$this->data['title'] = $temp['t_value'];
			}
		}
		
		$this->data['brandeName'] = $this->data['title'] ? $this->data['title'] : 'THƯƠNG HIỆU';
		/*variables*/
		foreach ($GET as $key => $value) {
			$this->data['params'][$key] = $value;	
		}

		/*SortTab*/
		$this->data['index_tab_sort'] = isset($GET['sortlist']) && $GET['sortlist'] ? $GET['sortlist'] : 'product_new_desc';
		if ($list_item) {
			$this->data['list_item'] = $list_item;
		}
		$this->data['template'] = 'frontend/product/brande-product';
		$this->load->view('frontend/layout', $this->data);
	}

	public function readNews($pTitle, $pId) {
		$this->load->model('Mnews');
		$this->data['detail']   = $this->Mnews->getItem($pId);

		if ($this->data['detail']) {
			$this->data['title']	= $this->data['detail']['title'];
			$this->data['types']    = array('1' => 'Khuyến mãi', '2' => 'Thông báo', '3' => 'Xu hướng', '4' => 'Mặc đẹp');
			$this->data['template'] = 'frontend/news/news-detail';

			/*Update view*/
			$this->Mnews->_updateViews($pId);
			$this->load->view('frontend/layout', $this->data);
		}
		else {
			redirect('/404','refresh');
		}
	}

	public function readListNews($pTitle, $pId) {
		$pId    = intval($pId);
		$this->load->library('pagination');
		$this->load->model('Mnews');
		$types = array('1' => 'Khuyến mãi', '2' => 'Thông báo', '3' => 'Xu hướng', '4' => 'Mặc đẹp');
		foreach ($types as $key => $value) {
			if ($pId == $key) {
				$title = $value;
			}
		}
		if (count($_GET) > 0) $config['suffix']      = '?' . http_build_query($_GET, '', "&");
		$config['base_url']    = base_url('tin-tuc/cat/'.$pTitle.'-'.$pId.'/p');
		$config['first_url']   = $config['base_url'].'/0'.http_build_query($_GET);
		$config['total_rows']  = $this->Mnews->count_all($pId);
		$config['per_page']    = 30;
		$config['uri_segment'] = 5;
		
		$config['prev_link']   = '<span class="glyphicon glyphicon-triangle-left"></span>';
		$config['next_link']   = '<span class="glyphicon glyphicon-triangle-right"></span>';

        $this->pagination->initialize($config); 
        $this->data['list_item'] = $this->Mnews->list_all($config['per_page'], $this->uri->segment(5), $pId);
		if ($this->data['list_item']) {
			$this->data['title']	= $title ? $title : 'Tin tức';
			$this->data['types']    = $types;
			$this->data['type']     = $pId ? $pId : 0;
			$this->data['template'] = 'frontend/news/index';
			$this->load->view('frontend/layout', $this->data);
		}
		else {
			redirect('/404','refresh');
		}
	}

	/*About*/
	public function about()
	{
		$this->data['title']    = 'Giới thiệu - eShop';
		$this->data['template'] = 'frontend/about';
		$this->load->view('frontend/layout', $this->data);
	}

	/*FAQ*/
	public function faq()
	{
		$this->data['title']    = 'Câu hỏi thường gặp - eShop';
		$this->data['template'] = 'frontend/faq';
		$this->load->view('frontend/layout', $this->data);
	}

	/*Policy*/
	public function policy()
	{
		$this->data['title']    = 'Chính sách bảo mật - eShop';
		$this->data['template'] = 'frontend/policy';
		$this->load->view('frontend/layout', $this->data);
	}

	/*Contact*/
	public function contact()
	{
		$this->data['title']    = 'Liên hệ với - eShop';
		if ($this->input->post(NULL, TRUE)) {
			$contact = $this->input->post(NULL, TRUE);
			$error   = FALSE;

			if (!Public_class::isValidEmail($contact['email'])) {
				$error .= '<li>- Sai định dạng email</li>';
			}

			if (strlen($contact['name']) < 3) {
				$error .= '<li>- Sai định dạng họ & tên</li>';
			}

			if (!Public_class::isValidPhoneNumber($contact['telephone'])) {
				$error .= '<li>- Sai định dạng điện thoại</li>';
			}

			if (!$contact['comment']) {
				$error .= '<li>- Chưa nhập nội dung</li>';
			}

			if (!$error) {
				$this->load->model('Mcontact');
				$dt = array(
					'username'   => $contact['name'],
					'email'      => $contact['email'],
					'mobile'     => $contact['telephone'],
					'content'    => $contact['comment'],
					'type'       => 0,
					'status'     => 0,
					'created_at' => time()
				);
				$result = $this->Mcontact->insertItem($dt);

				if ($result) {
					$this->data['alert_success'] = TRUE;
				}
				else {
					$error .= '<li>- Không thể gửi thông tin. Vui lòng thử lại sau</li>';
				}
			}
			$this->data['alert_error'] = $error;
		}
		$this->data['view_map'] = TRUE;
		$this->data['template'] = 'frontend/contact';
		$this->load->view('frontend/layout', $this->data);
	}

	/*Search*/
	public function search() {
		$this->load->model(array('Mproduct'));
		$this->data['title'] = 'Tìm kiếm toàn bộ cửa hàng - eShop';
		$last_id             = 1;
		$sort = 'created_at desc'; $where = array(); $like = array(); $categories = array(); $this->data['selected'] = array(); $startIndex = 0; $limit = 40;
		if ($data_search = $this->input->get(NULL, TRUE)) {
			/*Sortlist*/
			if (isset($data_search['sortlist']) && $data_search['sortlist']) {
				if ($data_search['sortlist'] === 'product_sale_desc') {
					$sort = 'created_at desc, deal desc';
				}
				elseif ($data_search['sortlist'] === 'product_saleoff_desc') {
					$sort = 'deal desc, created_at desc';
				}
				elseif ($data_search['sortlist'] === 'product_sale_buy') {
					$sort = 'transaction_num desc, created_at desc';
				}
				elseif ($data_search['sortlist'] === 'product_view_desc') {
					$sort = 'view_num desc, created_at desc';
				}
				elseif ($data_search['sortlist'] === 'product_brand') {
					$where = array('brande REGEXP' => '[1-9]');
				}

				$this->data['sortlist'] = $data_search['sortlist'];
			}
			$this->data['search_value'] = $data_search['q'];

			if ($data_search['q']) {
				$this->Mproduct->db->like('title', $data_search['q']);
			}
			/*Categories*/
			if (isset($data_search['categories'])) {
				$last_id = end($data_search['categories']);
				$like['category_id'] = '|'.$last_id.'|';
			}

			/*Colors*/
			if (isset($data_search['colors'])) {
				$sub_q = '';
				foreach ($data_search['colors'] as $key => $value) {
					if ($value) {
						$sub_q .= $key == 0 ? 'colors LIKE "%|'.$value.'|%"' : ' OR colors LIKE "%|'.$value.'|%"';
					}
				}
				if ($sub_q)
					$this->Mproduct->db->where('('.$sub_q.')', null, false);
			}

			/*Sizes*/
			if (isset($data_search['sizes'])) {
				$sub_q = '';
				foreach ($data_search['sizes'] as $key => $value) {
					if ($value) {
						$sub_q .= $key == 0 ? 'sizes LIKE "%|'.$value.'|%"' : ' OR sizes LIKE "%|'.$value.'|%"';
					}
				}
				if ($sub_q)
					$this->Mproduct->db->where('('.$sub_q.')', null, false);
			}

			/*Styles*/
			if (isset($data_search['styles'])) {
				$sub_q = '';
				foreach ($data_search['styles'] as $key => $value) {
					if ($value) {
						$sub_q .= $key == 0 ? 'styles LIKE "%|'.$value.'|%"' : ' OR styles LIKE "%|'.$value.'|%"';
					}
				}
				if ($sub_q)
					$this->Mproduct->db->where('('.$sub_q.')', null, false);
			}

			/*Brandes*/
			if (isset($data_search['brandes'])) {
				$where = array('brande REGEXP' => '[1-9]');
				$this->data['l_brandes'] = TRUE;
				$sub_q = '';
				foreach ($data_search['brandes'] as $key => $value) {
					if ($value) {
						$sub_q .= !$sub_q ? 'brande LIKE "%|'.$value.'|%"' : ' OR brande LIKE "%|'.$value.'|%"';
					}
				}
				if ($sub_q)
					$this->Mproduct->db->where('('.$sub_q.')', null, false);
			}

			/*Prices*/
			if (isset($data_search['prices'])) {
				$sub_q = '';
				foreach ($data_search['prices'] as $key => $value) {
					if ($value) {
						if ($value == 1) {
							$sub_q .= $key == 0 ? 'buy_price <= 1000000' : ' OR buy_price <= 1000000';
						}
						elseif ($value == 2) {
							$sub_q .= $key == 0 ? '(buy_price >= 1000000 AND buy_price <= 2000000)' : ' OR (buy_price >= 1000000 AND buy_price <= 2000000)';
						}
						elseif ($value == 3) {
							$sub_q .= $key == 0 ? '(buy_price >= 2000000 AND buy_price <= 3000000)' : ' OR (buy_price >= 2000000 AND buy_price <= 3000000)';
						}
						
					}
				}
				if ($sub_q)
					$this->Mproduct->db->where('('.$sub_q.')', null, false);
			}
			/*Page*/
			if (isset($data_search['page']) && $data_search['page']) {
				$startIndex = intval($data_search['page'])*$limit;
			}
			$this->data['selected'] = $data_search;
		}

		/*die(json_encode($startIndex));*/
		/*Current LINK*/
		$this->data['currentLink'] = $this->curPageURL();

		foreach ($this->temp['category'] as $c) {

			if ((!isset($data_search['categories']) && $c['level'] == 1)) {
				$categories[] = $c;
			}
			elseif ($data_search['categories']) {
				foreach ($data_search['categories'] as $s_c) {
					if ($s_c == $c['id'] || $c['parent_id'] == $last_id) {
						if (!in_array($c, $categories))
							$categories[] = $c;
					}
				}
			}
		}
		$list_item = $this->Mproduct->list_all_item_category($limit, $startIndex, $pId, $sort, $where, $like, TRUE);

		if (isset($data_search['ajax']) && $data_search['ajax']) {
			$stopped 					= $list_item == 0 ? 1 : 0;
			$content                    = $this->generate_filter_table($data_search, $list_item);
			$t_content                  = $content['filter_table'];
			$list_item                  = $content['list_item'];
			$ajax                       = new AjaxResponse();
			$ajax->type                 = AjaxResponse::SUCCESS;
			$ajax->element              = 'success';
			$ajax->message              = '';
			$ajax->stopped              = $stopped;
			$ajax->list_item            = $list_item;
			$ajax->table_filter_content = $t_content;
            exit ($ajax->toString());
		}
		$this->data['list_item']  = $list_item;
		$this->data['categories'] = $categories;
		$this->data['onepage']    = TRUE;
		$this->data['template']   = 'frontend/search/index';
		$this->load->view('frontend/layout', $this->data);
	}

	public function generate_filter_table($data, $list_item) {

		/*Categories*/
		$last_id = end($data['categories']);
		foreach ($this->temp['category'] as $c) {
			if ((!isset($data['categories']) && $c['level'] == 1)) {
				$categories[] = $c;
			}
			elseif ($data['categories']) {
				foreach ($data['categories'] as $s_c) {
					if ($s_c == $c['id'] || $c['parent_id'] == $last_id) {
						if (!in_array($c, $categories))
							$categories[] = $c;
					}
				}
			}
		}
		
		$table_content = '<tr><td>Nhóm sản phẩm</td><td>';
		if (!isset($data['brandes'])) {
			foreach ($categories as $c) {
				$c_active = in_array($c['id'], $data['categories']) ? 'item-filter-active' : ''; $c_checked = in_array($c['id'], $data['categories']) ? 'checked="checked"' : '';
				$table_content .= '<label class="category-attr item-filter '.$c_active.'">'.$c['title'].'<i>x</i><input '.$c_checked.' name="categories[]" class="display-none" type="checkbox" value="'.$c['id'].'"/></label>';
			}
			if (empty($data['categories']))
                $table_content .= '<label class="brande-attr item-filter">Thương hiệu<i>x</i><input name="brandes[]" class="display-none" type="checkbox" value="0"></label>';
		}
		elseif (isset($data['brandes']) && $data['brandes']) {
            $table_content .= '<label class="brande-attr item-filter item-filter-active">Thương hiệu<i>x</i><input checked="checked" name="brandes[]" class="display-none" type="checkbox" value="0"></label>';
            foreach ($this->temp['temp'] as $temp) {
                if ($temp['t_type'] == T_BRANDE){
                    $c_active = in_array($temp['id'], $data['brandes']) ? 'item-filter-active' : ''; $c_checked = in_array($temp['id'], $data['brandes']) ? 'checked="checked"' : '';
                    $table_content .= '<label class="brande-attr item-filter '.$c_active.'">'.$temp['t_value'].'<i>x</i><input '.$c_checked.' name="brandes[]" class="display-none" type="checkbox" value="'.$temp['id'].'"/></label>';
                }
            }
        }
		$table_content .= '</td></tr>';

		/*Temp*/
		/*Color*/
		$table_content .= '<tr><td>Màu sắc</td><td>';
		foreach ($this->temp['temp'] as $temp) {
			if ($temp['t_type'] == T_COLOR)
			{
				$c_active = in_array($temp['id'], $data['colors']) ? 'item-filter-active' : ''; $c_checked = in_array($temp['id'], $data['colors']) ? 'checked="checked"' : '';
                $table_content .= '<label class="color-attr item-filter '.$c_active.'">'.$temp['t_value'].'<i>x</i><input '.$c_checked.' name="colors[]" class="display-none" type="checkbox" value="'.$temp['id'].'"/></label>';
			}
		}
		$table_content .= '</td></tr>';
		/*Size*/
		$table_content .= '<tr><td>Size</td><td>';
		foreach ($this->temp['temp'] as $temp) {
			if ($temp['t_type'] == T_SIZE)
			{
				$c_active = in_array($temp['id'], $data['sizes']) ? 'item-filter-active' : ''; $c_checked = in_array($temp['id'], $data['sizes']) ? 'checked="checked"' : '';
                $table_content .= '<label class="color-attr item-filter '.$c_active.'">'.$temp['t_value'].'<i>x</i><input '.$c_checked.' name="sizes[]" class="display-none" type="checkbox" value="'.$temp['id'].'"/></label>';
			}
		}
		$table_content .= '</td></tr>';
		/*Price*/
		$table_content .= '<tr><td>Giá còn</td><td>';
		foreach ($this->temp['temp'] as $temp) {
			if ($temp['t_type'] == T_PRICE)
			{
				$c_active = in_array($temp['id'], $data['prices']) ? 'item-filter-active' : ''; $c_checked = in_array($temp['id'], $data['prices']) ? 'checked="checked"' : '';
                $table_content .= '<label class="color-attr item-filter '.$c_active.'">'.$temp['t_value'].'<i>x</i><input '.$c_checked.' name="prices[]" class="display-none" type="checkbox" value="'.$temp['id'].'"/></label>';
			}
		}
		$table_content .= '</td></tr>';
		/*Style*/
		$table_content .= '<tr><td>Kiểu dáng</td><td>';
		foreach ($this->temp['temp'] as $temp) {
			if ($temp['t_type'] == T_STYLE)
			{
				$c_active = in_array($temp['id'], $data['styles']) ? 'item-filter-active' : ''; $c_checked = in_array($temp['id'], $data['styles']) ? 'checked="checked"' : '';
                $table_content .= '<label class="color-attr item-filter '.$c_active.'">'.$temp['t_value'].'<i>x</i><input '.$c_checked.' name="styles[]" class="display-none" type="checkbox" value="'.$temp['id'].'"/></label>';
			}
		}
		$table_content .= '</td></tr>';

		/*++++++++++++++ END TABLE CONTENT +++++++++++++++++*/

		/*============== LIST ITEM ================*/
		$i_content = '';
		if (isset($list_item) && $list_item) {
            $i = 1;
            foreach ($list_item as $key => $value) {
                $class = '';
                if ($i == 1) {
                    $class = 'first';
                }
                elseif ($i == 5) {
                    $class = 'last';
                }
                /*link*/
                $link         = '';
                $images       = explode('|', $value['images']);
                $fLink        = FALSE;
                $k            = 0;
                $deal_percent = '';
                $deal_price   = '';
                $is_hot       = '';

                if ($value['is_hot']) {
                    $is_hot = '<li class="label hot"><p> Hot </p></li>';
                }

                if ($value['deal'] && $value['type'] == 0) {
                    $deal_price   = '<p class="old-price"><span class="price-label">Regular Price:</span><span class="price" id="old-price-182-emprice-c095817cdda4bcb80055091211aacad7">'.number_format((float) $value['buy_price']).' đ</span></p>';
                    $deal_percent = '<ul class="productlabels_icons">'.$is_hot.'<li class="label special"><p><span>-'.intval(100*$value['deal']/$value['buy_price']).'%</span> </p></li></ul>';
                }

                if ($value['type'] == 0) {
                    $s_price = number_format((float) (intval($value['buy_price'] - $value['deal']))) . ' đ';
                    $addCart = '<div class="em-btn-addto">
                                    <!--product add to cart-->
                                    <button type="button" title="Mua hàng" class="button btn-cart btn-cart-home" href="'.base_url('cart-product-'.$value['id']).'"><span><span>Mua</span></span></button>
                                </div>';
                }
                else {
                    $s_price = 'LIÊN HỆ';
                    $addCart = '';
                }
                
                foreach ($images as $img) {
                    if ($img) {
                        $info = pathinfo($img);
                        $img  = $info['dirname'].'/350x350-'.$info['filename'].'_thumb.'.$info['extension'];
                        $img  = base_url('/public/uploads/products/'.$img);
                        if ($k == 0) {
                            $link  = '<img class="img-responsive em-alt-org em-lazy-loaded" src="'.$img.'" data-original="'.$img.'" alt="'.$value['title'].'" height="350" width="350">';
                            $b_img = $img; 
                        }
                        elseif ($k == 1)
                        {
                            $link  = '<a href="'.base_url('product-'.$this->vn_str_filter($value['title']).'-'.$value['id']).'.html" title="'.$value['title'].'" class="product-image"><img class="em-alt-hover img-responsive em-lazy-loaded" src="'.$img.'" data-original="'.$img.'" alt="'.$value['title'].'" height="350" width="350">'.$deal_percent.$link.'</a>';
                            $fLink = TRUE;
                        }
                        $k++;
                    }
                }
                if (!$fLink) {
                    $link  = '<a href="'.base_url('product-'.$this->vn_str_filter($value['title']).'-'.$value['id']).'.html" title="'.$value['title'].'" class="product-image"><img class="em-alt-hover img-responsive em-lazy-loaded" src="'.$b_img.'" data-original="'.$b_img.'" alt="'.$value['title'].'" height="350" width="350">'.$deal_percent.$link.'</a>';
                }

                $i_content .= '
                <li class="item '.$class.'">
                    <div class="product-item">
                        <div class="product-shop-top">
                            '.$link.'
                            <div class="bottom">
                                '.$addCart.'
                                <div class="quickshop-link-container">
                                    <a href="'.base_url('product-'.$this->vn_str_filter($value['title']).'-'.$value['id']).'.html" class="quickshop-link" title="Mua">Mua</a>
                                </div>
                            </div>
                        </div>

                        <!-- /.product-shop-top -->
                        <div class="product-shop">
                            <div class="f-fix">
                                <!--product name-->
                                <h3 style="min-height: 19px;" class="product-name"><a href="'.base_url('product-'.$this->vn_str_filter($value['title']).'-'.$value['id']).'.html" title="'.$value['title'].'">'.$value['title'].'</a></h3><div class="ratings">
                                    <div class="rating-box">
                                        <div class="rating" style="width:'.floatval($value['ratePoint']*20).'%"></div>
                                    </div>
                                    <span class="amount"><a href="#">('.$value['rateCount'].')</a></span>
                                </div>
                                <!--product price-->
                                <div class="price-box">
                                    '.$deal_price.'
                                    <span class="regular-price" id="product-price-170-emprice-2fd1cdd203d2809e7354d43dcdbdb613"> <span class="price">'.$s_price.'</span> </span>
                                </div>

                            </div>
                        </div><!-- /.product-shop -->
                    </div><!-- /.product-item -->
                </li>
                ';

                $i++;
                if ($i == 6) {
                    $i = 1;
                }
            }
        }
        else {
        	$i_content = '<span class="home-no-items">Không tìm thấy sản phẩm phù hợp.</span>';
        }

		$contents['filter_table'] = $table_content;
		$contents['list_item']    = $i_content;
		return $contents;
	}
}
/* End of file index.php */
/* Location: ./application/controllers/frontend/index.php */