<?php 

if (!function_exists('view')) {
    function view(string $path, array  $data = []):void{
        // expact
        require_once __DIR__ . "/../views/{$path}.php";
    }
}