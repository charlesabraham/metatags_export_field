<?php

/**
 * @file
 * Definition of Drupal\d8views\Plugin\views\field\NodeTypeFlagger
 */

namespace Drupal\d8views\Plugin\views\field;

use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\NodeType;
use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;

use Drupal\node\Entity\Node;
use Drupal\field\FieldConfigInterface;

/**
 * Field handler to flag the node type.
 *
 * @ingroup views_field_handlers
 *
 * @ViewsField("node_type_flagger")
 */
class NodeTypeFlagger extends FieldPluginBase {

  /**
   * @{inheritdoc}
   */
  public function query() {
    // Leave empty to avoid a query on this field.
  }


  /**
   * @{inheritdoc}
   */
  public function render(ResultRow $values) {
    // Return a random text, here you can include your custom logic.
    // Include any namespace required to call the method required to
    // generate the output desired
    //$title = strip_tags($this->view->field['title']->original_value);
    $nid = strip_tags($this->view->field['nid']->original_value);
    $combined = array();

    $entity = \Drupal\node\Entity\Node::load($nid);

    $metaarray = metatag_get_tags_from_route($entity);

    foreach ($metaarray['#attached']['html_head'] as $key => $value) {

    $a = $value[1];

    if (isset($value[0]['#attributes']['content'])) {
      $text = $value[0]['#attributes']['content'];
    }

    if ($a == 'title' || $a == 'description' || $a == 'keywords') {
      $combined[$a] = $text;
    }

    }

    //print "<pre>";
    //print_r($combined);
    //exit;


    $output = implode("{{{",$combined);

    //$output = $titledata."{{{".$descdata."{{{".$keywordata;


    return $output;
  }
}
