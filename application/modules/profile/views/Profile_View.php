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
	<li class="breadcrumb-item active" aria-current="page">Profile</li>
</ol>
</nav>
</div>
<div class="ms-auto">
<a class="btn btn-outline-primary" href="javascript:;" data-bs-toggle="modal" data-bs-target="#IdProfile">Nouveau</a>
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
            <th>Photo </th>
            <th>Nom complet </th>
            <th>Titre pro </th>
            <th>Email </th>
            <th>Téléphone </th>
            <th>CV </th>
            <th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php $i=1; foreach ($profiles as $value) {  ?>
            <tr>
                <td><?=$i++;?></td>
                <td>
                    <?php if (!empty($value['profile_image'])) { ?>
                    <img src="<?=base_url($value['profile_image'])?>" alt="photo" class="rounded" style="width:42px;height:42px;object-fit:cover;">
                    <?php } else { ?>
                    <img src="<?=base_url()?>assets/admin/images/user.png" alt="photo" class="rounded" style="width:42px;height:42px;object-fit:cover;">
                    <?php } ?>
                </td>
                <td><?=$value['full_name']?></td>
                <td><?=!empty($value['professional_title']) ? $value['professional_title'] : '—'?></td>
                <td><?=!empty($value['email']) ? $value['email'] : '—'?></td>
                <td><?=!empty($value['phone']) ? $value['phone'] : '—'?></td>
                <td>
                    <?php if (!empty($value['cv_file'])) { ?>
                    <a href="<?=base_url($value['cv_file'])?>" target="_blank" class="btn btn-sm btn-outline-info">Voir</a>
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
<h4 class="modal-title" id="myLargeModalLabel">Modifier le profil</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
</div>
<form action="<?=base_url('Profile/Update')?>" method="POST" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$value['id']?>">
<div class="modal-body">
<div class="row">

<div class="mb-3 position-relative col-md-6">
<label class="form-label">Nom complet</label>
<input type="text" value="<?=$value['full_name']?>" class="form-control" name="full_name" placeholder="Nom complet" required="">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Titre professionnel</label>
<input type="text" value="<?=$value['professional_title']?>" class="form-control" name="professional_title" placeholder="Ex : Développeur & Producteur">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Email</label>
<input type="email" value="<?=$value['email']?>" class="form-control" name="email" placeholder="Email">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Téléphone</label>
<input type="text" value="<?=$value['phone']?>" class="form-control" name="phone" placeholder="Téléphone">
</div>
<div class="mb-3 position-relative col-md-12">
<label class="form-label">Localisation</label>
<input type="text" value="<?=$value['location']?>" class="form-control" name="location" placeholder="Ex : Bujumbura, Burundi">
</div>
<div class="mb-3 position-relative col-md-12">
<label class="form-label">Brève présentation</label>
<textarea class="form-control" name="short_bio" rows="2" placeholder="Courte bio (résumé)"><?=$value['short_bio']?></textarea>
</div>
<div class="mb-3 position-relative col-md-12">
<label class="form-label">À propos</label>
<textarea class="form-control" name="about" rows="4" placeholder="Description détaillée"><?=$value['about']?></textarea>
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Photo de profil</label>
<?php if (!empty($value['profile_image'])) { ?>
<div class="mb-2">
<img src="<?=base_url($value['profile_image'])?>" alt="photo" class="rounded" style="width:70px;height:70px;object-fit:cover;">
</div>
<?php } ?>
<input type="file" class="form-control" name="profile_image" accept="image/*">
<small class="text-muted">Laisser vide pour conserver l'image actuelle.</small>
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">CV (PDF / DOC)</label>
<?php if (!empty($value['cv_file'])) { ?>
<div class="mb-2">
<a href="<?=base_url($value['cv_file'])?>" target="_blank" class="btn btn-sm btn-outline-info">Voir le CV actuel</a>
</div>
<?php } ?>
<input type="file" class="form-control" name="cv_file" accept=".pdf,.doc,.docx">
<small class="text-muted">Laisser vide pour conserver le CV actuel.</small>
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">GitHub</label>
<input type="url" value="<?=$value['github_url']?>" class="form-control" name="github_url" placeholder="https://github.com/...">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">LinkedIn</label>
<input type="url" value="<?=$value['linkedin_url']?>" class="form-control" name="linkedin_url" placeholder="https://linkedin.com/in/...">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Facebook</label>
<input type="url" value="<?=$value['facebook_url']?>" class="form-control" name="facebook_url" placeholder="https://facebook.com/...">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">YouTube</label>
<input type="url" value="<?=$value['youtube_url']?>" class="form-control" name="youtube_url" placeholder="https://youtube.com/...">
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
<h4 class="modal-title" id="myLargeModalLabel">Voulez-vous vraiment supprimer ce profil ?</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
</div>
<form action="<?=base_url('Profile/Delete')?>" method="POST">
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
            <th>Photo </th>
            <th>Nom complet </th>
            <th>Titre pro </th>
            <th>Email </th>
            <th>Téléphone </th>
            <th>CV </th>
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

<div class="modal fade" id="IdProfile" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myLargeModalLabel">Nouveau profil</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
</div>
<form action="<?=base_url('Profile/Create')?>" method="POST" enctype="multipart/form-data">
<div class="modal-body">
<div class="row">
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Nom complet</label>
<input type="text" class="form-control" name="full_name" placeholder="Nom complet" required="">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Titre professionnel</label>
<input type="text" class="form-control" name="professional_title" placeholder="Ex : Développeur & Producteur">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Email</label>
<input type="email" class="form-control" name="email" placeholder="Email">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Téléphone</label>
<input type="text" class="form-control" name="phone" placeholder="Téléphone">
</div>
<div class="mb-3 position-relative col-md-12">
<label class="form-label">Localisation</label>
<input type="text" class="form-control" name="location" placeholder="Ex : Bujumbura, Burundi">
</div>
<div class="mb-3 position-relative col-md-12">
<label class="form-label">Brève présentation</label>
<textarea class="form-control" name="short_bio" rows="2" placeholder="Courte bio (résumé)"></textarea>
</div>
<div class="mb-3 position-relative col-md-12">
<label class="form-label">À propos</label>
<textarea class="form-control" name="about" rows="4" placeholder="Description détaillée"></textarea>
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Photo de profil</label>
<input type="file" class="form-control" name="profile_image" accept="image/*">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">CV (PDF / DOC)</label>
<input type="file" class="form-control" name="cv_file" accept=".pdf,.doc,.docx">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">GitHub</label>
<input type="url" class="form-control" name="github_url" placeholder="https://github.com/...">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">LinkedIn</label>
<input type="url" class="form-control" name="linkedin_url" placeholder="https://linkedin.com/in/...">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Facebook</label>
<input type="url" class="form-control" name="facebook_url" placeholder="https://facebook.com/...">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">YouTube</label>
<input type="url" class="form-control" name="youtube_url" placeholder="https://youtube.com/...">
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