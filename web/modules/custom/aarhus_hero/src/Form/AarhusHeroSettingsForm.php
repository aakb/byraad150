<?php
/**
 * @file
 * Contains Drupal\aarhus_hero\Form\AarhusHeroSettingsForm.
 */

namespace Drupal\aarhus_hero\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

/**
 * Class AarhusHeroSettingsForm
 *
 * @package Drupal\aarhus_hero\Form
 */
class AarhusHeroSettingsForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'aarhus_hero_settings';
  }

  /**
   * Get key/value storage for base config.
   *
   * @return object
   *   The config object.
   */
  private function getBaseConfig() {
    return \Drupal::getContainer()->get('aarhus_hero.hero_config');
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->getBaseConfig();

    $form['hero'] = array(
      '#type' => 'details',
      '#title' => $this->t('Hero'),
      '#open' => TRUE,
    );

    $form['hero']['hero_title'] = array(
      '#title' => $this->t('Hero title'),
      '#type' => 'textfield',
      '#default_value' => $config->get('hero_title'),
      '#weight' => '1',
      '#size' => 60,
      '#maxlength' => 128,
    );

    $form['hero']['hero_text'] = array(
      '#title' => $this->t('Hero text'),
      '#type' => 'textfield',
      '#default_value' => $config->get('hero_text'),
      '#weight' => '2',
      '#size' => 60,
      '#maxlength' => 128,
    );

    $form['hero']['hero_link'] = array(
      '#title' => $this->t('Hero link'),
      '#type' => 'textfield',
      '#default_value' => $config->get('hero_link'),
      '#weight' => '3',
      '#size' => 60,
      '#maxlength' => 2048,
    );

    $form['hero']['hero_image'] = array(
      '#title' => $this->t('Hero image'),
      '#type' => 'managed_file',
      '#default_value' => !empty($config->get('hero_image')) ? array($config->get('hero_image')) : NULL,
      '#upload_location' => 'public://images',
      '#weight' => '4',
      '#open' => TRUE,
    );

    $form['hero_video'] = array(
      '#type' => 'details',
      '#title' => $this->t('Hero Video'),
      '#open' => TRUE,
    );

    $form['hero_video']['hero_video'] = array(
      '#title' => $this->t('Hero video'),
      '#type' => 'textfield',
      '#default_value' => $config->get('hero_video'),
      '#weight' => '5',
      '#maxlength' => 2048,
      '#open' => TRUE,
    );

    $form['hero_video']['hero_video_title'] = array(
      '#title' => $this->t('Hero video title'),
      '#type' => 'textfield',
      '#default_value' => $config->get('hero_video_title'),
      '#weight' => '6',
      '#maxlength' => 2048,
      '#open' => TRUE,
    );

    $form['hero_video']['hero_video_description'] = array(
      '#title' => $this->t('Hero video description'),
      '#type' => 'text_format',
      '#format' => 'filtered_html',
      '#allowed_formats' => array('filtered_html'),
      '#default_value' => $config->get('hero_video_description')['value'],
      '#weight' => '7',
      '#open' => TRUE,
    );

    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Save changes'),
      '#weight' => '8',
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Load the file set in the form.
    $value = !empty($form_state->getValue('hero_image')[0]) ? $form_state->getValue('hero_image')[0] : NULL;
    $file = ($value) ? File::load($value) : FALSE;

    // If a file is set.
    if ($file) {
      // Add file to file_usage table.
      \Drupal::service('file.usage')->add($file, 'aarhus_hero', 'user', '1');
    }

    // Set the configuration values.
    $this->getBaseConfig()->setMultiple(array(
      'hero_title' => $form_state->getValue('hero_title'),
      'hero_text' => $form_state->getValue('hero_text'),
      'hero_link' => $form_state->getValue('hero_link'),
      'hero_image'=> !empty($form_state->getValue('hero_image')[0]) ? $form_state->getValue('hero_image')[0] : NULL,
      'hero_video' => $form_state->getValue('hero_video'),
      'hero_video_title' => $form_state->getValue('hero_video_title'),
      'hero_video_description' => $form_state->getValue('hero_video_description')
    ));

    drupal_flush_all_caches();
  }
}
