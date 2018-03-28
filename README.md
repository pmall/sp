# Service provider interop proof of concept

This is an example of aliases, requirements and compiler pass implementation for service provider interop.

* `git clone git@github.com:pmall/sp.git`
* `composer install`

Then some basic tests illustrating the approach can be run:

* `php tests/default.php`: works as the current spec
* `php tests/bind.php`: "bind" aliases and requirements of two service providers
* `php tests/tags.php`: Tag a group of container entries sharing the same alias
* `php tests/all.php`: Combination of the two examples above
