# Taxonomy Term Status
This module adds a status-flag to taxonomy terms. Using this flag it is
possible to specify whether terms should be published or not. Users with the
appropriate permission may access unpublished terms.

## Installation
1. Download the module
2. Enable the module. In the admin UI, it is listed under Taxonomy Term Status package.
3. Set appropriate permissions, existing roles are granted view permissions to keep the core logic.

## Usage
After installation a Published field is added to all Terms, which controls the access to Term pages. 

Since the module extends the Term entity class by using the TermWithStatus class for taxonomy_term entity in the hook_entity_type_build() hook, you also need to change all instanceof() checks from \Drupal\taxonomy\Entity\Term to \Drupal\termstatus\Entity\TermWithStatus. 

The extension is done to allow usage of isPublished and get/set methods for the status field, but the extension also keeps all the core logic the Term entity has or will ever have. This is because the extended class does not provide any additional annotations and relies solely on the original Term entity class to be built. 

## To do
1. Vocabulary settings to set default state for the terms.
2. ~~Update Term entity to allow usage of isPublished().~~
3. On /admin/structure/taxonomy/manage/{vid}/overview page display the terms status.