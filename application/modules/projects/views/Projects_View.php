<?php include VIEWPATH.'includes/Header.php' ;?>
<?php include VIEWPATH.'includes/Sidebar.php' ;?>
<!--start page wrapper -->
<div class="page-wrapper">
<div class="page-content">
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
<div class="breadcrumb-title pe-3">Portfolio</div>
<div class="ps-3">
<nav aria-label="breadcrumb">
<ol class="breadcrumb mb-0 p-0">
	<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
	</li>
	<li class="breadcrumb-item active" aria-current="page">Projets</li>
</ol>
</nav>
</div>
<div class="ms-auto">
<a class="btn btn-outline-primary" href="javascript:;" data-bs-toggle="modal" data-bs-target="#IdProject">Nouveau</a>
</div>
</div>
<!--end breadcrumb-->

<?php if (!empty($this->session->flashdata('sms'))) {
    echo $this->session->flashdata('sms');
} ?>

<hr/>
<div class="card">
<div class="card-body">
<div class="table-responsive">
<table id="example" class="table table-striped table-bordered table-hover" style="width:100%">
	<thead>
		<tr>
			<th>#</th>
            <th>Image </th>
            <th>Titre </th>
            <th>Catégorie </th>
            <th>Type </th>
            <th>Statut </th>
            <th>À la une </th>
            <th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php $i=1; foreach ($projects as $value) {  ?>
            <tr>
                <td><?=$i++;?></td>
                <td>
                    <?php if (!empty($value['image'])) { ?>
                    <img src="<?=base_url($value['image'])?>" alt="image" class="rounded" style="width:42px;height:42px;object-fit:cover;">
                    <?php } else { ?>
                    <span class="text-muted">—</span>
                    <?php } ?>
                </td>
                <td><?=$value['title']?></td>
                <td><?=!empty($value['category_name']) ? $value['category_name'] : '—'?></td>
                <td>
                    <?php if ($value['project_type']=='IT') { ?>
                    <span class="badge bg-primary">IT</span>
                    <?php } elseif ($value['project_type']=='MUSIC') { ?>
                    <span class="badge bg-warning text-dark">MUSIC</span>
                    <?php } else { ?>
                    <span class="badge bg-secondary">OTHER</span>
                    <?php } ?>
                </td>
                <td>
                    <?php if ($value['status']=='published') { ?>
                    <span class="badge bg-success">Publié</span>
                    <?php } elseif ($value['status']=='draft') { ?>
                    <span class="badge bg-secondary">Brouillon</span>
                    <?php } else { ?>
                    <span class="badge bg-danger">Archivé</span>
                    <?php } ?>
                </td>
                <td>
                    <?php if ($value['featured']=='1') { ?>
                    <i class='bx bxs-star text-warning fs-5'></i>
                    <?php } else { ?>
                    <span class="text-muted">—</span>
                    <?php } ?>
                </td>
                <td>
                   <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</button>
                   <div class="dropdown-menu">
                    <a class="dropdown-item text-info" href="javascript:void()"  data-bs-toggle="modal" data-bs-target="#update_<?=$value['id']?>">Modifier</a>
                    <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#delete_<?=$value['id']?>">Supprimer</a>
                   </div>
                </td>
            </tr>


<div class="modal fade" id="update_<?=$value['id']?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myLargeModalLabel">Modifier le projet</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
</div>
<form action="<?=base_url('Projects/Update')?>" method="POST" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$value['id']?>">
<div class="modal-body">
<div class="row">

<div class="mb-3 position-relative col-md-12">
<label class="form-label">Titre</label>
<input type="text" value="<?=$value['title']?>" class="form-control" name="title" placeholder="Titre du projet" required="">
</div>
<div class="mb-3 position-relative col-md-12">
<label class="form-label">Slug <small class="text-muted">(laisser vide pour générer automatiquement)</small></label>
<input type="text" value="<?=$value['slug']?>" class="form-control" name="slug" placeholder="mon-projet">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Catégorie</label>
<select class="form-control" name="category_id">
   <option value="">— Aucune —</option>
   <?php if (!empty($categories)) { foreach ($categories as $cat) { ?>
   <option value="<?=$cat['id']?>" <?=($value['category_id']==$cat['id']) ? 'selected' : '' ?>><?=$cat['name']?></option>
   <?php } } ?>
</select>
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Type de projet</label>
<select class="form-control" name="project_type" required>
   <option value="IT" <?=($value['project_type']=='IT') ? 'selected' : '' ?>>Informatique (IT)</option>
   <option value="MUSIC" <?=($value['project_type']=='MUSIC') ? 'selected' : '' ?>>Musique</option>
   <option value="OTHER" <?=($value['project_type']=='OTHER') ? 'selected' : '' ?>>Autre</option>
</select>
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Statut</label>
<select class="form-control" name="status" required>
   <option value="draft" <?=($value['status']=='draft') ? 'selected' : '' ?>>Brouillon</option>
   <option value="published" <?=($value['status']=='published') ? 'selected' : '' ?>>Publié</option>
   <option value="archived" <?=($value['status']=='archived') ? 'selected' : '' ?>>Archivé</option>
</select>
</div>
<div class="mb-3 position-relative col-md-6 d-flex align-items-end">
<div class="form-check form-switch mt-4">
<input type="checkbox" class="form-check-input" name="featured" value="1" <?=($value['featured']=='1') ? 'checked' : '' ?>>
<label class="form-check-label">À la une</label>
</div>
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Date de début</label>
<input type="date" value="<?=$value['start_date']?>" class="form-control" name="start_date">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Date de fin</label>
<input type="date" value="<?=$value['end_date']?>" class="form-control" name="end_date">
</div>
<div class="mb-3 position-relative col-md-12">
<label class="form-label">Courte description</label>
<textarea class="form-control" name="short_description" rows="2" maxlength="500" placeholder="Résumé du projet (max 500 caractères)"><?=$value['short_description']?></textarea>
</div>
<div class="mb-3 position-relative col-md-12">
<label class="form-label">Description détaillée</label>
<textarea class="form-control" name="description" rows="4" placeholder="Description complète"><?=$value['description']?></textarea>
</div>
<div class="mb-3 position-relative col-md-12">
<label class="form-label">Image du projet</label>
<?php if (!empty($value['image'])) { ?>
<div class="mb-2">
<img src="<?=base_url($value['image'])?>" alt="image" class="rounded" style="width:70px;height:70px;object-fit:cover;">
</div>
<?php } ?>
<input type="file" class="form-control" name="image" accept="image/*">
<small class="text-muted">Laisser vide pour conserver l'image actuelle.</small>
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">GitHub</label>
<input type="url" value="<?=$value['github_url']?>" class="form-control" name="github_url" placeholder="https://github.com/...">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Démo</label>
<input type="url" value="<?=$value['demo_url']?>" class="form-control" name="demo_url" placeholder="https://...">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Audio</label>
<input type="url" value="<?=$value['audio_url']?>" class="form-control" name="audio_url" placeholder="https://...audio">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Vidéo</label>
<input type="url" value="<?=$value['video_url']?>" class="form-control" name="video_url" placeholder="https://...video">
</div>

</div>

</div>

<div class="modal-footer">
<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
<button type="submit" class="btn btn-info">Enregistrer</button>
</div>
</form>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="delete_<?=$value['id']?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myLargeModalLabel">Voulez-vous vraiment supprimer ce projet ?</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
</div>
<form action="<?=base_url('Projects/Delete')?>" method="POST">
<input type="hidden" name="id" value="<?=$value['id']?>">
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
<button type="submit" class="btn btn-info">Supprimer</button>
</div>
</form>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php } ?>
	</tbody>
	<tfoot>
      <tr>
         <th>#</th>
            <th>Image </th>
            <th>Titre </th>
            <th>Catégorie </th>
            <th>Type </th>
            <th>Statut </th>
            <th>À la une </th>
            <th>Action</th>
      </tr>
	</tfoot>
</table>
</div>
</div>
</div>

<hr/>
</div>
</div>
<!--end page wrapper -->

<div class="modal fade" id="IdProject" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myLargeModalLabel">Nouveau projet</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
</div>
<form action="<?=base_url('Projects/Create')?>" method="POST" enctype="multipart/form-data">
<div class="modal-body">
<div class="row">
<div class="mb-3 position-relative col-md-12">
<label class="form-label">Titre</label>
<input type="text" class="form-control" name="title" placeholder="Titre du projet" required="">
</div>
<div class="mb-3 position-relative col-md-12">
<label class="form-label">Slug <small class="text-muted">(laisser vide pour générer automatiquement)</small></label>
<input type="text" class="form-control" name="slug" placeholder="mon-projet">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Catégorie</label>
<select class="form-control" name="category_id">
   <option value="">— Aucune —</option>
   <?php if (!empty($categories)) { foreach ($categories as $cat) { ?>
   <option value="<?=$cat['id']?>"><?=$cat['name']?></option>
   <?php } } ?>
</select>
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Type de projet</label>
<select class="form-control" name="project_type" required>
   <option value="IT">Informatique (IT)</option>
   <option value="MUSIC">Musique</option>
   <option value="OTHER">Autre</option>
</select>
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Statut</label>
<select class="form-control" name="status" required>
   <option value="draft">Brouillon</option>
   <option value="published">Publié</option>
   <option value="archived">Archivé</option>
</select>
</div>
<div class="mb-3 position-relative col-md-6 d-flex align-items-end">
<div class="form-check form-switch mt-4">
<input type="checkbox" class="form-check-input" name="featured" value="1">
<label class="form-check-label">À la une</label>
</div>
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Date de début</label>
<input type="date" class="form-control" name="start_date">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Date de fin</label>
<input type="date" class="form-control" name="end_date">
</div>
<div class="mb-3 position-relative col-md-12">
<label class="form-label">Courte description</label>
<textarea class="form-control" name="short_description" rows="2" maxlength="500" placeholder="Résumé du projet (max 500 caractères)"></textarea>
</div>
<div class="mb-3 position-relative col-md-12">
<label class="form-label">Description détaillée</label>
<textarea class="form-control" name="description" rows="4" placeholder="Description complète"></textarea>
</div>
<div class="mb-3 position-relative col-md-12">
<label class="form-label">Image du projet</label>
<input type="file" class="form-control" name="image" accept="image/*">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">GitHub</label>
<input type="url" class="form-control" name="github_url" placeholder="https://github.com/...">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Démo</label>
<input type="url" class="form-control" name="demo_url" placeholder="https://...">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Audio</label>
<input type="url" class="form-control" name="audio_url" placeholder="https://...audio">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Vidéo</label>
<input type="url" class="form-control" name="video_url" placeholder="https://...video">
</div>

</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
<button type="submit" class="btn btn-info">Enregistrer</button>
</div>
</form>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<?php include VIEWPATH.'includes/Footer.php' ;?>