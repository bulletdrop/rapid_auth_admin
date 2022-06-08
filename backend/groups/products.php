<?php

function get_product_name_by_index($gid, $index)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT products_array FROM dashboard_groups WHERE gid=?");
    $statement->execute(array($gid));  
    
    while($row = $statement->fetch()) {
        return json_decode($row["products_array"])[$index];
    }
    
    return "-1";
}

function get_product_index_by_name($gid, $product_name)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT products_array FROM dashboard_groups WHERE gid=?");
    $statement->execute(array($gid));  
    
    while($row = $statement->fetch()) {
        $index = 0;
        foreach(json_decode($row["products_array"]) as $product)
        {
            if ($product == $product_name)
                return $index;
            $index++;
        }
    }
    
    return "-1";
}

function get_products_by_gid($gid)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT products_array FROM dashboard_groups WHERE gid=?");
    $statement->execute(array($gid));  
    
    while($row = $statement->fetch()) {
        return json_decode($row["products_array"]);
    }
    
    return "-1";
}

function add_product($gid, $product_name)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $current_products = get_products_by_gid($gid);
    array_push($current_products, $product_name);
    $new_products = json_encode($current_products);

    $statement = $pdo->prepare("UPDATE dashboard_groups SET products_array = ? WHERE gid = ?;");
    $statement->execute(array($new_products, $gid));
}

function product_name_exist($gid, $product_name)
{
    include_once $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/includes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/rapid_auth_admin/backend/config.php';

    $statement = $pdo->prepare("SELECT products_array FROM dashboard_groups WHERE gid=?");
    $statement->execute(array($gid));  
    $products = array();
    while($row = $statement->fetch()) {
        $products = json_decode($row["products_array"]);
    }
    
    foreach ($products as $product)
    {
        if ($product == $product_name)
            return true;
    }
    return false;
}

?>