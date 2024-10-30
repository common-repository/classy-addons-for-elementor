<?php
namespace CLASSYEA\classes\helper;

defined('ABSPATH') || die();

class CLASSYEA_SC_LIST extends CLASSYEA_PBModule
{
    private static $pb_sc_array_list;

    public static function init()
    {
        self::pb_sc_list_array();
    }

    public static function pb_sc_list_array()
    {
        self::$pb_sc_array_list = [
            'classyea_icon_row' => [
                'css' => ['classyea_icon_row'],
                'js' => [],
                'external' => [
                    'css' => [],
                    'js' => [],
                ],
            ],
        ];
        self::$pb_sc_array_list = apply_filters('classyea_combine_ele_css_pb_sc_list_array', self::$pb_sc_array_list);
        return self::$pb_sc_array_list;
    }
    public static function get_pb_sc_array_list()
    {
        return self::$pb_sc_array_list;
    }

}
