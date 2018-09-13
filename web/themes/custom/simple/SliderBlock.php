<?php
namespace  Drupal\tcdev\Plugin\Block;
use Drupal\Core\block\BlockBase;


/**
 * Provides a 'SliderBlock' block.
 *
 * @Block(
 * id = "slider_block",
 * admin_label = @Translation("Slider Block"),
 * )
 */

class SliderBlock extends BlockBase{
    /**
     * {@inheritdoc}
     */
    public function build() {
        return array(
            '#theme' => 'tcdev',
            '#title' => 'my title ',
            '#description' => 'my custom desc'
        );
   }
}
