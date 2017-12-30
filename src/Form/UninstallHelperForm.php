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
class UninstallHelperForm extends ConfirmFormBase {

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
        return $this->t('Reset taxonomy terms?');
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
        return $this->t('This will reset all terms to before Term Status was installed.');
  }

  /**
     * {@inheritdoc}
     */
  public function getConfirmText() {
        return $this->t('Delete all data');
  }

  /**
     * {@inheritdoc}
     */
  public function submitForm(array &$form, FormStateInterface $form_state) {
        $batch = [
            'title' => $this->t('Deleting Flag data'),
            'operations' => [
                [
                    [__CLASS__, 'resetFlags'], [],
                  ],
              ],
            'progress_message' => $this->t('Deleting Flag data...'),
          ];
        batch_set($batch);
    
        drupal_set_message($this->t('Flag data has been cleared.'));
      }

  /**
     * Batch method to reset all flags.
     */
  public static function resetFlags(&$context) {
        // First, set the number of flags we'll process each invocation.
        $batch_size = 100;
    
        // If this is the first invocation, set our index and maximum.
        if (empty($context['sandbox'])) {
            $context['sandbox']['progress'] = 0;
            $context['sandbox']['max'] = \Drupal::entityQuery('flagging')->count()->execute();
          }

    // Get the next batch of flags to process.
    $query = \Drupal::entityQuery('flagging');
    $query->range($context['sandbox']['progress'], $batch_size);
    $ids = $query->execute();

    // Delete the flaggings.
    $storage = \Drupal::entityTypeManager()->getStorage('flagging');
    $storage->delete($storage->loadMultiple($ids));

    // Increment our progress.
    $context['sandbox']['progress'] = $batch_size;

    // If we still have flags to process, set our progress percentage.
    if ($context['sandbox']['progress'] < $context['sandbox']['max']) {
            $context['finished'] = $context['sandbox']['progress'] / $context['sandbox']['max'];
          }
  }
}