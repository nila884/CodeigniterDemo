<?php $book=$books[0];  ?>

<h3>Edit</h3>

<div class="" >


<?php echo validation_errors(); ?>

<?php echo form_open_multipart('books/update'); ?>

                        
                     
<div class="form-group ">
    <label class="col-md-2 col-form-label" for="address">Title</label>
    <div class="col-md-10">
    <input type="text" class="form-control" id="title" name="title" placeholder="<?php echo $book->title; ?>" >
    </div>
</div>
<div class="form-group ">
    <label class="col-md-2 col-form-label" for="address">Autor</label>
    <div class="col-md-10">
    <input type="text" class="form-control" id="autor" name="autor" placeholder="<?php echo $book->autor; ?>" >
    </div>
</div>

<div class="form-group">
      
        <label class="col-md-2 col-form-label" for="description">Description</label>
        <div class="col-md-10">
        <textarea class="form-control"  id="description" name="description" rows="3" placeholder="<?php echo $book->description; ?>"></textarea>
        </div>
    
</div>



<div class="form-group ">
    <label class="col-md-2 col-form-label"  for="address">Price</label>
    <div  class="col-md-10">
    <input type="number" class="form-control" id="autor" name="price" placeholder="<?php echo $book->price; ?>">
    </div>
</div>



    
    <div class=" form-group">
        <div class=" custom-file">
            <label  for="image" class="custom-file-label">Image</label>
        </div>
  
        <input type="file" name="userfile" size="20" />
    </div>
    <div>
 <img class="card-img-top" style="max-width: 18rem;" alt="Card image cap" src="<?php echo site_url(); ?>assets/images/<?php echo $book->image; ?>">
 </div>
<div>
    related tag
<?php foreach($bookTags as $tag) : ?>
           <div><?php echo $tag->name; ?> <button>remove</button></div>
            <?php endforeach ?>
</div>
    <select multiple size="6" name="tags[]">
    <?php foreach($tags as $tag) : ?>
            <option value="<?php echo $tag->id; ?>"><?php echo $tag->name; ?></option>
            <?php endforeach ?>

</select>





<input type="hidden" id="id" name="id" value="<?php echo $book->id; ?>">
<button type="submit" class="btn btn-primary mt-4" >update</button>

</form>
</div>
            
     
</div>