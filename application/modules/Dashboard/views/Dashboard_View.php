<?php include VIEWPATH.'includes/Header.php'; ?>
<?php include VIEWPATH.'includes/Sidebar.php'; ?>

<?php
// Salutation selon l'heure
$hour = (int) date('G');
if ($hour < 12) {
    $greeting = 'Good morning';
} elseif ($hour < 18) {
    $greeting = 'Good afternoon';
} else {
    $greeting = 'Good evening';
}

$admin_name = $this->session->userdata('name') ? $this->session->userdata('name') : $this->session->userdata('user');
?>

<!--start page wrapper -->
<div class="page-wrapper">
<div class="page-content">

<?php if (!empty($this->session->flashdata('sms'))) {
    echo $this->session->flashdata('sms');
} ?>

<!-- ==================== Zone de bienvenue ==================== -->
<div class="welcome-hero d-sm-flex align-items-center justify-content-between">
    <div class="position-relative" style="z-index:1;">
        <div class="hero-date"><?= date('l, j F Y') ?></div>
        <h2><?= $greeting ?>, <?= html_escape($admin_name) ?> &#128075;</h2>
        <p class="mb-0">Welcome to your portfolio dashboard.</p>
    </div>
    <div class="mt-3 mt-sm-0 position-relative" style="z-index:1;">
        <a href="<?= base_url() ?>" target="_blank" class="btn btn-light btn-sm px-3">
            <i class='bx bx-globe me-1'></i>View Website
        </a>
    </div>
</div>

<!-- ==================== Statistiques principales ==================== -->
<div class="row g-3 mt-4">
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-primary-soft"><i class='bx bx-code-alt'></i></div>
                <div>
                    <div class="stat-value"><?= (int) $total_projects ?></div>
                    <div class="stat-label">Total Projects</div>
                    <div class="stat-sub"><?= (int) $published_projects ?> published &middot; <?= (int) $draft_projects ?> draft</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card stat-card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-music-soft"><i class='bx bx-music'></i></div>
                <div>
                    <div class="stat-value"><?= (int) $music_projects ?></div>
                    <div class="stat-label">Music Projects</div>
                    <div class="stat-sub"><?= (int) $music_tracks ?> tracks &middot; <?= (int) $music_videos ?> videos</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card stat-card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-teal-soft"><i class='bx bx-brain'></i></div>
                <div>
                    <div class="stat-value"><?= (int) $total_skills ?></div>
                    <div class="stat-label">Skills</div>
                    <div class="stat-sub"><?= (int) $total_technologies ?> technologies</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card stat-card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-amber-soft"><i class='bx bx-envelope'></i></div>
                <div>
                    <div class="stat-value"><?= (int) $unread_messages ?></div>
                    <div class="stat-label">Unread Messages</div>
                    <div class="stat-sub"><?= (int) $total_messages ?> total received</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==================== Projects Overview + My Profile ==================== -->
<div class="row g-3 mt-1">
    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="section-title">Projects Overview</h6>
                <span class="text-muted small"><?= (int) $total_projects ?> project<?= ($total_projects == 1) ? '' : 's' ?></span>
            </div>
            <div class="card-body">
                <?php if ($total_projects > 0) { ?>
                <div class="row align-items-center">
                    <div class="col-sm-5">
                        <canvas id="projectsOverviewChart" height="210"></canvas>
                    </div>
                    <div class="col-sm-7 mt-3 mt-sm-0">
                        <?php
                        $types = array(
                            array('label' => 'IT Projects',    'count' => $it_projects,    'color' => '#4f46e5'),
                            array('label' => 'Music Projects', 'count' => $music_projects, 'color' => '#db2777'),
                            array('label' => 'Other Projects', 'count' => $other_projects, 'color' => '#94a3b8'),
                        );
                        ?>
                        <?php foreach ($types as $t) { 
                            $pct = ($total_projects > 0) ? round(($t['count'] / $total_projects) * 100) : 0;
                        ?>
                        <div class="d-flex align-items-center justify-content-between border-bottom py-2">
                            <div class="d-flex align-items-center gap-2">
                                <span style="width:10px;height:10px;border-radius:50%;background:<?= $t['color'] ?>;display:inline-block;"></span>
                                <span class="small text-muted"><?= $t['label'] ?></span>
                            </div>
                            <div>
                                <strong><?= (int) $t['count'] ?></strong>
                                <small class="text-muted ms-1"><?= $pct ?>%</small>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php } else { ?>
                <div class="empty-state">
                    <i class='bx bx-folder-open'></i>
                    <span>No projects yet</span>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card h-100 profile-card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="section-title">My Profile</h6>
            </div>
            <div class="card-body">
                <?php if (!empty($profile)) { ?>
                    <div class="position-relative d-inline-block">
                        <?php if (!empty($profile['profile_image'])) { ?>
                            <img src="<?= base_url('attachments/profile/' . $profile['profile_image']) ?>"
                                 class="profile-avatar" alt="profile"
                                 onerror="this.style.display='none';document.getElementById('profileFallback').style.display='flex';">
                            <div id="profileFallback" class="profile-avatar-placeholder" style="display:none;">
                                <?= strtoupper(substr($profile['full_name'], 0, 1)) ?>
                            </div>
                        <?php } else { ?>
                            <div class="profile-avatar-placeholder">
                                <?= strtoupper(substr($profile['full_name'], 0, 1)) ?>
                            </div>
                        <?php } ?>
                    </div>
                    <h5 class="mt-3 mb-1 fw-bold"><?= html_escape($profile['full_name']) ?></h5>
                    <p class="text-muted small mb-3"><?= html_escape($profile['professional_title']) ?></p>

                    <div class="profile-meta mb-1">
                        <?php if (!empty($profile['location'])) { ?>
                        <div class="mb-1"><i class='bx bx-map'></i><?= html_escape($profile['location']) ?></div>
                        <?php } ?>
                        <?php if (!empty($profile['email'])) { ?>
                        <div class="mb-1"><i class='bx bx-envelope'></i><?= html_escape($profile['email']) ?></div>
                        <?php } ?>
                    </div>

                    <button type="button" class="btn btn-outline-primary btn-sm mt-3" disabled
                            title="Module Profile à venir">
                        <i class='bx bx-edit-alt me-1'></i>Edit Profile
                        <span class="soon-badge ms-1">Soon</span>
                    </button>
                <?php } else { ?>
                    <div class="empty-state">
                        <i class='bx bx-user'></i>
                        <span>No profile configured yet</span>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!-- ==================== Recent Projects + Recent Messages ==================== -->
<div class="row g-3 mt-1">
    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="section-title">Recent Projects</h6>
                <a href="javascript:;" class="small text-decoration-none menu-soon-link">View all</a>
            </div>
            <div class="card-body p-0">
                <?php if (!empty($recent_projects)) { ?>
                    <?php foreach ($recent_projects as $p) {
                        $type = ($p['project_type'] == 'MUSIC') ? 'music' : (($p['project_type'] == 'OTHER') ? 'other' : 'it');
                        $typeIcon = ($type == 'music') ? 'bx-music' : (($type == 'other') ? 'bx-package' : 'bx-code-curly');
                    ?>
                    <div class="d-flex gap-3 align-items-start p-3 border-bottom">
                        <div class="position-relative" style="width:56px;height:56px;flex-shrink:0;">
                            <div class="project-thumb-placeholder ph-<?= $type ?> position-absolute top-0 start-0 w-100 h-100">
                                <i class='bx <?= $typeIcon ?>'></i>
                            </div>
                            <?php if (!empty($p['image'])) { ?>
                            <img src="<?= base_url('attachments/projects/' . $p['image']) ?>"
                                 class="project-thumb position-absolute top-0 start-0 w-100 h-100"
                                 alt="" onerror="this.remove();">
                            <?php } ?>
                        </div>
                        <div class="flex-grow-1 min-width-0">
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <strong class="small"><?= html_escape($p['title']) ?></strong>
                                <span class="badge badge-type badge-type-<?= $type ?>"><?= $p['project_type'] ?></span>
                                <?php if ($p['status'] != 'published') { ?>
                                    <span class="badge bg-light text-dark border small-text"><?= ucfirst($p['status']) ?></span>
                                <?php } ?>
                            </div>
                            <?php if (!empty($p['short_description'])) { ?>
                            <div class="text-muted small mt-1"><?= html_escape(mb_substr($p['short_description'], 0, 90)) ?><?= (mb_strlen($p['short_description']) > 90) ? '…' : '' ?></div>
                            <?php } ?>
                            <?php if (!empty($p['technologies'])) { ?>
                            <div class="mt-1">
                                <?php foreach (explode(', ', $p['technologies']) as $tech) { ?>
                                    <span class="tech-chip"><?= html_escape($tech) ?></span>
                                <?php } ?>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="text-muted text-end" style="font-size:.74rem;white-space:nowrap;">
                            <?= date('d/m/Y', strtotime($p['created_at'])) ?>
                        </div>
                    </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="empty-state">
                        <i class='bx bx-folder-open'></i>
                        <span>No projects yet</span>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="section-title">Recent Messages</h6>
                <span class="badge badge-status-unread"><?= (int) $unread_messages ?> new</span>
            </div>
            <div class="card-body p-0">
                <?php if (!empty($recent_messages)) { ?>
                    <?php foreach ($recent_messages as $m) {
                        $isUnread = ($m['status'] == 'unread');
                        $excerpt = !empty($m['subject']) ? $m['subject'] : mb_substr($m['message'], 0, 70);
                    ?>
                    <div class="message-item <?= $isUnread ? 'unread' : '' ?>">
                        <div class="message-avatar"><?= strtoupper(substr($m['name'], 0, 1)) ?></div>
                        <div class="flex-grow-1 min-width-0">
                            <div class="d-flex justify-content-between gap-2">
                                <span class="msg-name text-truncate"><?= html_escape($m['name']) ?></span>
                                <span class="msg-date"><?= date('d/m H:i', strtotime($m['created_at'])) ?></span>
                            </div>
                            <div class="msg-subject text-truncate"><?= html_escape($excerpt) ?></div>
                            <span class="badge badge-status-<?= $m['status'] ?> mt-1"><?= $m['status'] ?></span>
                        </div>
                    </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="empty-state">
                        <i class='bx bx-envelope-open'></i>
                        <span>No messages yet</span>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!-- ==================== Quick Actions + Music Activity ==================== -->
<div class="row g-3 mt-1 mb-4">
    <div class="col-lg-5">
        <div class="card h-100">
            <div class="card-header">
                <h6 class="section-title">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-6 col-sm-3">
                        <a href="javascript:;" class="quick-action-btn disabled" title="Module Projects à venir">
                            <i class='bx bx-plus-circle'></i>Add Project
                        </a>
                    </div>
                    <div class="col-6 col-sm-3">
                        <a href="javascript:;" class="quick-action-btn disabled" title="Module Profile à venir">
                            <i class='bx bx-user-edit'></i>Edit Profile
                        </a>
                    </div>
                    <div class="col-6 col-sm-3">
                        <a href="<?= base_url() ?>" target="_blank" class="quick-action-btn">
                            <i class='bx bx-globe'></i>View Website
                        </a>
                    </div>
                    <div class="col-6 col-sm-3">
                        <a href="javascript:;" class="quick-action-btn disabled" title="Module Messages à venir">
                            <i class='bx bx-message-square-dots'></i>View Messages
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card h-100 music-card">
            <div class="card-body">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="music-icon-bubble"><i class='bx bxs-vinyl'></i></div>
                    <div>
                        <h6 class="section-title mb-0">Music Activity</h6>
                        <small class="text-muted">Your sound, your identity.</small>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-4">
                        <div class="music-stat">
                            <div class="value"><?= (int) $music_projects ?></div>
                            <div class="label">Music Projects</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="music-stat">
                            <div class="value"><?= (int) $music_tracks ?></div>
                            <div class="label">Tracks</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="music-stat">
                            <div class="value"><?= (int) $music_videos ?></div>
                            <div class="label">Videos</div>
                        </div>
                    </div>
                </div>
                <?php if ($music_projects == 0) { ?>
                <div class="text-center text-muted small mt-3 mb-0">
                    <i class='bx bx-info-circle me-1'></i>No music projects yet — add one with the type "MUSIC".
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

</div>
</div>
<!--end page wrapper -->

<?php
// Graphique Projects Overview — Chart.js local (assets/admin/plugins/chartjs)
if ($total_projects > 0) { ?>
<script src="<?= base_url() ?>assets/admin/plugins/chartjs/js/chart.js"></script>
<script>
(function () {
    var ctx = document.getElementById('projectsOverviewChart');
    if (!ctx || typeof Chart === 'undefined') return;

    new Chart(ctx.getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['IT', 'MUSIC', 'OTHER'],
            datasets: [{
                data: [<?= (int) $it_projects ?>, <?= (int) $music_projects ?>, <?= (int) $other_projects ?>],
                backgroundColor: ['#4f46e5', '#db2777', '#94a3b8'],
                borderWidth: 3,
                borderColor: '#ffffff',
                hoverOffset: 6
            }]
        },
        options: {
            maintainAspectRatio: true,
            cutout: '72%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            var label = context.label || '';
                            var value = context.parsed || 0;
                            return ' ' + label + ': ' + value;
                        }
                    }
                }
            }
        }
    });
})();
</script>
<?php } ?>

<style>
.min-width-0 { min-width: 0; }
.small-text { font-size: .68rem; }
</style>

<?php include VIEWPATH.'includes/Footer.php'; ?>
