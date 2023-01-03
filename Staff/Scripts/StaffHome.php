<?php

function GetStaffDetails($id) {
    $db = new SQLite3("C:\\xampp\\Database\\miniGym.db");
    $sql = 'SELECT * FROM staff LEFT JOIN roles ON staff.id = roles.id WHERE staff.id = :id';
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':id', $id, SQLITE3_TEXT);

    $result = $stmt->execute();

    $staffDetails = [];
    while ($row = $result->fetchArray()) {
        $staffDetails[] = $row;
    }

    return $staffDetails;
}