<?php namespace Elementor\TemplateLibrary;
use \Elementor\Plugin;
if (!defined('ABSPATH'))
{
    exit;
}
class Sina_Ext_Library extends Source_Base
{
    public function get_id()
    {
        return 'sina_ext_templates';
    }
    public function get_title()
    {
        return esc_html__('Sina Templates', 'sina-ext');
    }
    public function register_data()
    {
    }
    public function save_item($template_data)
    {
        return new \WP_Error('invalid_request', 'Cannot save template to a remote source');
    }
    public function update_item($new_data)
    {
        return new \WP_Error('invalid_request', 'Cannot update template to a remote source');
    }
    public function delete_template($template_id)
    {
        return new \WP_Error('invalid_request', 'Cannot delete template from a remote source');
    }
    public function export_template($template_id)
    {
        return new \WP_Error('invalid_request', 'Cannot export template from a remote source');
    }
    public function get_data(Array $args, $context = 'display')
    {
        $type = get_option('sina_ext_type');
        $key = ('pro' == $type) ? get_option('sina_ext_pro_license_key') : get_option('sina_ext_license_key');
        $temp_id = str_replace('sina_ext_', '', $args['template_id']);
        $url = sprintf(self::$api_get_template_content_url . '&type=' . $type . '&dom=' . get_option('siteurl') . '&key=' . $key, $temp_id);
        $response = wp_remote_get($url, ['timeout' => 60]);
        $data = json_decode(wp_remote_retrieve_body($response) , true);
        $template = [];
        $template['content'] = $this->replace_elements_ids($data['content']);
        $template['content'] = $this->process_export_import_content($template['content'], 'on_import');
        $template['page_settings'] = [];
        return $template;
    }
    public function get_item($template_data)
    {
        $favorite_templates = $this->get_user_meta('favorites');
        return ['template_id' => 'sina_ext_' . $template_data['id'], 'source' => 'remote', 'type' => $template_data['type'], 'subtype' => $template_data['subtype'], 'title' => $template_data['title'], 'thumbnail' => $template_data['thumbnail'], 'date' => $template_data['tmpl_created'], 'author' => $template_data['author'], 'tags' => json_decode($template_data['tags']) , 'isPro' => ('1' === $template_data['is_pro']) , 'accessLevel' => (int)$template_data['access_level'], 'popularityIndex' => (int)$template_data['popularity_index'], 'trendIndex' => (int)$template_data['trend_index'], 'hasPageSettings' => ('1' === $template_data['has_page_settings']) , 'url' => $template_data['url'], 'favorite' => !empty($favorite_templates['sina_ext_' . $template_data['id']]) , ];
    }
    public function get_items($args = [])
    {
        $type = get_option('sina_ext_type');
        $key = ('pro' == $type) ? get_option('sina_ext_pro_license_key') : get_option('sina_ext_license_key');
        $url = self::$api_info_url . '&type=' . $type . '&dom=' . get_option('siteurl') . '&key=' . $key;
        $response = wp_remote_get($url, ['timeout' => 60]);
        $info_data = json_decode(wp_remote_retrieve_body($response) , true);
        $templates = [];
        if (isset($info_data['library']['templates']) && !empty($info_data['library']['templates']))
        {
            $templates_data = $info_data['library']['templates'];
        }
        else
        {
            $templates_data = [];
        }
        if (!empty($templates_data))
        {
            foreach ($templates_data as $template_data)
            {
                $templates[] = $this->get_item($template_data);
            }
        }
        return $templates;
    }
    public static $api_info_url = 'https://sinaextra.com/api/v1/sina-ext/get/?data=lib';
    private static $api_get_template_content_url = 'https://sinaextra.com/api/v1/sina-ext/get/?data=%d';
}