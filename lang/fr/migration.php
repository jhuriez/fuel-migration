<?php

return array(
    'migration' => array(
        'list' => 'Liste des migrations',
        'empty' => 'Aucune migration',
        'version' => 'Version',
        'name' => 'Nom',
        'action' => 'Actions',

        'rollback' => 'Retourner à cette version',
        'migrate' => 'Migrer cette version',
        'conflict' => 'Conflit entre le fichier config et la table migration',

        'message' => array(
            'success' => array(
                'app' => array(
                    'current' => 'La migration du projet complet est passée sur la version actuelle',
                    'latest' => 'La migration du projet complet est passée sur la dernière version',
                ),
                'current' => 'La migration du :type :name est passée sur la version actuelle',
                'latest' => 'La migration du :type :name est passée sur la dernière version',
                'version' => 'La migration du :type :name est passée à la version :version',
                'sync' => 'La synchronisation s\'est faite avec succès',
            ),
            'error' => array(
                'sync' => 'Une erreur s\'est produite lors de la synchronisation',
            ),
        ),
    ),
    'migrate' => array(
        'all' => 'Tout migrer',
        'all_current' => 'Tout migrer sur la version actuelle',
        'current' => 'Migrer sur la version actuelle',
        'sync' => array(
            'array_from_db' => 'Synchroniser Array venant de Db',
            'db_from_array' => 'Synchroniser Db venant de Array',
        ),
    ),
);