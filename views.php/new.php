<h2 class="h3 text-dark mb-4">OnePhraseの登録</h2>
<form action="create.php" method="post">
  <?php if (count($errors)) : ?>
    <ul class="text-danger">
      <?php foreach ($errors as $error) : ?>
        <li><?php echo $error; ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <div class="form-group">
    <label for="title">曲名</label>
    <input type="text" name="title" id="title" class="form-control" value="<?php echo $review['title'] ?>">
  </div>
  <div class="form-group">
    <label for="artist">アーティスト</label>
    <input type="text" name="artist" id="artist" class="form-control" value="<?php echo $review['artist'] ?>">
  </div>
  <div class="form-group">
    <label for="onephrase">OnePhrase</label>
    <input type="text" name="onephrase" id="onephrase" class="form-control" value="<?php echo $review['onephrase'] ?>">
  </div>
  <div class="form-group">
    <label for="age">年齢</label>
    <input type="number" name="age" id="age" class="form-control" value="<?php echo $review['age'] ?>">
  </div>
  <div class="form-group">
    <label for="summary">感想</label>
    <textarea type="text" name="summary" id="summary" class="form-control" rows="10"><?php echo $review['summary'] ?></textarea>
  </div>
  <button type="submit" class="btn btn-primary">登録する</button>
</form>
