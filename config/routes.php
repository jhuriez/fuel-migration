<?php

return array(
    '_root_' => '/migration/backend/404',
    '_404_' => '/migration/backend/404',
	'backend/migration/migrate/(:migration)/(:type)' => array('migration/backend/migration/migrate/(:migration)/(:type)', 'name' => 'migration_backend_migration_migrate'),
    'backend(/:any)' => array('migration/backend$1', 'name' => 'migration_backend'),
    'backend' => array('migration/backend/migration', 'name' => 'migration_backend_migration'),
    
);