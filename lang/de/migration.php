<?php

return array(
    'migration' => array(
        'list' => 'Migrations&uuml;bersicht',
        'empty' => 'Keine Migrationen vorhanden',
        'version' => 'Version',
        'name' => 'Name',
        'action' => 'Aktionen',

        'rollback' => 'Gehe zur&uuml; zu dieser Version',
        'migrate' => 'Migriere zu dieser Version', 
        'conflict' => 'Es gibt Konflikte zwischen der Konfigurationsdatei und der Migrationstabelle.',

        'message' => array(
            'success' => array(
                'app' => array(
                    'current'   => 'Das Projekt wurde auf die aktuelle Version migriert.',
                    'latest'    => 'Das Projekt wurde auf die neuste Version migriert.',
                ),
                'current'   => 'Migration :type :name ist nun auf der aktuellen Version.',
                'latest'    => 'Migration :type :name ist nun auf der neusten Version',
                'version'   => 'Migration :type :name ist nun auf der Version :version',
            ),
        ),
    ),
    'migrate' => array(
        'all'           => 'Alle migrieren',
        'all_current'   => 'Migriere alle auf die aktuelle Version',
        'current'       => 'Migriere alle auf die aktuelle Version',
    )
);
