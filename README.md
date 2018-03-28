# Service provider interop proof of concept

This is an example of aliases, requirements and compiler pass implementation for service provider interop.

* `git clone git@github.com:pmall/sp.git`
* `composer install`

Then some basic tests illustrating the approach can be run:

* `php tests/default.php`: works the same as the current spec
* `php tests/bind.php`: bind aliases and requirements of two service providers together
* `php tests/tag.php`: Tag the same aliases of a group of service providers as one container entry
* `php tests/all.php`: Combination of the two examples above
