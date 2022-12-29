<?php

function getDetails($username) {
    $db = new SQLite3("C:\\xampp\\Database\\miniGym.db");
    $sql = 'SELECT * FROM customer WHERE username = :username';
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':username', $username, SQLITE3_TEXT);

    $result = $stmt->execute();

    $userarray = [];
    while ($row = $result->fetchArray()) {
      $userarray[] = $row;
    }

    $userarray = array_values($userarray);

    return $userarray;
}

function checkMembership($username) {
    $db = new SQLite3("C:\\xampp\\Database\\miniGym.db");
    $sql = 'SELECT * FROM membership WHERE username = :username';
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':username', $username, SQLITE3_TEXT);

    $result = $stmt->execute();

    $membershiparray = [];
    while ($row = $result->fetchArray()) {
      $membershiparray[] = $row;
    }

    $membershiparray = array_values($membershiparray);

    return $membershiparray;
}