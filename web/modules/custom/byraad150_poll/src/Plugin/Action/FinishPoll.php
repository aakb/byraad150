<?php

namespace Drupal\byraad150_poll\Plugin\Action;

use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Action\ActionBase;
use Drupal\Core\Annotation\Action;
use Drupal\Core\Annotation\Translation;

/**
 * Finish poll.
 *
 * @Action(
 *   id = "finish_poll",
 *   label = @Translation("Finish poll"),
 *   type = "node"
 * )
 */
class FinishPoll extends ActionBase {

  /**
   * {@inheritdoc}
   */
  public function execute($entity = NULL) {
    if (!is_null($entity)) {
      if (isset($entity->field_poll_ref)) {
        $poll = $entity->field_poll_ref->entity;
        $poll->close();
        $poll->save();
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function access(
    $object,
    AccountInterface $account = NULL,
    $return_as_object = FALSE
  ) {
    $result = $object->access('update', $account, TRUE);
    return $return_as_object ? $result : $result->isAllowed();
  }
}
