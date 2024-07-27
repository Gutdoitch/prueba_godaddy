# Easy Digital Downloads Newsletter Tool

## Installation and set up

The extension in question needs to have a `composer.json` file, specifically with the following:

```json 
"require": {
    "easydigitaldownloads/edd-newsletter-tool": "*"
},
"repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/awesomemotive/edd-newsletter-tool"
    }
]
```

Once set up, run `composer install --no-dev`. This should create a new `vendors/` folder with `easydigitaldownloads/edd-newsletter-tool/` inside.

## Using the newsletter tool

The newsletter tool is an abstract class to work with email marketing extesions. To get started, add the autoloader to your main plugin file:

```php 
require_once dirname( __FILE__ ) . '/vendor/autoload.php';
```

- The `vendor/autoload.php` file needs to be included. 
- Initialize the custom extension class, defining the ID and the class label in the constructor.
- Update the custom class with the required abstract functions.
