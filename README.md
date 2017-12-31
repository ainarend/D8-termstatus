# Taxonomy Term Status
This module adds a status-flag to taxonomy terms. Using this flag it is
possible to specify whether terms should be published or not. Users with the
appropriate permission may access unpublished terms.

## Installation
1. Download the module
2. Enable the module. In the admin UI, it is listed under Taxonomy Term Status package.
3. Set appropriate permissions, default roles are granted view permissions to keep the core logic.

## Usage
After installation a Published field is added to all Terms, which controls the access to Term pages. 

### Uninstalling limitation
Currently when the module is installed it can't be immediately uninstalled, because the module extends Term entities base fields and this causes a Drupal Core limitation to module uninstallation. This is fixed for Drupal 8.5.x, [see this issue](https://www.drupal.org/project/drupal/issues/2282119).

For versions earlier than 8.5.x there is a helper form created that cleans the database to allow uninstalling, it sets the status field for all Terms to NULL in the databse. The form is located at:

/admin/modules/uninstall/termstatus

## To do
* Vocabulary settings to set default state for the terms.
* Update Term entity to allow usage of isPublished().
