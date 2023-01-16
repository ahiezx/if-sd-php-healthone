<?php

function getCategories():array
{
    global $pdo;
    $categories = $pdo->query('SELECT * FROM category')->fetchAll(PDO::FETCH_CLASS, 'Category');
    return $categories;
}

function getCategoryName(int $id):string
{
    global $pdo;
    $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
    $category = $pdo->query('SELECT * FROM category WHERE id = ' . $id)->fetchObject('Category');
    return $category->name;
}

function getCategoriesIds():array
{
    global $pdo;
    $categories = $pdo->query('SELECT id FROM category')->fetchAll(PDO::FETCH_COLUMN);
    return $categories;
}