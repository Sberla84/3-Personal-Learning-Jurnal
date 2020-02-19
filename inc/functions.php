<?php

function add_column(){
    include 'connections.php';
    $sql = 'ALTER table entries ADD tags TEXT';
    try {
        $result = $db->query($sql);
    } catch (Exception $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        return false;
    }
}


function get_entry($entry_id){
    include 'connections.php';
    
    $sql = 'SELECT * FROM entries WHERE id = ?';
    
    try {
        $result = $db->prepare($sql);
        $result->bindValue(1, $entry_id, PDO::PARAM_INT);
        $result->execute();
    } catch (Exception $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        return false;
    }
    return $result->fetch();
}

function add_entry($title, $date, $time_spent, $learned, $resources, $tags, $entry_id = null){
    include 'connections.php';

    if ($entry_id) {
        $sql = 'UPDATE entries SET title = ?, date = ?, time_spent = ?, learned = ?, resources = ?, tags = ? WHERE id = ?';
    } else {
        $sql = 'INSERT INTO entries (title, date, time_spent, learned, resources, tags) VALUES(?, ?, ?, ?, ?, ?)';
    }

    try {
        $results = $db->prepare($sql);
        $results->bindValue(1, $title, PDO::PARAM_STR);
        $results->bindValue(2, $date, PDO::PARAM_STR);
        $results->bindValue(3, $time_spent, PDO::PARAM_STR);
        $results->bindValue(4, $learned, PDO::PARAM_STR);
        $results->bindValue(5, $resources, PDO::PARAM_STR);
        $results->bindValue(6, $tags, PDO::PARAM_STR);
        if ($entry_id) {
            $results->bindValue(7, $entry_id, PDO::PARAM_INT); 
        }
        $results->execute();
    } catch (Exception $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        return false;
    }
    return true;
}

function delete_entry($entry_id){
    include 'connections.php';

    $sql = 'DELETE FROM entries WHERE id= ?';

    try {
        $result = $db->prepare($sql);
        $result->bindValue(1, $entry_id, PDO::PARAM_INT);
        $result->execute();
    } catch (Exception $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        return false;
    }
    return true;
}
