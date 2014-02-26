<?php

return array(
    '_root_' => '/migration/backend/404',
    '_404_' => '/migration/backend/404',
	'backend/migration/syncdb' => array('migration/backend/migration/syncdb', 'name' => 'migration_backend_migration_sync_db_from_array'),
	'backend/migration/syncarray' => array('migration/backend/migration/syncarray', 'name' => 'migration_backend_migration_sync_array_from_db'),
	'backend/migration/migrate/(:migration)/(:type)' => array('migration/backend/migration/migrate/(:migration)/(:type)', 'name' => 'migration_backend_migration_migrate'),
    'backend(/:any)' => array('migration/backend$1', 'name' => 'migration_backend'),
    'backend' => array('migration/backend/migration', 'name' => 'migration_backend_migration'),
    
);