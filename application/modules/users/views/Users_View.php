<?php include VIEWPATH.'includes/Header.php' ;?>
<?php include VIEWPATH.'includes/Sidebar.php' ;?>
<!--start page wrapper -->
<div class="page-wrapper">
<div class="page-content">
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
<div class="breadcrumb-title pe-3">Admin</div>
<div class="ps-3">
<nav aria-label="breadcrumb">
<ol class="breadcrumb mb-0 p-0">
	<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
	</li>
	<li class="breadcrumb-item active" aria-current="page">Utilisateurs</li>
</ol>
</nav>
</div>
<div class="ms-auto">
<a class="btn btn-outline-primary" href="javascript:;" data-bs-toggle="modal" data-bs-target="#IdUser">Nouveau</a>
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
            <th>Email </th>
            <th>Rôle </th>
            <th>Statut </th>
            <th>Créé le </th>
            <th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php $i=1; foreach ($users as $value) {  ?>
            <tr>
                <td><?=$i++;?></td>
                <td><?=$value['name']?></td>
                <td><?=$value['email']?></td>
                <td><?=ucfirst($value['role'])?></td>
                <td>
                    <?php if ($value['status']=='active') { ?>
                    <span class="badge bg-success">Actif</span>
                    <?php } else { ?>
                    <span class="badge bg-danger">Inactif</span>
                    <?php } ?>
                </td>
                <td><?=date('d/m/Y H:i', strtotime($value['created_at']))?></td>
                <td>
                   <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</button>
                   <div class="dropdown-menu">
                    <a class="dropdown-item text-info" href="javascript:void()"  data-bs-toggle="modal" data-bs-target="#update_<?=$value['id']?>">Modifier</a>
                    <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#delete_<?=$value['id']?>">Supprimer</a>

                    <a class="dropdown-item text-info" href="#" data-bs-toggle="modal" data-bs-target="#reset_<?=$value['id']?>">Initialiser le mot de passe</a>

                    <form action="<?=base_url('Users/ChangeStatus')?>" method="POST" class="status-form-<?=$value['id']?>">
                        <input type="hidden" name="id" value="<?=$value['id']?>">
                        <input type="hidden" name="status" value="<?=($value['status']=='active') ? 'inactive' : 'active'?>">
                    </form>
                    <a class="dropdown-item <?=($value['status']=='active') ? 'text-warning' : 'text-success'?>" href="javascript:void(0)" onclick="document.querySelector('.status-form-<?=$value['id']?>').submit();">
                        <?=($value['status']=='active') ? 'Désactiver' : 'Activer'?>
                    </a>
                   </div> 
                </td>
            </tr>


<div class="modal fade" id="update_<?=$value['id']?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myLargeModalLabel">Modifier l'utilisateur</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
</div>
<form action="<?=base_url('Users/Update')?>" method="POST" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$value['id']?>">
<div class="modal-body">
<div class="row">

<div class="mb-3 position-relative col-md-12">
<label class="form-label">Nom</label>
<input type="text" value="<?=$value['name']?>" class="form-control" name="name" placeholder="Nom complet" required="">
</div>
<div class="mb-3 position-relative col-md-12">
<label class="form-label">Email</label>
<input type="email" value="<?=$value['email']?>" class="form-control email-check" data-id="<?=$value['id']?>" name="email" placeholder="Email" required="">
<small class="emailMessage text-danger"></small>
</div>
<div class="mb-3 position-relative col-md-12">
<label class="form-label">Mot de passe <small class="text-muted">(laisser vide pour ne pas changer)</small></label>
<input type="password" class="form-control" name="password" placeholder="Nouveau mot de passe" >
</div>
<div class="mb-3 position-relative col-md-12">
<label class="form-label">Rôle</label>
<select class="form-control" name="role" required>
   <option value="admin" <?=($value['role']=='admin') ? 'selected' : '' ?>>Admin</option>
   <option value="editor" <?=($value['role']=='editor') ? 'selected' : '' ?>>Editor</option>
</select>
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
<h4 class="modal-title" id="myLargeModalLabel">Voulez-vous vraiment supprimer cet utilisateur ?</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
</div>
<form action="<?=base_url('Users/Delete')?>" method="POST">
<input type="hidden" name="id" value="<?=$value['id']?>">
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
<button type="submit" class="btn btn-info">Supprimer</button>  
</div>                   
</form>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="reset_<?=$value['id']?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myLargeModalLabel">Voulez-vous vraiment réinitialiser ce mot de passe ?</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
</div>
<form action="<?=base_url('Users/initialPWD')?>" method="POST">
<input type="hidden" name="id" value="<?=$value['id']?>">
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
<button type="submit" class="btn btn-info">Réinitialiser</button>  
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
            <th>Email </th>
            <th>Rôle </th>
            <th>Statut </th>
            <th>Créé le </th>
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

<div class="modal fade" id="IdUser" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="myLargeModalLabel">Nouvel utilisateur</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
</div>
<form action="<?=base_url('Users/Create')?>" method="POST" enctype="multipart/form-data">
<div class="modal-body">
<div class="row">
<div class="mb-3 position-relative col-md-12">
<label class="form-label">Nom</label>
<input type="text" class="form-control" name="name" placeholder="Nom complet" required="">
</div>
<div class="mb-3 position-relative col-md-12">
<label class="form-label">Email</label>
<input type="email" onkeyup="checkEmail(this.value)" class="form-control" name="email" placeholder="Email" required="">
<small id="emailMessage" class="text-danger"></small>
</div>
<div class="mb-3 position-relative col-md-12">
<label class="form-label">Mot de passe <small class="text-muted">(vide = Admin@2025)</small></label>
<input type="password" class="form-control" name="password" placeholder="Mot de passe" >
</div>
<div class="mb-3 position-relative col-md-12">
<label class="form-label">Rôle</label>
<select class="form-control" name="role" required>
   <option value="admin">Admin</option>
   <option value="editor">Editor</option>
</select>
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
<button type="submit" id="submitButton" class="btn btn-info">Enregistrer</button>  
</div>                   
</form>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<?php include VIEWPATH.'includes/Footer.php' ;?>

<script type="text/javascript">
  function checkEmail(email) {
    $.ajax({
      url: "<?=base_url('users/Users/checkEmail');?>",
      type: "POST",
      data: { email: email },
      success: function(data) {
        const emailMessage = $('#emailMessage');
        const submitButton = $('#submitButton');
        
        if (data === 'denied') {
          emailMessage.text('Cet email est déjà utilisé !');
          submitButton.prop('disabled', true);
        } else {
          emailMessage.text('');
          submitButton.prop('disabled', false);
        }
      },
      error: function() {
        console.error('Une erreur est survenue lors de la vérification de l\'email.');
      }
    });
  }

  $(document).on('keyup', '.email-check', function() {
    const input = $(this);
    const message = input.closest('div').find('.emailMessage');
    if (!input.val()) { message.text(''); return; }
    $.ajax({
      url: "<?=base_url('users/Users/checkEmail');?>",
      type: "POST",
      data: { email: input.val(), id: input.data('id') },
      success: function(data) {
        if (data === 'denied') {
          message.text('Cet email est déjà utilisé !');
        } else {
          message.text('');
        }
      }
    });
  });
</script>
