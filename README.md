# Fuel-Migration module

This is a module for easily managing all Fuel Migration files in your project

You may have bugs on this module, it's not completely finished. Furthermore, it's difficult to automatically adapted a module on an existing project.

## Features

* View all migrations app / packages / modules
* You can sync your config file or your migration table if you have conflict
* You can migrate or rollback any migration you want

## Installation

1. This module uses Theme class, you must create your theme folder.
2. Clone or download the fuel-migration repository
3. Move it into your modules folder, and rename it to "migration"
4. Open your oil console
5. Run `oil refine migration::migration:install [your_public_folder] [your_theme]` to generate needed files (copy js and css files in assets folder). 
* [your_public_folder] is optionnally if your public folder is not named "public"
* [your_theme] is if you use a theme other than the default theme

## Configuration

### Base controller

This module is not securised, i've not added a ACL or Auth security. You need to attach this module on your base admin controller :

In `modules/migration/classes/controller/backend.php` at line 5 :

```php
  class Controller_Backend extends \Controller_Base_Backend
```

### Theme

It uses the Theme class from FuelPHP, consequently you need to have a theme for your administration.

### Implementation

All variables used in the template file from theme :

* $partials['content'] : The partial for the content
* `<?= \Theme::instance()->asset->render('css_plugin'); ?>` in the head
* `<?= \Theme::instance()->asset->render('js_core'); ?>` in the head
* `<?= \Theme::instance()->asset->render('js_plugin'); ?>` in the footer
* Your need to load jQuery and jQuery UI, and optionnaly Twitter Bootstrap v3

You can see an example of template here : [`migration/example/template.php`](https://github.com/jhuriez/fuel-migration/blob/master/example/template.php)

### Config file

file menu.php in `app/config` :

```php
return array(
	...,
	'module' => array(
		'force_jquery' => false, // Load jQuery library
		'force_bootstrap' => false, // Load Bootstrap library (js and css)
		'assets' => array(
			'css_plugin' => 'css', // Set the asset group "css" instead of "css_plugin",
		),
	),
	...,
);
```

### Change assets groups name

In your theme you don't want to use the asset group "css_plugin", but just "css" ? No problem, you can change it in the config file !

### jQuery

The module need jQuery et jQuery UI external libraries. If you have already these libraries in your theme, it's good.

But if you want to force to load the jquery library, you need to set "force_jquery" at true in the menu config file.

### Bootstrap 

This is the same for Bootstrap librairy

## Usage

Access the backoffice at http://your-fuel-url/migration/backend

Warning: This module is not securised, i've not added a ACL or Auth security. 
You need to do it, or you can copy/extend this module.

## Error

- Fuel\Core\ThemeException [ Error ]: Theme "default" could not be found.
It's because this module uses Themes for better flexibility. You must create a theme folder, by default it's DOCROOT/themes/default. And refresh!

- ErrorException [ Fatal Error ]: Class 'Controller_Base_Backend' not found.
It's because the controller \Migration\Controller_Backend need to extends your admin controller in your project. In my case, the admin controller is named \Controller_Base_Backend

## Override Theme

You can use your own theme :

* To override the template : DOCROOT/themes/[theme]/migration/template.php
* To override the index view : DOCROOT/themes/[theme]/migration/backend/migration/index.php 
