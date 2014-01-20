<?php

namespace Fuel\Migrations;

class Migrate_assets
{
	public function up()
	{
            if (is_dir(DOCROOT.'assets')) {
                // Create dir
                is_dir(DOCROOT.'assets/js/modules/migration') or mkdir(DOCROOT.'assets/js/modules/migration', 0755, TRUE);
                is_dir(DOCROOT.'assets/css/modules/migration') or mkdir(DOCROOT.'assets/css/modules/migration', 0755, TRUE);

                // Copy JS Assets
                \File::copy_dir(dirname(__FILE__).'/assets/js', DOCROOT.'assets/js/modules/migration');
                // Copy CSS Assets
                \File::copy_dir(dirname(__FILE__).'/assets/css', DOCROOT.'assets/css/modules/migration');
            } else {
                die('Unknow public path');
            }
	}

        public function down()
        {
            \File::delete_dir(DOCROOT.'assets/js/modules/migration', true);
            \File::delete_dir(DOCROOT.'assets/css/modules/migration', true);
        }
}