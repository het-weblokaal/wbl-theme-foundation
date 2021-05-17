WBL Theme Foundation
===

We have made several custom themes while trying to maintain similar structures and coding practices. We found the need to centralize it to reduce scattered code. This foundation brings together our theme-code. The purpose is to provide an organizational structure, a starting-point ánd offer a rigid template framework. 

This is a work in progress. Be warned :)

# Install & Boot

Install through composer: `composer install het-weblokaal/wbl-theme-foundation`

And then boot it in your functions.php: `require_once( __DIR__ . '/vendor/het-weblokaal/wbl-theme-foundation/bootstrap.php' );`

## Why not autoload? 
When I develop the foundation I like to work in a seperate git-directory when developing the theme foundation. I can then just load a different boot-file. 

```
require_once( __DIR__ . '/../wbl-theme-foundation/bootstrap.php' );
Template::customize(['main_template_dir' => '../wbl-theme-foundation/template/views']);
```
_Probably not best-practice, but it works for me now._

# Theme organization
...

# Theme setup
Opinionated theme setup. This prevents a lot of repetitiveness in all our themes. 

To-do: Make it more flexible, so that themes can easily decide which features it wants to us and which not. But for now this is OK.

# Templating
The goal of templating in this framework:

- Offering a startpoint for creating new sites
- Making it easier to implement own templates

The templates should be flexible and easy to understand. On the other hand, the amount of code should be low to prevent too much repetivity.

# Developer

Some guidelines:

- Only hook an anonymous functions to an action if the theme can easily override the functionality. Otherwise create a seperate function.