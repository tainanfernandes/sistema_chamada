<?php
namespace controller;

class FromAjax {
    // Get arrays from ajax safely
    static function _process($list, ...$keywords) {
        $result = [];

        foreach($keywords as $kw) {
            if (array_key_exists($kw, $list)) {
                $result[$kw] = $list[$kw];
            }
            else {
                return false;
            }
        }

        return count($result) > 0 ? $result : false;
    }

    public static function Get(...$keywords) {
        return FromAjax::_process($_GET, ...$keywords);
    }

    public static function Post(...$keywords) {
        return FromAjax::_process($_POST, ...$keywords);
    }
}

?>
