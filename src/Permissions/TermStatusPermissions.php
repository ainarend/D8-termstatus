<?php

/**
 * @file
 * Contains \Drupal\termstatus\Permissions\TermStatusPermissions.
 */

namespace Drupal\termstatus\Permissions;

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

class TermStatusPermissions implements ContainerInjectionInterface {

  use StringTranslationTrait;

  /**
   * Entity manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Construct the object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   Entity manager.
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static($container->get('entity_type.manager'));
  }

  /**
   * Generates the user permissions for Term Status.
   *
   * @return array
   */
  public function permissions() {
    $permissions = [];

    $vocabularies = $this->entityTypeManager
                         ->getStorage('taxonomy_vocabulary')
                         ->loadMultiple();

    if (!empty($vocabularies)) {
      foreach ($vocabularies as $vocabulary) {
        $permissions += [
          'view published terms in ' . $vocabulary->id() => [
            'title' => $this->t('View published terms in %vocabulary',
              ['%vocabulary' => $vocabulary->label()]
            ),
          ],
          'view unpublished terms in ' . $vocabulary->id() => [
            'title' => $this->t('View unpublished terms in %vocabulary',
              ['%vocabulary' => $vocabulary->label()]
            ),
          ],
        ];
      }
    }

    return $permissions;
  }

}