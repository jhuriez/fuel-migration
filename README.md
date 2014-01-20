# Fuel-Migration module

This is a module for manage easily all Fuel Migration files in your project

It's contains 
- A backoffice with Twitter Bootstrap 3 and jQuery UI

## Installation :

1. Clone or download the fuel-migration repository
2. Move it in your module folder
3. Add 'migration' to the 'always_load.modules' array in app/config/config.php.
4. Open your oil console
5. Run 'refine migrate --modules=migration' for generate migration (copy js and css files in assets folder)


## Usage :

You access to the backoffice via this URI : http://mywebsite.com/migration/backend

Warning: This module is not securised, i've not add a ACL or Auth security. 
You need to do it, or you can copy/extends this module.