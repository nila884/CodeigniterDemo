

<?php $book=$books[0];  ?>



<div class="card" style="width: 38rem;">
 
 <div>
 <img class="card-img-top" style="max-width: 18rem;  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 90%;" alt="Card image cap" src="<?php echo site_url(); ?>assets/images/<?php echo $book->image; ?>">
 </div>
 <div class="card-body" style="text-align: center;">



    <h3><?php echo $book->title; ?></h3> 
    <p style="margin-top: .7rem;">ecrit par <?php echo $book->autor; ?></p>
   <p class="card-text" style="margin-top: .7rem;"><?php echo word_limiter($book->description, 60); ?></p>
   <p style="margin-top: .7rem;"><?php echo $book->price; ?>$</p>
   <?php foreach($tags as $tag) : ?>
    <button class="btn btn-secondary" style="margin-top: .7rem;"><?php echo $tag->name; ?>"</button>
    <?php endforeach ?>

 </div>
</div>
<div>

<div id="comment_section"style="margin-top: 2rem;">
    <div>
<h4>Comment</h4>
<div  id="comments" style="margin-top: 2rem;">

</div>
    </div>
    <div>
<div id="comment_container" style="margin-top: 2rem;">
<form id="saveComment" method="post">
<div class="form-group">
      
        <div class="col-md-10">
        <textarea class="form-control" placeholder="comment" id="comment" name="comment" rows="3" "></textarea>
        </div>
        <input type="hidden" id="id" name="id" value="<?php echo $book->id; ?>">
</div>
<button type="submit" class="btn btn-primary mt-4" >comment</button>

</form>

</div>
    </div>
</div>
<div class="btn" id="show_comment">show comment</div>
<div>            <form id="deleteBook">
              <input type="hidden" name="bookId" id="deleteBookId" value="<?php echo $book->id; ?>">
              <button type="submit" class="btn btn-danger mt-4" >remove</button>
            </form>
    </div>
</div>
