
<div class="navbar-inner">
    <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <a class="brand" href="<?php echo Router::get('backend'); ?>">Backend - Burolike (<?php echo Auth::group()->get_name(); ?>)</a>
        <div class="nav-collapse collapse">
            <ul class="nav">
                <li>
                    <a href="/migration/backend/migration"><i class="icon icon-white icon-tasks"></i> Voir toutes les migrations</a>
                </li>        
            </ul>

            <ul class="nav pull-right">
                <li>
                    <a href="<?php echo Router::get('home'); ?>"><i class="icon icon-white icon-globe"></i> Aller sur le site</a>
                </li>
                <?php 
                    $userId = Auth::instance()->get_user_id();
                    if ($userId[1] != '0'): ?>
                    <li><a href="<?php echo Router::get('backend_logout'); ?>"><i class="icon icon-white icon-remove"></i> Déconnexion</a></li>
                <?php endif; ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>