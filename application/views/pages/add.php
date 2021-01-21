<div>
<div>



</div>
<div class="" >


<?php echo validation_errors(); ?>

<?php echo form_open_multipart('books/create'); ?>

                        
                     
<div class="form-group ">
    <label class="col-md-2 col-form-label" for="address">Title</label>
    <div class="col-md-10">
    <input type="text" class="form-control" id="title" name="title" placeholder="title" ">
    </div>
</div>
<div class="form-group ">
    <label class="col-md-2 col-form-label" for="address">Autor</label>
    <div class="col-md-10">
    <input type="text" class="form-control" id="autor" name="autor" placeholder="autor" ">
    </div>
</div>

<div class="form-group">
      
        <label class="col-md-2 col-form-label" for="description">Description</label>
        <div class="col-md-10">
        <textarea class="form-control" placeholder="description" id="description" name="description" rows="3" "></textarea>
        </div>
    
</div>



<div class="form-group ">
    <label class="col-md-2 col-form-label"  for="address">Price</label>
    <div  class="col-md-10">
    <input type="number" class="form-control" id="autor" name="price" placeholder="price" ">
    </div>
</div>



    
    <div class=" form-group">
        <div class=" custom-file">
            <label  for="image" class="custom-file-label">Image</label>
        </div>
  
        <input type="file" name="userfile" size="20" />
    </div>

 
<div class=" form-group" >
<label class="col-md-2 col-form-label"  for="address">Tag</label>
<div class="col-md-10">
<select class="form-select mt-8"  multiple size="6" name="tags[]" >

<?php foreach($tags as $tag) : ?>
  <option value="<?php echo $tag->id; ?>"><?php echo $tag->name; ?></option>
  <?php endforeach ?>
</select>
</div>
</div>






<button type="submit" class="btn btn-primary mt-4" >Add book</button>

</form>
</div>
            
     
</div>