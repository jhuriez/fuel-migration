<?php if (empty($migrationsVar)): ?>
    <?= __('migration.migration.empty'); ?>
<?php else: ?>
    <a href="<?= \Router::get('migration_backend_migration_migrate', array('migration' => 'all', 'type' => 'latest')); ?>" class="btn btn-primary"><?= __('migration.migrate.all'); ?></a>
    <a href="<?= \Router::get('migration_backend_migration_migrate', array('migration' => 'all', 'type' => 'current')); ?>" class="btn btn-info"><?= __('migration.migrate.all_current'); ?></a>

    <div class="pull-right">
      <a href="<?= \Router::get('migration_backend_migration_sync_array_from_db'); ?>" class="btn btn-danger"><?= __('migration.migrate.sync.array_from_db'); ?></a>
      <a href="<?= \Router::get('migration_backend_migration_sync_db_from_array'); ?>" class="btn btn-danger"><?= __('migration.migrate.sync.db_from_array'); ?></a>
    </div>
<hr>

<ul class="nav nav-tabs">
    <?php if(isset($migrationsVar['app'])): ?><li class="active"><a href="#app" data-toggle="tab">App</a></li><?php endif; ?>
    <?php if(isset($migrationsVar['module'])): ?><li><a href="#module" data-toggle="tab">Modules</a></li><?php endif; ?>
    <?php if(isset($migrationsVar['package'])): ?><li><a href="#package" data-toggle="tab">Packages</a></li><?php endif; ?>
</ul>

<div class="tab-content">
    <?php foreach($migrationsVar as $type => $names): ?>
        <div class="tab-pane <?php if($type=='app') echo 'active'; ?>" id="<?= $type; ?>">
      <h2><?= ucfirst($type); ?></h2>

      <?php foreach($names as $name => $migrations): ?>

        <div class="well">
        <h3 class="pull-left"><?= ucfirst($name); ?></h3>

        <div class="pull-right">
          <a href="<?= \Router::get('migration_backend_migration_migrate', array('migration' => $type.'_'.$name, 'type' => 'latest')); ?>" class="btn btn-primary"><?= __('migration.migrate.all'); ?></a>
          <a href="<?= \Router::get('migration_backend_migration_migrate', array('migration' => $type.'_'.$name, 'type' => 'current')); ?>" class="btn btn-info"><?= __('migration.migrate.current'); ?></a>
        </div>


        <table class="table table-striped" id="migration-table">
            <thead>
            <tr>
                <th><?= __('migration.migration.version'); ?></th>
                <th><?= __('migration.migration.name'); ?></th>
                <th><?= __('migration.migration.action'); ?></th>
            </tr>
            </thead>
            
            <tbody>
            <?php foreach ($migrations as $version => $migration): ?>
                <tr>
                    <td><?= $version; ?></td>
                    <td><?= $migration['file']; ?></td>
                    <td>
                        <?php if($migration['conflict']): ?>
                          <a href="#" class="btn btn-danger"><?= __('migration.migration.conflict'); ?></a>
                        <?php elseif($migration['done']): ?>
                          <a href="<?= \Router::get('migration_backend_migration_migrate', array('migration' => $version.'_'.$type.'_'.$name)); ?>" class="btn btn-warning"><?= __('migration.migration.rollback'); ?></a>
                        <?php else: ?>
                          <a href="<?= \Router::get('migration_backend_migration_migrate', array('migration' => $version.'_'.$type.'_'.$name)); ?>" class="btn btn-success"><?= __('migration.migration.migrate'); ?></a>
                        <?php endif; ?> 
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        </div>
      <?php endforeach; ?>
      </div>
    <?php endforeach; ?>
    </div>
<?php endif; ?>
