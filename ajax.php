<?php

/*header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");*/

// Get tasks with order
if (!empty($_POST['item']) && $_POST['item'] === 'all' && $_POST['sortBy'] && !empty($_POST['order'])) {
    require ('public/database.php');
    $sql = 'SELECT * FROM item_list WHERE done = 0  ORDER BY '.$_POST['sortBy'].' '.$_POST['order'].' ';
    $query = $bdd->query($sql);
    $data = $query->fetchAll();
    echo json_encode($data);
}
else if (!empty($_POST['item']) && $_POST['item'] === 'doneTask' && $_POST['sortBy'] && !empty($_POST['order'])) {
    require ('public/database.php');
    $sql = 'SELECT * FROM item_list WHERE done = 1 ORDER BY '.$_POST['sortBy'].' '.$_POST['order'].' ';
    $query = $bdd->query($sql);
    $data = $query->fetchAll();
    echo json_encode($data);
}

/*} else if (!empty($_POST['item']) && $_POST['item'] === 'add' && !empty($_POST['sortBy']) && $_POST['sortBy'] === 'priority') {
    require public/('database.php;
    $sql = 'SELECT * FROM item_list ORDER BY priority';
    $query = $bdd->query($sql);
    $data = $query->fetchAll();
    echo json_encode($data);
} else if (!empty($_POST['item']) && $_POST['item'] === 'add' && !empty($_POST['sortBy']) && $_POST['sortBy'] === 'date') {
    require public/('database.php;
    $sql = 'SELECT * FROM item_list ORDER BY id_cat';
    $query = $bdd->query($sql);
    $data = $query->fetchAll();
    echo json_encode($data);
}*/


//Add task
else if (!empty($_POST['item']) && $_POST['item'] === 'add' && !empty($_POST['text'])) {
    require ('public/database.php');
    $sql = 'INSERT INTO `item_list` (`text`) VALUES (:text) ';
    $prep = $bdd->prepare($sql);
    $prep->bindParam(':text', $_POST['text']);
    $data = $prep->execute();
}

//Del Task
else if (!empty($_POST['item']) && $_POST['item'] === 'del' && !empty($_POST['id'])) {
    require ('public/database.php');
    $sql = 'DELETE FROM `item_list` WHERE id = :id ';
    $prep = $bdd->prepare($sql);
    $prep->bindParam(':id', $_POST['id']);
    $data = $prep->execute();
}

//mark as done task
else if (!empty($_POST['item']) && $_POST['item'] === 'done' && !empty($_POST['id'])) {
    require ('public/database.php');
    $sql = 'UPDATE item_list SET done = 1 WHERE id = :id';
    $prep = $bdd->prepare($sql);
    $prep->bindParam(':id', $_POST['id']);
    $data = $prep->execute();
}

//Mark as undone
else if (!empty($_POST['item']) && $_POST['item'] === 'undone' && !empty($_POST['id'])) {
    require ('public/database.php');
    $sql = 'UPDATE item_list SET done = 0 WHERE id = :id';
    $prep = $bdd->prepare($sql);
    $prep->bindParam(':id', $_POST['id']);
    $data = $prep->execute();
}

//increase priority task
else if (!empty($_POST['item']) && $_POST['item'] === 'addPrio' && !empty($_POST['id'])) {
    require ('public/database.php');
    $sql = 'UPDATE item_list SET priority = 1 WHERE id = :id';
    $prep = $bdd->prepare($sql);
    $prep->bindParam(':id', $_POST['id']);
    $data = $prep->execute();
}

//decrease priority task
else if (!empty($_POST['item']) && $_POST['item'] === 'rmPrio' && !empty($_POST['id'])) {
    require ('public/database.php');
    $sql = 'UPDATE item_list SET priority = 0 WHERE id = :id';
    $prep = $bdd->prepare($sql);
    $prep->bindParam(':id', $_POST['id']);
    $data = $prep->execute();
}

//edit text of task
else if (!empty($_POST['item']) && $_POST['item'] === 'edit' && !empty($_POST['text']) && !empty($_POST['id']) ) {
    require ('public/database.php');
    $sql = 'UPDATE `item_list` SET text = :text WHERE id = :id ';
    $prep = $bdd->prepare($sql);
    $prep->bindParam(':text', $_POST['text']);
    $prep->bindParam(':id', $_POST['id']);
    $data = $prep->execute();
}



