<?php

function getProducts():array
{
    global $pdo;
    $products = $pdo->query('SELECT * FROM products')->fetchAll(PDO::FETCH_CLASS, 'Product');
    return $products;
}

?>