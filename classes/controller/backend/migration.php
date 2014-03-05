<?php

namespace Migration;

class Controller_Backend_Migration extends \Migration\Controller_Backend
{
	/**
	 * Dashboard Migration
	 */
	public function action_index()
	{
		$migrations = $this->getMigrationsAvailable();	
        $this->theme->set_partial('content', 'backend/migration/index')->set('migrationsVar', $migrations);
	}

	/**
	 * Migrate process
	 */
	public function action_migrate($migration = '', $type = 'version')
	{
		$migrationArr = explode('_', $migration);
		if ($type == 'current' || $type == 'latest')
		{
			if ($migration == 'all')
			{
				// All
				if ($type == 'current')
				{
					\Migrate::current();
					$this->use_message and \Messages::success(__('migration.migration.message.success.app.current'));
				}
				else
				{
					\Migrate::latest();
					$this->use_message and \Messages::success(__('migration.migration.message.success.app.latest'));
				}
			}
			else
			{
				// It's app, module or package
				if ($type == 'current')
				{
					\Migrate::current($migrationArr[1], $migrationArr[0]);
					$this->use_message and \Messages::success(__('migration.migration.message.success.current', array('type' => $migrationArr[0], 'name' => $migrationArr[1])));
				}
				else
				{
					\Migrate::latest($migrationArr[1], $migrationArr[0]);
					$this->use_message and \Messages::success(__('migration.migration.message.success.latest', array('type' => $migrationArr[0], 'name' => $migrationArr[1])));
				}
			}

		}
		else
		{
			// It's a rollback or migrate version
			\Migrate::version((int)$migrationArr[0], $migrationArr[2], $migrationArr[1]);
			$this->use_message and \Messages::success(__('migration.migration.message.success.version', array('type' => $migrationArr[1], 'name' => $migrationArr[2], 'version' => $migrationArr[0])));
		}

		\Response::redirect_back(\Router::get('migration_backend_migration'));
	}

	/**
	 * Sync Db Migration from Array
	 */
	public function action_syncdb()
	{
		\Config::load('migrations', true);
		$migrationsConfig = \Config::get('migrations.version');
		foreach((array)$migrationsConfig as $type => $types)
		{
			foreach((array)$types as $name => $names)
			{
				foreach((array)$names as $migration)
				{
					if (!$this->verifyMigrationAlreadyDone($type, $name, $migration))
					{
						// Insert in Db
						\DB::insert(\Config::get('migrations.table'))->set(array('type' => $type, 'name' => $name, 'migration' => $migration))->execute();
					}
				}
			}
		}
		$this->use_message and \Messages::success(__('migration.migration.message.success.sync'));
		\Response::redirect_back(\Router::get('migration_backend_migration'));

	}

	/**
	 * Sync Array from Db
	 */
	public function action_syncarray()
	{
		\Config::load('migrations', true, true);
		$migrationsDb = \DB::select('type', 'name', 'migration')->from(\Config::get('migrations.table'))->execute()->as_array();
		foreach($migrationsDb as $migrationArr)
		{
			$path = 'migrations.version.'.$migrationArr['type'].'.'.$migrationArr['name'];
			$migrationsList = (\Config::get($path) !== null) ? \Config::get($path) : array();

			if (!in_array($migrationArr['migration'], $migrationsList))
			{
				// Migration Array exist
				if (\Config::get($path) !== null)
				{
					$migrations = \Config::get($path);
					$migrations[] = $migrationArr['migration'];
					\Config::set($path, $migrations);
				}
				else
				{
					\Config::set($path, array($migrationArr['migration']));
				}
			}
		}	

		if (\Config::save(\Fuel::$env.'/migrations', 'migrations'))
		{
			$this->use_message and \Messages::success(__('migration.migration.message.success.sync'));
		}
		else
		{
			$this->use_message and \Messages::success(__('migration.migration.message.error.sync'));
		}
		\Response::redirect_back(\Router::get('migration_backend_migration'));

	}

	/**
	 * For get all migrations available
	 * @return array
	 */
	public function getMigrationsAvailable()
	{
		\Config::load('migrations', true);

		$migrations = array();
		// loop through modules to find migrations
		foreach(\Config::get('module_paths') as $modulePath)
		{
	        foreach (glob($modulePath.'*'.DS.\Config::get('migrations.folder').'*_*.php') as $migration)
	        {
	            // Convert path to array
	        	$migration = str_replace(array('/', '\\'), DS, $migration);
	            $migration = substr($migration, 0, strlen($migration)-4);
	            $migration = explode(DS, substr($migration, strlen(APPPATH)+3));
	            $fileName = explode('_', $migration[3]);

	            $migrations['module'][$migration[1]][$fileName[0]]['file'] = $migration[3];
	            $migrations['module'][$migration[1]][$fileName[0]]['done'] = $this->verifyMigrationAlreadyDone('module', $migration[1], $migration[3]);
	            $migrations['module'][$migration[1]][$fileName[0]]['conflict'] = $this->verifyMigrationConflict('module', $migration[1], $migration[3], $migrations['module'][$migration[1]][$fileName[0]]['done']);

	        }
		}

		// loop through packages to find migrations
		foreach(\Config::get('package_paths') as $packagePath)
		{
	        foreach (glob($packagePath.'*'.DS.\Config::get('migrations.folder').'*_*.php') as $migration)
	        {
	            // Convert path to array
	        	$migration = str_replace(array('/', '\\'), DS, $migration);
	            $migration = substr($migration, 0, strlen($migration)-4);
	            $migration = explode(DS, substr($migration, strlen(APPPATH)+3));
	            $fileName = explode('_', $migration[3]);

	            $migrations['package'][$migration[1]][$fileName[0]]['file'] = $migration[3];
	            $migrations['package'][$migration[1]][$fileName[0]]['done'] = $this->verifyMigrationAlreadyDone('package', $migration[1], $migration[3]);
	            $migrations['package'][$migration[1]][$fileName[0]]['conflict'] = $this->verifyMigrationConflict('package', $migration[1], $migration[3], $migrations['package'][$migration[1]][$fileName[0]]['done']);

	        }
		}

        // loop through app to find migrations
        foreach (glob(APPPATH.\Config::get('migrations.folder').'*_*.php') as $migration)
        {
            // Convert path to array
        	$migration = str_replace(array('/', '\\'), DS, $migration);
            $migration = substr($migration, 0, strlen($migration)-4);
            $migration = explode(DS, substr($migration, strlen(APPPATH)));
            $fileName = explode('_', $migration[1]);
            $migrations['app']['default'][$fileName[0]]['file'] = $migration[1];
            $migrations['app']['default'][$fileName[0]]['done'] = $this->verifyMigrationAlreadyDone('app', 'default', $migration[1]);
            $migrations['app']['default'][$fileName[0]]['conflict'] = $this->verifyMigrationConflict('app', 'default', $migration[1], $migrations['app']['default'][$fileName[0]]['done']);
            
        }
        return $migrations;
	}


	/**
	 * Check if this migration is done
	 */
	public function verifyMigrationAlreadyDone($type, $name, $migration)
	{
		$exist = \DB::select('migration')->from(\Config::get('migrations.table'))->where('type', $type)->and_where('name', $name)->and_where('migration', $migration)->execute();
		return (count($exist) > 0);
	}

	/**
	 * Verify if conflict in migration config file and in migration table
	 * @param  [type] $type        [description]
	 * @param  [type] $name        [description]
	 * @param  [type] $migration   [description]
	 * @param  [type] $alreadyDone [description]
	 * @return [type]              [description]
	 */
	public function verifyMigrationConflict($type, $name, $migration, $alreadyDone)
	{
		$migrationConfig = \Config::get('migrations.version');
		$inConfig = (isset($migrationConfig[$type][$name]) && is_array($migrationConfig[$type][$name]) && in_array($migration, $migrationConfig[$type][$name])) ? true : false;

		return ($inConfig != $alreadyDone);
	}

}