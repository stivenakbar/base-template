<?php 
    use Illuminate\Support\Str;
    class BreadCrumb {

        public static function init($baseUrl = ""){
            $url = str_replace(env("APP_URL")."/","",url()->current());
            $url = explode("/",$url);
            $merged = "";
            $url = array_map(function($item) use (&$merged, $baseUrl){
                if($baseUrl != "" && $item == $baseUrl){
                    return null;
                }
                $merged .= "/".$item;
                return [
                    "link" => $merged,
                    "name" => ucwords(str_replace('-',' ',$item))
                ];
            },$url);
            
            return array_values(array_filter($url));
        }
    }
?>