<?php
class BookModel extends CI_Model{


    public function __construct(){
        $this->load->database();
    }


	// function bookList(){
	// 	$hasil=$this->db->get('books');
	// 	return $hasil->result();
	// }

	function saveEmp(){
		$data = array(				
				'name' 			=> $this->input->post('name'), 
				'age' 			=> $this->input->post('age'), 
				'designation' 	=> $this->input->post('designation'), 
				'skills' 		=> $this->input->post('skills'), 
                'address' 		=> $this->input->post('address'),
                
			);
		$result=$this->db->insert('emp',$data);
		return $result;
	}
	function updateEmp(){
		$id=$this->input->post('id');
		$name=$this->input->post('name');
		$age=$this->input->post('age');
		$designation=$this->input->post('designation');
		$skills=$this->input->post('skills');
		$address=$this->input->post('address');
		$this->db->set('name', $name);
		$this->db->set('age', $age);
		$this->db->set('designation', $designation);
		$this->db->set('skills', $skills);
		$this->db->set('address', $address);
		$this->db->where('id', $id);
		$result=$this->db->update('emp');
		return $result;	
	}
	function deleteEmp(){
		$id=$this->input->post('id');
		$this->db->where('id', $id);
		$result=$this->db->delete('emp');
		return $result;
    }
    public function create($post_image){
			
		

        $data = array(
            'title' => $this->input->post('title'),
           
            'description' => $this->input->post('description'),
            'price' => $this->input->post('price'),
           
            'autor' => $this->input->post('autor'),
            'image'=>$post_image
            
            
        );

		return $this->db->query("insert into books (title,description,price,autor,image)value(".$this->db->escape($data['title']).
		",".$this->db->escape($data["description"]).",".$this->db->escape($data['price']).",".$this->db->escape($data['autor']).",".$this->db->escape($data['image']).");");
	}	
	public function lastInsert(){
		
		return $this->db->insert_id();
	}
	public function insertTag($lastInsert,$tags){
		
		for ($i=0; $i <sizeof($tags) ; $i++) { 
			
			$this->db->query("insert into book_tags (book_id,book_tag)value(". $this->db->escape($lastInsert).",".$this->db->escape($tags[$i]).");");
		}
			
	}
	public function getBooks(){
		$query = $this->db->query("select *from books;");
		//  var_dump($query->result());die();
		 return $query->result();
	}
	public function getBook($id){
		$intId= intval($id);
		
		$query = $this->db->query("select *from books where id=".$this->db->escape($id).";");
		
		 return $query->result() ;
	}
	public function getTags(){
		$query=$this->db->query("select id,name,b_t_id from tags left join book_tags on tags.id=book_tags.book_tag;");
		return $query->result();	
	}
	public function getTagsWithBookId($id){
		$intId= intval($id);
		$query=$this->db->query("select *from tags inner join book_tags on tags.id=book_tags.book_tag where book_id=".$this->db->escape($id).";");
		return $query->result();	
	}
	public function saveComment(){
		$data = array(
            'comment' => $this->input->post('comment'),
            'comment_book_id' => $this->input->post('id'),
            
		);
		
		$result=$this->db->query("insert into comments (comment,comment_book_id)value(". $this->db->escape($data['comment']).",".$this->db->escape($data['comment_book_id']).");");
		return $result;
	}
	public function getBookComment($id){
		$query=$this->db->query("select *from comments where comment_book_id=".$this->db->escape($id).";");
		return $query->result();
	}
	public function updateBook($book,$image){
		
		if($this->input->post('title')!=null){
			$title=$this->input->post('title');
		}else{
		   $title=$book[0]->title;
		}if($this->input->post('price')!=null){
			$price=$this->input->post('price');
		}else{
			$price=$book[0]->price;
		 }if($this->input->post('description')!=null){
			$description=$this->input->post('description');
		}else{
			$description=$book[0]->description;
		 }		if($this->input->post('autor')!=null){
			$autor=$this->input->post('autor');
		}else{
			$autor=$book[0]->autor;
		 }
		 if($image!=null){
			 $imag=$image;
		 }else{
			$imag=$book[0]->image;
		 }
		 


		$query=$this->db->query("update books set title=".$this->db->escape($title).",price=".$this->db->escape($price).",description=".$this->db->escape($description).",
		autor=".$this->db->escape($autor).",image=".$this->db->escape($imag)."where id=".$this->db->escape($this->input->post('id')).";");
	    return $query->result();
	}
	public function getBookByTag($tag){

		$query=$this->db->query("select  *from book_tags inner join books on book_tags.book_id=books.id inner join tags on book_tags.book_tag=tags.id where tags.id=".$this->db->escape($tag)."");
	
		return $query->result();
	}
	public function delete($id){
		$query1=$this->db->query("delete from book_tags where book_id=".$this->db->escape($id).";");
		$query2=$this->db->query("delete from comments where comment_book_id=".$this->db->escape($id).";");
		$query=$this->db->query("delete from books where id=".$this->db->escape($id).";");
		
		return $query;
		
			
		
		// return $result;
	}
}