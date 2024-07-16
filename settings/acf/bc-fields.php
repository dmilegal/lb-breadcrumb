<?
add_action('acf/include_fields', function () {
  $post_types = get_post_types(array('public' => true));
  $exclude_post_types = array('attachment', 'revision', 'nav_menu_item');
  $post_types = array_diff($post_types, $exclude_post_types);
  $post_types["news"] = "news";

  $locations = array();
  $page_post_types = array();
  foreach ($post_types as $post_type) {
    $locations[] = array(
      array(
        'param' => 'post_type',
        'operator' => '==',
        'value' => $post_type,
      ),
    );
    $page_post_types[] = $post_type;
  }


  if (!function_exists('acf_add_local_field_group')) {
    return;
  }

  acf_add_local_field_group(array(
    'key' => 'group_6685db81586b3',
    'title' => 'Custom Page Breadcrumbs',
    'fields' => array(
      array(
        'key' => 'field_668e7e924ff15',
        'label' => 'Settings',
        'name' => 'lb_cst_bc_settings',
        'aria-label' => '',
        'type' => 'group',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'layout' => 'block',
        'sub_fields' => array(
          array(
            'key' => 'field_6685db81d4138',
            'label' => 'Hide root parent',
            'name' => 'hide_root_parent',
            'aria-label' => '',
            'type' => 'true_false',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'message' => '',
            'default_value' => 0,
            'ui' => 0,
            'ui_on_text' => '',
            'ui_off_text' => '',
          ),
          array(
            'key' => 'field_668e9b128ed0d',
            'label' => 'Custom Title',
            'name' => 'custom_title',
            'aria-label' => '',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'maxlength' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
          ),
          array(
            'key' => 'field_6685dcb6d413a',
            'label' => 'Chain',
            'name' => 'chain',
            'aria-label' => '',
            'type' => 'repeater',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'layout' => 'table',
            'pagination' => 0,
            'min' => 0,
            'max' => 0,
            'collapsed' => '',
            'button_label' => 'Add Row',
            'rows_per_page' => 20,
            'sub_fields' => array(
              array(
                'key' => 'field_6685dce3d413b',
                'label' => 'Page',
                'name' => 'page',
                'aria-label' => '',
                'type' => 'post_object',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'post_type' => $page_post_types,
                'post_status' => '',
                'taxonomy' => '',
                'return_format' => 'id',
                'multiple' => 0,
                'allow_null' => 0,
                'bidirectional' => 0,
                'ui' => 1,
                'bidirectional_target' => array(),
                'parent_repeater' => 'field_6685dcb6d413a',
              ),
              array(
                'key' => 'field_6685dcf2d413c',
                'label' => 'Custom Title',
                'name' => 'custom_title',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'default_value' => '',
                'maxlength' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'parent_repeater' => 'field_6685dcb6d413a',
              ),
            ),
          ),
        ),
      ),
    ),
    'location' => $locations,
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));
});
