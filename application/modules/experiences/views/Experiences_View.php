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
	<li class="breadcrumb-item active" aria-current="page">Expériences</li>
</ol>
</nav>
</div>
<div class="ms-auto">
<a class="btn btn-outline-primary" href="javascript:;" data-bs-toggle="modal" data-bs-target="#IdExperience">Nouveau</a>
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
            <th>Titre </th>
            <th>Organisation </th>
            <th>Localisation </th>
            <th>Type </th>
            <th>Période </th>
            <th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php $i=1; foreach ($experiences as $value) {
        $debut = !empty($value['start_date']) ? date('d/m/Y', strtotime($value['start_date'])) : '—';
        $fin   = ($value['current']=='1') ? 'En cours' : (!empty($value['end_date']) ? date('d/m/Y', strtotime($value['end_date'])) : '—');
    ?>
            <tr>
                <td><?=$i++;?></td>
                <td><?=$value['title']?></td>
                <td><?=!empty($value['organization']) ? $value['organization'] : '—'?></td>
                <td><?=!empty($value['location']) ? $value['location'] : '—'?></td>
                <td>
                    <?php
                    $labels = array(
                        'Work'       => 'Emploi',
                        'Internship' => 'Stage',
                        'Freelance'  => 'Freelance',
                        'Volunteer'  => 'Bénévolat',
                        'Project'    => 'Projet',
                        'Other'      => 'Autre'
                    );
                    $label = isset($labels[$value['type']]) ? $labels[$value['type']] : $value['type'];
                    ?>
                    <span class="badge bg-secondary"><?=$label?></span>
                </td>
                <td><?=$debut?> → <?=$fin?></td>
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
<h4 class="modal-title" id="myLargeModalLabel">Modifier cette expérience</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
</div>
<form action="<?=base_url('Experiences/Update')?>" method="POST">
<input type="hidden" name="id" value="<?=$value['id']?>">
<div class="modal-body">
<div class="row">

<div class="mb-3 position-relative col-md-6">
<label class="form-label">Titre</label>
<input type="text" value="<?=$value['title']?>" class="form-control" name="title" placeholder="Ex : Développeur Full Stack" required="">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Organisation</label>
<input type="text" value="<?=$value['organization']?>" class="form-control" name="organization" placeholder="Ex : NTURO Tech">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Localisation</label>
<input type="text" value="<?=$value['location']?>" class="form-control" name="location" placeholder="Ex : Bujumbura">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Type</label>
<select class="form-control" name="type" required>
   <option value="Work" <?=($value['type']=='Work') ? 'selected' : '' ?>>Emploi</option>
   <option value="Internship" <?=($value['type']=='Internship') ? 'selected' : '' ?>>Stage</option>
   <option value="Freelance" <?=($value['type']=='Freelance') ? 'selected' : '' ?>>Freelance</option>
   <option value="Volunteer" <?=($value['type']=='Volunteer') ? 'selected' : '' ?>>Bénévolat</option>
   <option value="Project" <?=($value['type']=='Project') ? 'selected' : '' ?>>Projet</option>
   <option value="Other" <?=($value['type']=='Other') ? 'selected' : '' ?>>Autre</option>
</select>
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
<div class="form-check form-switch mt-2">
<input type="checkbox" class="form-check-input" name="current" value="1" <?=($value['current']=='1') ? 'checked' : '' ?>>
<label class="form-check-label">En cours actuellement</label>
</div>
</div>
<div class="mb-3 position-relative col-md-12">
<label class="form-label">Description</label>
<textarea class="form-control" name="description" rows="3" placeholder="Description courte"><?=$value['description']?></textarea>
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
<h4 class="modal-title" id="myLargeModalLabel">Voulez-vous vraiment supprimer cette expérience ?</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
</div>
<form action="<?=base_url('Experiences/Delete')?>" method="POST">
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
            <th>Titre </th>
            <th>Organisation </th>
            <th>Localisation </th>
            <th>Type </th>
            <th>Période </th>
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

<div class="modal fade" id="IdExperience" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myLargeModalLabel">Nouvelle expérience</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
</div>
<form action="<?=base_url('Experiences/Create')?>" method="POST">
<div class="modal-body">
<div class="row">
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Titre</label>
<input type="text" class="form-control" name="title" placeholder="Ex : Développeur Full Stack" required="">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Organisation</label>
<input type="text" class="form-control" name="organization" placeholder="Ex : NTURO Tech">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Localisation</label>
<input type="text" class="form-control" name="location" placeholder="Ex : Bujumbura">
</div>
<div class="mb-3 position-relative col-md-6">
<label class="form-label">Type</label>
<select class="form-control" name="type" required>
   <option value="Work">Emploi</option>
   <option value="Internship">Stage</option>
   <option value="Freelance">Freelance</option>
   <option value="Volunteer">Bénévolat</option>
   <option value="Project">Projet</option>
   <option value="Other">Autre</option>
</select>
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
<div class="form-check form-switch mt-2">
<input type="checkbox" class="form-check-input" name="current" value="1">
<label class="form-check-label">En cours actuellement</label>
</div>
</div>
<div class="mb-3 position-relative col-md-12">
<label class="form-label">Description</label>
<textarea class="form-control" name="description" rows="3" placeholder="Description courte"></textarea>
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