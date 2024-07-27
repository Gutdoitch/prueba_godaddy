<?php
/**
 * Theme functions and definitions.
 */
function mayosis_child_override___checkout_cart_edd_templates($template, $template_name, $template_path)
{
    $theme_template_path = get_stylesheet_directory() . '/edd_templates/' . $template_name;

    if (file_exists($theme_template_path)) {
        return $theme_template_path;
    }

    return $template;
}

add_filter('edd_template', 'mayosis_child_override___checkout_cart_edd_templates', 10, 3);
