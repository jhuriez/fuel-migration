# Fuel-Migration module

This is a module for easily managing all Fuel Migration files in your project

You may have bugs on this module, it's not completely finished. Furthermore, it's difficult to automatically adapted a module on an existing project.

## Features

* View all migrations app / packages / modules
* You can sync your config file or your migration table if you have conflict
* You can migrate or rollback any migration you want

## Installation

1. This module uses Theme class, you must create your theme folder.
2. You need to install the Lb Package : [See more](http://github.com/jhuriez/fuel-lb-package)
3. Clone or download the fuel-migration repository
4. Move it into your modules folder, and rename it to "migration"
5. Open your oil console
6. Run `oil refine migration::migration:install [your_public_folder] [your_theme]` to generate needed files (copy js and css files in assets folder). 
* [your_public_folder] is optionnally if your public folder is not named "public"
* [your_theme] is if you use a theme other than the default theme

## Configuration

### Base controller

This module is not securised, i've not added a ACL or Auth security. You need to attach this module on your base admin controller :

In `modules/migration/classes/controller/backend.php` at line 5 :

```php
  class Controller_Backend extends \Backend\Controller_Backend
```

### Theme

It uses the Theme class from FuelPHP, consequently you need to have a theme for your administration.

You need to load jQuery and jQuery UI, and optionnaly Twitter Bootstrap v3 + Font Awesome
For this, see the docs in Lb Package wiki : [Here](http://github.com/jhuriez/fuel-lb-package/blob/master/wiki/theme.md)

## Implementation

All variables used in the template file from theme :

* $pageTitle : For the title of the page in any action
* $partials['content'] : The partial for the content
* `<?= \Theme::instance()->asset->render('css_plugin'); ?>` in the head
* `<?= \Theme::instance()->asset->render('js_core'); ?>` in the head
* `<?= \Theme::instance()->asset->render('js_plugin'); ?>` in the footer

You can see an example of template here : [`menu/example/template.php`](http://github.com/jhuriez/fuel-lb-package/blob/master/example/template.php)

## Usage

Access the backoffice at http://your-fuel-url/migration/backend

Warning: This module is not securised, i've not added a ACL or Auth security. 
You need to do it, or you can copy/extend this module.

## Error

- Fuel\Core\ThemeException [ Error ]: Theme "default" could not be found.
It's because this module uses Themes for better flexibility. You must create a theme folder, by default it's DOCROOT/themes/default. And refresh!

- ErrorException [ Fatal Error ]: Class '\Backend\Controller_Backend' not found.
It's because the controller \Migration\Controller_Backend need to extends your admin controller in your project. In my case, the admin controller is named \Backend\Controller_Backend

# Override Theme

Views module use Twitter bootstrap 3 tags for the UI. And FontAwesome

You can override them easily. For example for override the view 'migration/views/backend/index.php', you need to create the same file here "DOCROOT/themes/[your_theme]/migration/backend/index.php"
