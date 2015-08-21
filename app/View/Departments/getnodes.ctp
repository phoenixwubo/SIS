<?php

$data = array();

foreach ($nodes as $node){
    $data[] = array(
        "text" => $node['Department']['dept_name'], 
        "id" => $node['Department']['id'], 
        "cls" => "folder",
    
        "leaf" => ($node['Department']['lft'] + 1 == $node['Department']['rght'])
    );
}

echo json_encode($data);

?>