<?php

/**
 * @file
 * Contains \Drupal\termstatus\Entity\TermWithStatus.
 */

namespace Drupal\termstatus\Entity;

use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\taxonomy\Entity\Term;

/**
 * Creates the extended class for taxonomy_term entity.
 *
 * This class uses the parent Term entity annotation to handle everything.
 * With this approach we keep all the logic that the core Term has or
 * will have and allows us to use methods that make working with
 * the status field a little bit easier.
 *
 * @package Drupal\termstatus\Entity
 */
class TermWithStatus extends Term implements TermWithStatusInterface{

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    /** @var \Drupal\Core\Field\BaseFieldDefinition[] $fields */
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['status'] = BaseFieldDefinition::create('boolean')
     ->setLabel(t('Published'))
     ->setDescription(t('Whether the taxonomy term is published or unpublished.'))
     ->setRevisionable(TRUE)
     ->setTranslatable(TRUE)
     ->setDefaultValue(TRUE)
     ->setDisplayOptions('form', [
       'type' => 'boolean_checkbox',
       'settings' => [
         'display_label' => TRUE,
       ],
       'weight' => 50,
     ])
     ->setDisplayConfigurable('form', FALSE)
     ->setDisplayOptions('view', [
       'label' => 'hidden',
       'type' => 'hidden',
       'weight' => -5,
     ])
     ->setDisplayConfigurable('view', FALSE);

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getStatus() {
    return $this->get('status')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setStatus($status) {
    $this->set('status', $status);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isPublished() {
    return $this->getStatus() ? TRUE : FALSE;
  }

}
