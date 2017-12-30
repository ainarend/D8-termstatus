<?php
/**
 * @file
 * Contains \Drupal\termstatus\From\UninstallHelperForm.
 */

namespace Drupal\termstatus\Form;

use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Provides the Flag uninstall form.
 */
class UninstallForm extends ConfirmFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'termstatus_uninstall_form';
  }

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Clear Term Status data?');
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('<front>');
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->t('This helper form clears all the Term Status data. The'
      . ' form allows this module to be uninstalled for Drupal Core versions '
      . 'lower than 8.5.');
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Remove Term Status data');
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    \Drupal::database()
            ->update('taxonomy_term_field_data')
            ->fields(['status' => NULL])
            ->execute();

    drupal_set_message($this->t('Term Status data has been cleared.'));
  }

}