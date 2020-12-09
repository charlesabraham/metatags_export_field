<?php

/**
 * Implements hook_views_data_alter().
 */
function d8views_views_data_alter(array &$data) {
  $data['node']['node_type_flagger'] = array(
    'title' => t('Metatag export'),
    'field' => array(
      'title' => t('Metatag export'),
      'help' => t('Metatags seperated by {{{'),
      'id' => 'node_type_flagger',
    ),
  );
}
