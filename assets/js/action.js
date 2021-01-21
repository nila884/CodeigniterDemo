$(document).ready(function(){
  var comment_load=false	
	$("#comment_section").hide();
	  $("#show_comment").click(function(){
		  if(!comment_load){
			  comment_load=true
			//   console.log(comment_load);
			  listComment()
		  }
		$("#comment_section").toggle();
	  });
	});



$('#saveComment').submit('click',function(){
    var book_comment = $('#comment').val();
    var book_id=$('#id').val();
	$.ajax({
		url: "cmt/" + book_id,
		
		type: "GET",
		dataType: "JSON",
		success: function(data) {
			console.log(data)
			if(data.length<3){
				
				$.ajax({
					type : "POST",
					url  : "comment/create",
					dataType : "JSON",
					data : {comment:book_comment,id:book_id },
					success: function(data){

						$('#comment').val("")
						listComment()
					}
				});
			}else{

			}

		}
	  });
   
    return false;
});

function listComment(){
	var book_id=$('#id').val();
	$.ajax({
	  url: "cmt/" + book_id,
	  type: "GET",
	  dataType: "JSON",
	  success: function(data) {
		var html = '';
			if (data[0] === undefined) return;
		for(i=0; i<data.length; i++){
			html += 
					'<div class="card" style="padding: 1rem;margin-bottom: 1rem;">'+data[i].comment+'</div>';
		}
		$('#comments').html(html);	
	  }
	});
}

$('#deleteBook').on('submit',function(){
	if(confirm("are you sure")){
		var id = $('#deleteBookId').val();
	
		$.ajax({
			type : "POST",
			url  : "delete",
			dataType : "JSON",  
			data : {id:id},
			success: function(data){
				
				console.log('#book'+id)
				
			}
		});
	}

	return false;
});