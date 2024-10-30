<?php
namespace CLASSYEA\classes\helper;

defined('ABSPATH') || die();

class CLASSYEA_PB_SC_CHECK
{
    public static function Check_sc_exist_in_post($array_list, $post_id)
    {
        $content_post = get_post($post_id);
        $content = $content_post->post_content;
        $return_array = [];
        foreach ($array_list as $key => $array) {
            if (stripos($content, $key)) {
                $return_array[] = $array;
            }
        }
        if ($return_array && !empty($return_array)) {
            return $return_array;
        } else {
            return false;
        }
    }

    public static function Check_ele_sc_exist_in_post($array_list, $post_id)
    {
        $elementor_array = '';
        $css_editor = '';
       
        $return_array = [];
        $elementor_array = [];
        $content_post = \Elementor\Plugin::$instance->documents->get($post_id);
        $content_post = $content_post ? $content_post->get_elements_data() : [];

        \Elementor\Plugin::$instance->db->iterate_data($content_post, function ($element) use (&$elementor_array, &$css_editor) {
            if (empty($element['widgetType'])) {
                $type = $element['elType'];
            } else {
                $type = $element['widgetType'];
            }
            if (!empty($element['settings'][CLASSYEA_CSS_EDITOR_NAME])) {
                $css_editor .= $element['settings'][CLASSYEA_CSS_EDITOR_NAME];
            }
            if (!isset($elementor_array[$type])) {
                $elementor_array[$type] = 0;
            }
            $elementor_array[$type]++;
            return $element;
        });

        if ($css_editor != '') {
            $filename = CLASSYEA_PB_BUILD_CSS::$targetdircss . "css_editor_{$post_id}.css";
            if (file_exists($filename)) {
                unlink($filename);
            }
            if (!is_dir(CLASSYEA_PB_BUILD_CSS::$targetdircss)) {
                @mkdir(CLASSYEA_PB_BUILD_CSS::$targetdircss, 0777, true);
            }
            file_put_contents($filename, $css_editor);
        } else {
            $filename = CLASSYEA_PB_BUILD_CSS::$targetdircss . "css_editor_{$post_id}.css";
            if (file_exists($filename)) {
                unlink($filename);
            }
        }
        foreach ($array_list as $key => $array) {
            if (array_key_exists($key, $elementor_array)) {
                $return_array[] = $array;
            }
        }

        if ($return_array && !empty($return_array)) {
            return $return_array;
        } else {
            return false;
        }
    }

}
