<?php

/**
 * @file
 * Contains \Drupal\termstatus\Entity\TermWithStatusInterface.
 */

namespace Drupal\termstatus\Entity;

use Drupal\taxonomy\TermInterface;

/**
 * Provides an interface defining an extended term entity with the status field.
 */
interface TermWithStatusInterface extends TermInterface {

  /**
   * Gets the status field value.
   *
   * @return mixed
   */
  public function getStatus();

  /**
   * Sets the status field value.
   *
   * @param $status
   *   The status of the term.
   *
   * @return $this
   */
  public function setStatus($weight);

  /**
   * Returns whether the term is published.
   *
   * @return bool
   */
  public function isPublished();

}
