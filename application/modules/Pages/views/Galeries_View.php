

<?php include VIEWPATH.'media/Header.php'; ?>
<?php include VIEWPATH.'media/navbar.php'; ?>



<div class="hero-bg" style="background-image: url('<?= base_url('assets/images/good.png') ?>')">
  <div class="hero-body text-center">
    <h1 class="hero-tete">Gallery</h1>
    <p class="hero-descr">Home/Gallery</p>
  </div>
</div>






<div class="container py-5">
  <h2 class="gallery-title text-center mb-4">Notre Galerie</h2>

  <div class="row g-4">
    <?php foreach($galleries as $g): ?>
      <div class="col-12 col-sm-6 col-lg-4">



<?php if ($g['TypeMedia'] == 'image'): ?>
  <div class="gallery-item">
    <img src="<?= base_url('attachments/gallery/'.$g['Media']) ?>"
         class="gallery-media img-fluid"
         alt="<?= htmlspecialchars($g['Description']) ?>">
    <span class="gallery-label"><?= htmlspecialchars($g['Description']) ?></span>
  </div>



<?php elseif ($g['TypeMedia'] == 'video'): ?>
  <div class="gallery-item position-relative">
    <video class="gallery-media" controls preload="metadata">
      <source src="<?= base_url('attachments/gallery/'.$g['Media']) ?>" type="video/mp4">
    </video>
    <span class="gallery-label"><?= htmlspecialchars($g['Description']) ?></span>
    <span class="video-icon d-none d-md-flex">
      <i class="fas fa-play"></i>
    </span>
  </div>




<?php elseif ($g['TypeMedia'] == 'link'): ?>
  <div class="gallery-item ratio ratio-16x9">
    <iframe src="<?= $g['Media'] ?>" allowfullscreen></iframe>
    <span class="gallery-label"><?= htmlspecialchars($g['Description']) ?></span>
  </div>
<?php endif; ?>



</div>
    <?php endforeach; ?>
  </div>
</div>



<?php include VIEWPATH.'media/Footer.php'; ?>

