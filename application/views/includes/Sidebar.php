<?php $topbar_unread = isset($unread_messages) ? (int) $unread_messages : 0; ?>
<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
<div class="sidebar-header">
<div>
<h4 class="logo-text mb-0">NTURO</h4>
</div>
<div>
<span class="text-muted small d-none d-sm-inline">Portfolio Admin</span>
</div>
<div class="mobile-toggle-icon ms-auto"><i class='bx bx-x'></i>
</div>
</div>
<!--navigation-->
<ul class="metismenu" id="menu">

<li>
	<a href="<?=base_url('Dashboard')?>" class="<?=($this->uri->segment(1)=='Dashboard')?'mm-active':''?>">
		<div class="parent-icon"><i class='bx bx-home-circle'></i></div>
		<div class="menu-title">Dashboard</div>
	</a>
</li>


<!-- PORTFOLIO -->
<li class="menu-label">Portfolio</li>

<li>
	<a href="<?=base_url('Profile')?>" class="<?=($this->uri->segment(1)=='Profile')?'mm-active':''?>">
		<div class="parent-icon"><i class='bx bx-user'></i></div>
		<div class="menu-title">Profile</div>
	</a>
</li>

<li>
	<a href="<?=base_url('Projects')?>" class="<?=($this->uri->segment(1)=='Projects')?'mm-active':''?>">
		<div class="parent-icon"><i class='bx bx-code-block'></i></div>
		<div class="menu-title">Projects</div>
	</a>
</li>

<li>
	<a href="<?=base_url('Skills')?>" class="<?=($this->uri->segment(1)=='Skills')?'mm-active':''?>">
		<div class="parent-icon"><i class='bx bx-brain'></i></div>
		<div class="menu-title">Skills</div>
	</a>
</li>

<li>
	<a href="<?=base_url('Experiences')?>" class="<?=($this->uri->segment(1)=='Experiences')?'mm-active':''?>">
		<div class="parent-icon"><i class='bx bx-briefcase-alt-2'></i></div>
		<div class="menu-title">Experience</div>
	</a>
</li>

<li>
	<a href="<?=base_url('Education')?>" class="<?=($this->uri->segment(1)=='Education')?'mm-active':''?>">
		<div class="parent-icon"><i class='bx bx-graduation'></i></div>
		<div class="menu-title">Education</div>
	</a>
</li>


<!-- MUSIC -->
<li class="menu-label">Music</li>

<li>
	<a href="javascript:;" class="menu-soon" title="Module à venir">
		<div class="parent-icon"><i class='bx bxs-vinyl'></i></div>
		<div class="menu-title">Music Projects</div>
		<span class="soon-badge">Soon</span>
	</a>
</li>

<li>
	<a href="javascript:;" class="menu-soon" title="Module à venir">
		<div class="parent-icon"><i class='bx bx-music'></i></div>
		<div class="menu-title">Productions</div>
		<span class="soon-badge">Soon</span>
	</a>
</li>


<!-- CONTENT -->
<li class="menu-label">Content</li>

<li>
	<a href="<?=base_url('Categories')?>" class="<?=($this->uri->segment(1)=='Categories')?'mm-active':''?>">
		<div class="parent-icon"><i class='bx bx-category'></i></div>
		<div class="menu-title">Categories</div>
	</a>
</li>

<li>
	<a href="<?=base_url('Technologies')?>" class="<?=($this->uri->segment(1)=='Technologies')?'mm-active':''?>">
		<div class="parent-icon"><i class='bx bx-chip'></i></div>
		<div class="menu-title">Technologies</div>
	</a>
</li>

<li>
	<a href="<?=base_url('ProjectTechnologies')?>" class="<?=($this->uri->segment(1)=='ProjectTechnologies')?'mm-active':''?>">
		<div class="parent-icon"><i class='bx bx-link-alt'></i></div>
		<div class="menu-title">Projets & Tech</div>
	</a>
</li>


<!-- COMMUNICATION -->
<li class="menu-label">Communication</li>

<li>
	<a href="javascript:;" class="menu-soon" title="Module à venir">
		<div class="parent-icon"><i class='bx bx-envelope'></i></div>
		<div class="menu-title">Messages</div>
		<?php if ($topbar_unread > 0) { ?><span class="badge bg-danger ms-auto"><?= $topbar_unread ?></span><?php } else { ?><span class="soon-badge">Soon</span><?php } ?>
	</a>
</li>


<!-- SYSTEM -->
<li class="menu-label">System</li>

<li>
	<a href="<?=base_url('Users')?>" class="<?=($this->uri->segment(1)=='Users')?'mm-active':''?>">
		<div class="parent-icon"><i class='bx bx-shield-quarter'></i></div>
		<div class="menu-title">Users</div>
	</a>
</li>

<li>
	<a href="javascript:;" class="menu-soon" title="Module à venir">
		<div class="parent-icon"><i class='bx bx-cog'></i></div>
		<div class="menu-title">Settings</div>
		<span class="soon-badge">Soon</span>
	</a>
</li>


<!-- ACCOUNT -->
<li class="menu-label">Account</li>

<li>
	<a href="<?=base_url('Logout')?>">
		<div class="parent-icon"><i class='bx bx-log-out-circle'></i></div>
		<div class="menu-title">Logout</div>
	</a>
</li>

</ul>
<!--end navigation-->
</div>
<!--end sidebar wrapper -->


<!--start header -->
<header>
<div class="topbar">
<nav class="navbar navbar-expand gap-2 align-items-center">
<div class="mobile-toggle-menu d-flex"><i class='bx bx-menu'></i>
</div>

  <div class="top-menu ms-auto">
	<ul class="navbar-nav align-items-center gap-1">

		<li class="nav-item dark-mode d-none d-sm-flex">
			<a class="nav-link dark-mode-icon" href="javascript:;"><i class='bx bx-moon'></i>
			</a>
		</li>

		<li class="nav-item dropdown dropdown-large">
			<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" data-bs-toggle="dropdown">
				<i class='bx bx-bell'></i>
				<?php if ($topbar_unread > 0) { ?>
				<span class="alert-count"><?= $topbar_unread ?></span>
				<?php } ?>
			</a>
			<div class="dropdown-menu dropdown-menu-end">
				<div class="msg-header">
					<p class="msg-header-title">Notifications</p>
					<p class="msg-header-badge"><?= $topbar_unread ?> New</p>
				</div>
				<div class="header-notifications-list px-3 py-2 text-center text-muted small">
					<?php if ($topbar_unread > 0) { ?>
						You have <?= $topbar_unread ?> unread message<?= ($topbar_unread == 1) ? '' : 's' ?>.
					<?php } else { ?>
						No new notifications.
					<?php } ?>
				</div>
			</div>
		</li>

		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
				<div class="d-flex align-items-center gap-2">
					<img src="<?=base_url()?>assets/admin/images/user.png" class="rounded-circle" width="34" height="34" alt="user avatar">
					<div class="d-none d-sm-block text-start">
						<p class="mb-0 fw-semibold small"><?=$this->session->userdata('user')?></p>
						<p class="mb-0 text-muted" style="font-size:.72rem;"><?=ucfirst($this->session->userdata('role'))?></p>
					</div>
				</div>
			</a>
			<ul class="dropdown-menu dropdown-menu-end">
				<li><a class="dropdown-item d-flex align-items-center" href="<?=base_url('Users')?>"><i class="bx bx-user fs-5"></i><span>Profil</span></a>
				</li>
				<li><a class="dropdown-item d-flex align-items-center" href="<?=base_url('Dashboard')?>"><i class="bx bx-home-circle fs-5"></i><span>Tableau de bord</span></a>
				</li>
				<li>
					<div class="dropdown-divider mb-0"></div>
				</li>
				<li><a class="dropdown-item d-flex align-items-center" href="<?=base_url('Logout')?>"><i class="bx bx-log-out-circle"></i><span>Déconnexion</span></a>
				</li>
			</ul>
		</li>

	</ul>
  </div>

</nav>
</div>
</header>
<!--end header -->
