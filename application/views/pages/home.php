
<div style="margin-top: 1rem;">
  <div>search by tag</div>
  <div>
    <ul class="nav">
      
      <?php foreach($tags as $tag) : ?>
            
            <li class="nav-item mr-3" style="margin-right: 1rem;margin-top: 1.4rem;"><a class="btn btn-secondary " href="/books/tag/<?php echo $tag->id; ?>"><?php echo $tag->name; ?></a></li>
            <?php endforeach ?>
    </ul>
  </div>
</div>

<div  style="max-width: 540px;  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 90%;background-color: #fff;">
<?php foreach($books as $book) : ?>





<div id="book" class="card mb-3" style="max-width: 540px;margin-top: 3rem;">
  <div class="row no-gutters">
    <div class="col-md-4">
    <a href="<?php echo site_url('/books/'.$book->id); ?>">
      <img src="<?php echo site_url(); ?>assets/images/<?php echo $book->image; ?>" class="card-img" alt="...">
    </a>
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?php echo $book->title; ?></h5>
        <h7>ecrit par <?php echo $book->autor; ?></h7>
        <p class="card-text"><?php echo word_limiter($book->description, 60); ?></p>
        <p class="card-text"><small class="text-muted"> <p><?php echo $book->price; ?></p></small></p>
        <div style="display: inline-flex;align-items: center;">

            <div style="margin-top: auto;margin-left: 1rem;">
            
            <a href="<?php echo site_url('/books/'.$book->id); ?>" class="btn btn-light">see</a>
            <a href="<?php echo site_url('/books/edit/'.$book->id); ?>" class="btn btn-dark"style="margin-left: 1rem;">update</a>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>


<?php endforeach; ?>
</div>