<?php

namespace App\Http\Controllers;

use App\Models\MenusModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AutoRouteController extends Controller
{
    public function rewriteRouteFile($id = 1){
        $filePath = base_path('routes/web.php');
        $fileContent = File::get($filePath);
        
        $newContent = $fileContent . "\n // Your new content here";

        File::put($filePath, $newContent);

        $this->prefillContent($id);

        return "Route has ben rewrite";
    }

    public function prefillContent($id){
        $menu = MenusModel::find($id);

        $filePath = base_path('routes/web.php');
        $fileContent = File::get($filePath);

        $newContent = $fileContent . "\n // Your new content here\n";

        $view = str_replace("/",".",substr($menu->url,1));
        $newContent .=  "Route::get('".$menu->url."',function () {return view('".$view.".index'); });";
        
        
        File::put($filePath, $newContent);
        

        $directoryPath = base_path('resources/views/' . $menu->url);
        File::makeDirectory($directoryPath, 0755, true, true);

        $viewPath = $directoryPath . '/index.blade.php';
        $content = "<x-layouts.app>\n
                    <x-slot:title>".$menu->name."</x-slot:title>\n
                    </x-layouts.app>
                    ";
        
        File::put($viewPath, $content);

    }

}
