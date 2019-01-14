<?php
/**
 * @file
 * Implements hero video block
 */

namespace Drupal\aarhus_hero\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides hero video content.
 *
 * @Block(
 *   id = "aarhus_hero_video",
 *   admin_label = @Translation("Aarhus hero video"),
 * )
 */
class AarhusHeroVideo extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = \Drupal::getContainer()->get('aarhus_hero.hero_config')->getAll();

    $videoElement = NULL;

    if (isset($config['hero_video'])) {
      $source = $config['hero_video'];
      $pathInfo = pathinfo($source);

      if (!isset($pathInfo['extension']) ||  $pathInfo['extension'] == '') {
        $source .= '(format=mpd-time-csf)';
      }

      $classes = ['itk-azure-video', 'itk-azure-video-responsive'];

      $classesString = implode(' ', $classes);

      $markup =
        '<div class="'.$classesString.'">' .
        '<video data-dashjs-player disablePictureInPicture controls src="'.$source.'"></video>' .
        '</div>';

      $videoElement = [
        '#type' => 'inline_template',
        '#template' => $markup,
        '#attached' => ['library'=> ['itk_azure_video/azure-video']],
      ];
    }

    return array(
      '#type' => 'markup',
      '#theme' => 'aarhus_hero_video_block',
      '#video_title' => isset($config['hero_video_title']) ? $config['hero_video_title'] : NULL,
      '#video_description' => [
        '#type' => 'processed_text',
        '#text' => isset($config['hero_video_description']['value']) ? $config['hero_video_description']['value'] : NULL,
        '#format' => 'filtered_html',
      ],
      '#video' => $videoElement,
    );
  }
}
