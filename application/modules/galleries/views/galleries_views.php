<?php include VIEWPATH.'includes/Header.php'; ?>
<?php include VIEWPATH.'includes/Sidebar.php'; ?>

<div class="page-wrapper">
<div class="page-content">

<div class="page-breadcrumb d-flex align-items-center mb-3">
  <div class="breadcrumb-title pe-3">Admin</div>
  <div class="ps-3">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><i class="bx bx-home-alt"></i></li>
      <li class="breadcrumb-item active">Galerie</li>
    </ol>
  </div>
  <div class="ms-auto">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGallery">
      + Nouveau média
    </button>
  </div>
</div>

<?= $this->session->flashdata('sms'); ?>

<hr>

<div class="card">
<div class="card-body">
<div class="table-responsive">

<table id="example" class="table table-bordered align-middle">
<thead class="table-light">
<tr>
  <th>#</th>
  <th>Média</th>
  <th>Type</th>
  <th>Description</th>
  <th width="160">Actions</th>
</tr>
</thead>

<tbody>
<?php $i=1; foreach($galleries as $g): ?>
<tr>
  <td><?= $i++ ?></td>

  <td class="text-center">
    <?php if($g['TypeMedia']=='image'): ?>
      <img src="<?= base_url('attachments/gallery/'.$g['Media']) ?>" style="width:50px; height:50px; border-radius:50%;" class="rounded">

    <?php elseif($g['TypeMedia']=='video'): ?>
      <video width="80" controls muted>
        <source style="width:50px; height:50px; border-radius:50%;" src="<?= base_url('attachments/gallery/'.$g['Media']) ?>">
      </video>

    <?php else: ?>
      <a href="<?= $g['Media'] ?>" target="_blank" class="btn btn-sm btn-outline-primary">
        <i class="bx bx-link"></i> Ouvrir
      </a>
    <?php endif; ?>
  </td>

  <td>
    <span class="badge bg-info text-dark">
      <?= strtoupper($g['TypeMedia']) ?>
    </span>
  </td>

  <td><?= strip_tags($g['Description']) ?></td>

  
   <td>
          <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</button>
            <div class="dropdown-menu">
               <a class="dropdown-item text-info" href="javascript:void()" data-bs-toggle="modal" data-bs-target="#edit<?= $g['IdGallery'] ?>">Modifier</a>
                <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#delete<?= $g['IdGallery'] ?>">Supprimer</a>
             </div>
       </td>

</tr>
<?php endforeach; ?>
</tbody>
<tfoot>
	<tr>
  <th>#</th>
  <th>Média</th>
  <th>Type</th>
  <th>Description</th>
  <th width="160">Actions</th>
</tr>
</tfoot>
</table>

</div>
</div>
</div>

</div>
</div>

<!-- ================= MODALS ================= -->

<?php foreach($galleries as $g): ?>

<!-- EDIT -->
<div class="modal fade" id="edit<?= $g['IdGallery'] ?>" tabindex="-1">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<form method="post" action="<?= base_url('galleries/update') ?>" enctype="multipart/form-data">

<div class="modal-header">
  <h5 class="modal-title">Modifier média</h5>
  <button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
<input type="hidden" name="IdGallery" value="<?= $g['IdGallery'] ?>">
<input type="hidden" name="HiddenMedia" value="<?= $g['Media'] ?>">

<div class="mb-3">
  <label>Type</label>
  <select name="TypeMedia" class="form-control media-type" required>
    <option value="image" <?= $g['TypeMedia']=='image'?'selected':'' ?>>Image</option>
    <option value="video" <?= $g['TypeMedia']=='video'?'selected':'' ?>>Vidéo</option>
    <option value="link"  <?= $g['TypeMedia']=='link'?'selected':'' ?>>Lien</option>
  </select>
</div>

<div class="mb-3 media-file">
  <label>Fichier</label>
  <input type="file" name="Media" class="form-control">
</div>

<div class="mb-3 media-link">
  <label>Lien</label>
  <input type="text" name="Link" class="form-control" value="<?= $g['Media'] ?>">
</div>

<div class="mb-3">
  <label>Description</label>
  <textarea name="Description" class="form-control" rows="4"><?= $g['Description'] ?></textarea>
</div>

</div>

<div class="modal-footer">
  <button class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
  <button class="btn btn-primary">Enregistrer</button>
</div>

</form>
</div>
</div>
</div>

<!-- DELETE -->
<div class="modal fade" id="delete<?= $g['IdGallery'] ?>">
<div class="modal-dialog">
<div class="modal-content">

<form method="post" action="<?= base_url('galleries/delete') ?>">
<input type="hidden" name="IdGallery" value="<?= $g['IdGallery'] ?>">

<div class="modal-header">
  <h5 class="modal-title text-danger">Confirmation</h5>
</div>

<div class="modal-body">
  Voulez-vous vraiment supprimer ce média ?
</div>

<div class="modal-footer">
  <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
  <button class="btn btn-danger">Supprimer</button>
</div>

</form>
</div>
</div>
</div>

<?php endforeach; ?>

<!-- ADD -->
<div class="modal fade" id="addGallery">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<form method="post" action="<?= base_url('galleries/create') ?>" enctype="multipart/form-data">

<div class="modal-header">
  <h5 class="modal-title">Ajouter un média</h5>
</div>

<div class="modal-body">

<div class="mb-3">
  <label>Type</label>
  <select name="TypeMedia" class="form-control media-type" required>
    <option value="">-- Choisir --</option>
    <option value="image">Image</option>
    <option value="video">Vidéo</option>
    <option value="link">Lien</option>
  </select>
</div>

<div class="mb-3 media-file">
  <label>Fichier</label>
  <input type="file" name="Media" class="form-control">
</div>

<div class="mb-3 media-link">
  <label>Lien</label>
  <input type="text" name="Link" class="form-control">
</div>

<div class="mb-3">
  <label>Description</label>
  <textarea name="Description" class="form-control" rows="4"></textarea>
</div>

</div>

<div class="modal-footer">
  <button class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
  <button class="btn btn-success">Enregistrer</button>
</div>

</form>
</div>
</div>
</div>

<!-- JS -->
<script>
document.querySelectorAll('.modal').forEach(modal => {
  const type = modal.querySelector('.media-type');
  if (!type) return;

  const file = modal.querySelector('.media-file');
  const link = modal.querySelector('.media-link');

  function toggle(){
    if(type.value === 'link'){
      file.style.display = 'none';
      link.style.display = 'block';
    }else{
      file.style.display = 'block';
      link.style.display = 'none';
    }
  }

  type.addEventListener('change', toggle);
  toggle();
});
</script>

<?php include VIEWPATH.'includes/Footer.php'; ?>