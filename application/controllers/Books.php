<?php
class Books extends CI_Controller{

    public function delete(){
		$id=$this->input->post('id');
		$image_path = 'assets/images/';
		
		$data['books']=$this->bookModel->getBook($id);
		
		$filename = $image_path . $data['books'][0]->image; 
		$this->load->helper("file");
		
		
        if (file_exists($filename))
        {
			
            unlink($filename);
        }
		$data=$this->bookModel->delete($id);
		
		echo json_encode($data);
	}
	public function tag(){
		if($this->uri->segment('3')!=null){
			$output = preg_replace( '/[^1-9]/', '', $this->uri->segment('3') );
			if(empty($output)){
				show_404();
			}else{
				$data["books"]=$this->bookModel->getBookByTag($this->uri->segment('3'));
				$data['tags']=$this->bookModel->getTags();
				
				
				if(sizeof($data["books"])>0){
					$data['message']=sizeof($data["books"]).' fund';
					$this->load->view('templates/header');
					$this->load->view('pages/search', $data);
					$this->load->view('templates/footer');
				}else{
					$data['message']='not fund';
					$this->load->view('templates/header');
					$this->load->view('pages/search', $data);
					$this->load->view('templates/footer');
				}
				
				
			}
		}
	}
	public function comment(){
		
	$data=$this->bookModel->saveComment();	
	echo json_encode($data);
	}
	public function cmt(){
		// var_dump($this->uri->segment('3'));die();
		if($this->uri->segment('3')!=null){
			$output = preg_replace( '/[^1-9]/', '', $this->uri->segment('3') );
			if(empty($output)){
				show_404();
			}else{
				$data=$this->bookModel->getBookComment($this->uri->segment('3'));
				// var_dump($data);
				echo json_encode($data);
				// return json_encode($data);
			}
		}
		}
	public function list(){
		if($this->uri->segment('2')!=null){
			$output = preg_replace( '/[^1-9]/', '', $this->uri->segment('2') );
			if(empty($output)){
				show_404();
			}else{
				var_dump($output);
			}
		}
		}
	public function action(){
	
		
		if($this->uri->segment('2')!=null){
		$output = preg_replace( '/[^1-9]/', '', $this->uri->segment('2') );
		if(empty($output)){
			show_404();
		}else{
		  $data['books']=$this->bookModel->getBook($this->uri->segment('2'));
		  $data['tags']=$this->bookModel->getTagsWithBookId($this->uri->segment('2'));
		  
		  $this->load->view('templates/header');
		  $this->load->view('show', $data);
		  $this->load->view('templates/footer');
		}
	}

	}

	public function edit(){
		// var_dump($this->uri->segment('3'));die();
		if($this->uri->segment('3')!=null){
			$output = preg_replace( '/[^1-9]/', '', $this->uri->segment('3') );
			if(empty($output)){
				show_404();
			}else{
			  $data['books']=$this->bookModel->getBook($this->uri->segment('3'));
			  $data['tags']=$this->bookModel->getTags();
			  $data['bookTags']=$this->bookModel->getTagsWithBookId($this->uri->segment('3'));
			  $this->load->view('templates/header');
			  $this->load->view('pages/edit', $data);
			  $this->load->view('templates/footer');


			}
		}
	}

	public function update(){
			
	$this->load->helper('form');
	$this->load->library('form_validation');
	// var_dump($_FILES['userfile']);die();nila884
	$output = preg_replace( '/[^1-9]/', '', $this->input->post('id') );
	
	if(empty($output)){
		show_404();
	}else{
		$book=$this->bookModel->getBook($output);
		
		$post_image=null;
		if($_FILES['userfile']['size']!=null){
		  
							// Upload Image
							$config['upload_path'] = FCPATH."assets/images";
							$config['allowed_types'] = 'gif|jpg|png|jpeg';
							$config['max_size'] = '2048';
							$config['max_width'] = '2000';
							$config['max_height'] = '2000';
			
							$this->load->library('upload', $config);
							  
							if(!$this->upload->do_upload()){
								$errors = array('error' => $this->upload->display_errors());
								echo $this->upload->display_errors();die();
								$post_image = 'noimage.jpg';
							} else {
								$data = array('upload_data' => $this->upload->data());
								$post_image = $_FILES['userfile']['name'];
							}

		}
	
		
		
		$result=$this->bookModel->updateBook($book,$post_image);
		return $result;
	}



	}
    public function view($page = 'home'){
        if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
            show_404();
        }
          
        if($page=='home'|| $page =='book'){
		
		$data['books']=$this->bookModel->getBooks(); 
		$data['tags']=$this->bookModel->getTags();
	
		$this->load->view('templates/header');
        $this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer');
		return;
	   }else if($page=='add'){
	
		$data['tags']=$this->bookModel->getTags();
		
		$this->load->view('templates/header');
        $this->load->view('pages/add', $data);
        $this->load->view('templates/footer');
		return;  
	   }
	   
    }

    public function __construct() {
        parent::__construct();
		$this->load->helper('url', 'form');
		$this->load->model('BookModel');
    }

	public function create()
{
	
	$this->load->helper('form');
	$this->load->library('form_validation');
    

    $data['title'] = 'Create a news item';

    $this->form_validation->set_rules('title', 'Title', 'required');
	$this->form_validation->set_rules('description', 'Description', 'required');
	$this->form_validation->set_rules('autor', 'Autor', 'required');
	$this->form_validation->set_rules('price', 'Price', 'required');
	$this->form_validation->set_rules('tags[]', 'Tags', 'required');
	// var_dump($this->input->post("tags"));die();

    if ($this->form_validation->run() === FALSE)
    {
        $this->load->view('templates/header' );
        $this->load->view('pages/add',$data);
        $this->load->view('templates/footer');

    }
    else
    {
				// Upload Image
				$config['upload_path'] = FCPATH."assets/images";
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['max_width'] = '2000';
				$config['max_height'] = '2000';

				$this->load->library('upload', $config);
                  
				if(!$this->upload->do_upload()){
					$errors = array('error' => $this->upload->display_errors());
					echo $this->upload->display_errors();die();
					$post_image = 'noimage.jpg';
				} else {
					$data = array('upload_data' => $this->upload->data());
					$post_image = $_FILES['userfile']['name'];
				}
		$this->bookModel->create($post_image);
		$lastInsert=$this->bookModel->lastInsert();
		// var_dump($lastInsert);die();
		$this->bookModel->insertTag($lastInsert,$this->input->post("tags"));
		$this->load->view('templates/header' );
		$this->load->view('pages/success');
		
    }
}




}