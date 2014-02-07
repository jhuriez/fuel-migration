# Fuel-Migration module

This is a module for manage easily all Fuel Migration files in your project

It's contains 
- A backoffice with Twitter Bootstrap 3 and jQuery UI

## Installation :

1. This module use Theme class, you must create your theme folder.
1. Clone or download the fuel-migration repository
2. Move it in your module folder
3. Add 'migration' to the 'always_load.modules' array in app/config/config.php.
4. Open your oil console
5. Run 'refine migrate --modules=migration' for generate migration (copy js and css files in assets folder)

## Usage :

You access to the backoffice via this URI : http://mywebsite.com/migration/backend

Warning: This module is not securised, i've not add a ACL or Auth security. 
You need to do it, or you can copy/extends this module.

## Error :

- Fuel\Core\ThemeException [ Error ]: Theme "default" could not be found.
It's because this module use Theme for better flexibility. You must create a theme folder, by default it's DOCROOT/themes/default. And refresh!

## Override Theme

You can use your own theme :

* For override the template : DOCROOT/themes/<theme>/migration/template.php
* For override the index view : DOCROOT/themes/<theme>/migration/backend/migration/index.php 
