<?
class Lb_Breadcrumb_From_Nav
{
    static function get_menu_hierarchy($post_id, $menu_name) {
        $menu_items = wp_get_nav_menu_items($menu_name);
    
        if (!$menu_items) {
            return [];
        }
    
        $menu_map = [];
        // Создаем карту элементов меню
        foreach ($menu_items as $item) {
            $item->children = [];
            $menu_map[$item->ID] = $item;
        }
        
        // Связываем элементы меню с их родителями
        foreach ($menu_items as $item) {
            if ($item->menu_item_parent) {
                $menu_map[$item->menu_item_parent]->children[] = $item;
            }
        }
        
        $hierarchy = [];
        // Рекурсивная функция для поиска пути в меню
        function find_menu_path($menu_map, $start_item, $post_id, &$path) {
         
            if ($start_item->object_id == $post_id) {
                $path[] = $start_item;
                return true;
            }
            
            foreach ($start_item->children as $child) {
                if (find_menu_path($menu_map, $child, $post_id, $path)) {
                    array_unshift($path, $start_item);
                    return true;
                }
            }
            
            return false;
        }
    
        foreach ($menu_items as $item) {
            
            if ($item->menu_item_parent == 0) {
                if (find_menu_path($menu_map, $item, $post_id, $hierarchy)) {
                    break;
                }
            }
        }
    
        return $hierarchy;
    }
}


function custom_breadcrumbs($links) {
    if (is_single() || is_page()) {
        global $post;
        $menu_name = 357; // Укажите имя вашего меню
        $hierarchy = Lb_Breadcrumb_From_Nav::get_menu_hierarchy($post->ID, $menu_name);
        
        if ($hierarchy) {
            $new_links = [];
            array_pop($hierarchy);

            foreach ($hierarchy as $item) {
                $new_links[] = [
                    'url' => $item->url,
                    'text' => $item->title,
                ];
            }
            

            // Вставляем наши ссылки после ссылки на домашнюю страницу (первая ссылка)
            array_splice($links, 1, -1, $new_links);

        }
    }
    return $links;
}
add_filter('wpseo_breadcrumb_links', 'custom_breadcrumbs');