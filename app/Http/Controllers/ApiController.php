<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TablesNameModel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin-generate-api');
    }

    public function convertTableNameToCamelCase($tableName)
    {
        $tableName = str_replace('_', ' ', $tableName);
        $tableName = ucwords($tableName);
        $tableName = str_replace(' ', '', $tableName);

        return $tableName;
    }

    public function generateResourcesAndController($tableName)
    {
        $projectDir = base_path();
        $tableName = $this->convertTableNameToCamelCase($tableName);
        $resourceCommand = "cd $projectDir && php artisan rest:resource {$tableName}Resource";
        $controllerCommand = "cd $projectDir && php artisan rest:controller {$tableName}Controller";
        exec($resourceCommand);
        exec($controllerCommand);

        return true;
    }

    public function rewriteApiFile($tableName)
    {
        $apiFilePath = base_path('routes/api.php');
        $newLine = "Rest::resource('" . strtolower($tableName) . "', \\App\\Rest\\Controllers\\" . str_replace('_', '', ucwords($tableName, '_')) . "Controller::class);\n";

        $apiFileContents = File::get($apiFilePath);
        if (!str_contains($apiFileContents, $newLine)) {
            File::append($apiFilePath, $newLine);
        }
    }
    public function modifyControllerFile($tableName)
    {
        $tableName = $this->convertTableNameToCamelCase($tableName);
        $controllerFilePath = app_path("Rest/Controllers/{$tableName}Controller.php");
        $controllerFileContents = File::get($controllerFilePath);
        $resourceClass = "\\App\\Rest\\Resources\\" . str_replace('_', '', ucwords($tableName, '_')) . "Resource";
        $controllerFileContents = str_replace('public static $resource = \App\Rest\Resources\ModelResource::class;', "public static \$resource = $resourceClass::class;", $controllerFileContents);
        File::put($controllerFilePath, $controllerFileContents);
    }

    public function saveRoutesToDatabase($tableName)
    {
        $projectDir = base_path();
        $routeListCommand = "cd $projectDir && php artisan route:list --path=" . strtolower($tableName);
        // Execute the command and get the output
        $routes = [];
        exec($routeListCommand, $routes);
        // Parse the output and save the routes in the database
        $routesArray = [];
        foreach ($routes as $route) {
            if (strpos($route, 'Showing') !== false) {
                continue;
            }
            $routeDetails = preg_split('/\s+/', $route);
            if (count($routeDetails) > 2) { // Ignore the header and empty lines
                $routeString = trim($routeDetails[1]) . ' ' . trim($routeDetails[2]);
                $routesArray[] = $routeString;
            }
        }

        // Save the routes array in the database
        $tableModel = TablesNameModel::where('name', $tableName)->first();
        $tableModel->api_list = $routesArray;
        $tableModel->save();
    }

    public function generateApi($tableName)
    {
        $this->generateResourcesAndController($tableName);
        $this->modifyControllerFile($tableName);
        $this->rewriteApiFile($tableName);
        $this->saveRoutesToDatabase($tableName);

        return redirect()->route('admin.generate-api.index');
    }
}
