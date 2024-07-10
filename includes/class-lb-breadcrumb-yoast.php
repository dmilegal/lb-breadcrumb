<?
class Lb_Breadcrumb_Yoast
{

  function __construct()
  {
  }

  function rewrite($links)
  {
    if (!(is_single() || is_page())) return;

    global $post;

    $settings = get_field('lb_cst_bc_settings', $post->ID);

    if (!$settings) return $links;

    $hide_root_parent = $settings['hide_root_parent'] ?? false;
    $chain = $settings['chain'] ?? [];
    $custom_title = $settings['custom_title'] ?? '';

    if ($custom_title && $links) {
      $links[-1]['text'] = $custom_title;
    }

    if ($hide_root_parent) {
      array_shift($links);
      //$links = array_filter($links, fn ($l) => $l['url'] != home_url('/') && $l['url'] != home_url());
    }

    if ($chain) {
      $new_links = [];

      foreach ($chain as $item) {
        $url = isset($item['page']) ? get_permalink($item['page']) : '#';
        $text =  isset($item['custom_title']) && $item['custom_title'] ?
          $item['custom_title'] : (isset($item['page']) && get_the_title($item['page']) ? get_the_title($item['page']) : '');


        $bc_item = [
          'url' => $url,
          'text' => $text,
        ];

        if (isset($item['page']) && $item['page']) {
          $bc_item['id'] = $item['page'];
        }

        $new_links[] = $bc_item;
      }

      $start_index = $hide_root_parent ? 0 : 1;

      array_splice($links, $start_index, count($links) - 1 - $start_index, $new_links);
    }

    return $links;
  }
}
