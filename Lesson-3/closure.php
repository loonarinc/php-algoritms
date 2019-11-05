<?php
function getClosure()
{
    $database = 'shop';
    $user = 'shop';
    $pass = '123456';
    $host = 'localhost';
    $charset = 'utf8';
    $dsn = "mysql:host=$host;dbname=$database;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass);
    $sql = 'SELECT * FROM categories_db AS c JOIN category_links AS cl ON c.id_category = cl.child_id';
    $data = $pdo->query($sql);
    return $data->fetchAll();
}

function rebuildArray($categories) {
    $result = [];
    foreach ($categories as $category) {
        if(!isset($result[$category['level']]))
        {
            $result[$category['level']] = [];
        }
        $result[$category['level']][$category['child_id']] = $category;
    }
    return $result;
}

function buildTree($categories, $lvl = 0) {
    if (isset($categories[$lvl]))
    {
        $out = '<ul>';
        foreach ($categories[$lvl] as $category) {
            $out .= '<li>' . $category['category_name'];
            if($category['parent_id'] == $category['child_id'])
            {
                $out .= buildTree($categories, $category['level']+1);
            }
            $out .= '</li>';
        }
        $out .= '</ul>';
        return $out;
    }
}
function getTree($categories) {
    return buildTree(rebuildArray($categories));
}
echo getTree(getClosure());
