<?php include VIEWPATH.'includes/Header.php' ;?>
<?php include VIEWPATH.'includes/Sidebar.php' ;?>
<!--start page wrapper -->
<div class="page-wrapper">
<div class="page-content">
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
<div class="breadcrumb-title pe-3">Contenu</div>
<div class="ps-3">
<nav aria-label="breadcrumb">
<ol class="breadcrumb mb-0 p-0">
	<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
	</li>
	<li class="breadcrumb-item active" aria-current="page">Catégories</li>
</ol>
</nav>
</div>
<div class="ms-auto">
<a class="btn btn-outline-primary" href="javascript:;" data-bs-toggle="modal" data-bs-target="#IdCategory">Nouveau</a>
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
            <th>Nom </th>
            <th>Slug </th>
            <th>Description </th>
            <th>Statut </th>
            <th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php $i=1; foreach ($categories as $value) {  ?>
            <tr>
                <td><?=$i++;?></td>
                <td><?=$value['name']?></td>
                <td><code><?=$value['slug']?></code></td>
                <td><?=!empty($value['description']) ? $value['description'] : '—'?></td>
                <td>
                    <?php if ($value['status']=='active') { ?>
                    <span class="badge bg-success">Actif</span>
                    <?php } else { ?>
                    <span class="badge bg-danger">Inactif</span>
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
<h4 class="modal-title" id="myLargeModalLabel">Modifier la catégorie</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
</div>
<form action="<?=base_url('Categories/Update')?>" method="POST">
<input type="hidden" name="id" value="<?=$value['id']?>">
<div class="modal-body">
<div class="row">

<div class="mb-3 position-relative col-md-6">
<label class="form-label">Nom</label>
<input type="text" value="<?=$value['name']?>" class="form-control" name="name" placeholder="Nom de la catégorie" required="">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Slug <small class="text-muted">(laisser vide pour générer automatiquement)</small></label>
<input type="text" value="<?=$value['slug']?>" class="form-control" name="slug" placeholder="nom-categorie">
</div>
<div class="mb-3 position-relative col-md-12">
<label class="form-label">Description</label>
<textarea class="form-control" name="description" rows="3" placeholder="Description courte"><?=$value['description']?></textarea>
</div>
<div class="mb-3 position-relative col-md-12">
<label class="form-label">Statut</label>
<select class="form-control" name="status" required>
   <option value="active" <?=($value['status']=='active') ? 'selected' : '' ?>>Actif</option>
   <option value="inactive" <?=($value['status']=='inactive') ? 'selected' : '' ?>>Inactif</option>
</select>
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
<h4 class="modal-title" id="myLargeModalLabel">Voulez-vous vraiment supprimer cette catégorie ?</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
</div>
<form action="<?=base_url('Categories/Delete')?>" method="POST">
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
            <th>Nom </th>
            <th>Slug </th>
            <th>Description </th>
            <th>Statut </th>
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

<div class="modal fade" id="IdCategory" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myLargeModalLabel">Nouvelle catégorie</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
</div>
<form action="<?=base_url('Categories/Create')?>" method="POST">
<div class="modal-body">
<div class="row">
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Nom</label>
<input type="text" class="form-control" name="name" placeholder="Nom de la catégorie" required="">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Slug <small class="text-muted">(laisser vide pour générer automatiquement)</small></label>
<input type="text" class="form-control" name="slug" placeholder="nom-categorie">
</div>
<div class="mb-3 position-relative col-md-12">
<label class="form-label">Description</label>
<textarea class="form-control" name="description" rows="3" placeholder="Description courte"></textarea>
</div>
<div class="mb-3 position-relative col-md-12">
<label class="form-label">Statut</label>
<select class="form-control" name="status" required>
   <option value="active">Actif</option>
   <option value="inactive">Inactif</option>
</select>
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