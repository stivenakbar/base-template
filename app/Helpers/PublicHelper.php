<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

    if(!function_exists('c_options')){
        function c_options(Collection | Model $options, $col_val="id", $col_label="name"){
            return collect($options)->pluck([$col_label,$col_label])->toArray();
        }
    }

    if(!function_exists('humanizeSize')){
        function humanizeSize($size){
            $i = floor(log($size) / log(1024));
            return ($size < 1024) ? $size . ' B' : ($size < 1048576 ? round($size / 1024) . ' KB' : round($size / 1048576) . ' MB');
        }
    }
    if(!function_exists('humanizeName')){
        function humanizeName($name){
            $extensionPos = strrpos($name, '.'); 
            $extension = substr($name, $extensionPos); 
            $baseName = substr($name, 0, $extensionPos); 
        
            if (strlen($baseName) <= 20) {
                return $name.$extension;
            }
        
            $slicedName = substr($baseName, 0, 20); 
            return "$slicedName...$extension"; 
        }
    }
?>