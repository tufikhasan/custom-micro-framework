<?php

use App\Controllers\PageController;
use App\Routers\Router;

Router::get('/',function(){
    echo "Home";
});
Router::get('test',function(){
    view('test');
});
Router::get('test-two',[PageController::class,'index']);
Router::run();