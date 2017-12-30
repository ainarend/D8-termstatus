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

## To do
* Vocabulary settings to set default state for the terms.
* Update Term entity to allow usage of isPublished().
