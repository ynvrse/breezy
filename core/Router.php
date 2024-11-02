<?php


function route($path, $dir)
{
    global $DB;
    global $params;
    $params = [];
    $routesDir = $dir . "/pages";
    $content = null;

    $path = rtrim($path, '/');

    if ($path === '/' || $path === '') {
        $path = '/home';
    }


    $staticFilePath = $routesDir . $path . ".php";
    if (is_file($staticFilePath)) {
        $content = $staticFilePath;
    }
    // Check for a directory with an index.php 
    else {
        $indexFilePath = $routesDir . $path . "/index.php";
        if (is_file($indexFilePath)) {
            $content = $indexFilePath;
        } else {
            // Handle dynamic routes if no static or index file matches
            foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($routesDir)) as $file) {
                if ($file->isDir())
                    continue;

                $relativePath = str_replace([$routesDir, '.php'], '', $file->getPathname());
                $relativePath = str_replace('\\', '/', $relativePath);

                // Extract parameter names and prepare regex for matching
                preg_match_all('/\[([a-zA-Z0-9_]+)\]/', $relativePath, $paramNames);
                $routePattern = preg_replace('/\[([a-zA-Z0-9_]+)\]/', '([^/]+)', $relativePath);
                $routePatternRegex = "#^" . $routePattern . "$#";

                if (preg_match($routePatternRegex, $path, $matches)) {
                    array_shift($matches);

                    foreach ($paramNames[1] as $index => $name) {
                        $params[$name] = $matches[$index];
                    }

                    $content = $file->getPathname();
                    break;
                }
            }
        }
    }




    if (isAuth() && isset($content) && is_file($content)) {

        require 'layouts/AppLayout.php';
    } elseif (isset($content) && is_file($content)) {

        require 'layouts/GuestLayout.php';
    } else {
        http_response_code(404);
        require('error/404.php');

    }

}

function getParam($name)
{
    global $params;
    return $params[$name] ?? null;
}

function redirectTo($url)
{
    header("location: {$url}");
    // exit;
}


