Home page
<?php require_once APPROOT . '/views/inc/header.php' ?>
<h1> <?php echo $data['title']; ?> </h1>
<ul>
  <?php foreach ($data['posts'] as $post) : ?>
    <li>num: <?php echo $post->id; ?> # <?php echo $post->title; ?></li>
  <?php endforeach; ?>
</ul>

<?php require_once APPROOT . '/views/inc/footer.php' ?>