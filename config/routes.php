<?php

return [
    
        ['GET', '/', function() {return file_get_contents(__DIR__ . '/../templates/index.html');}],
        ['GET', '/category', function() {return file_get_contents(__DIR__ . '/../templates/category.html');}],
        ['GET', '/item', function() {return file_get_contents(__DIR__ . '/../templates/item.html');}],
        ['GET', '/cart', function() {return file_get_contents(__DIR__ . '/../templates/cart.html');}],
];