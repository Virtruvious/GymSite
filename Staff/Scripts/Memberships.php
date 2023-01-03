<?php 

function getMembership () {
    $db = new SQLite3("C:\\xampp\\Database\\miniGym.db");
    $sql = "SELECT * FROM membership";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();

    while ($row = $result->fetchArray()) {
        $arrayresult [] = $row;
    }
    return $arrayresult;
}

function changeMembership($status) {
    $db = new SQLite3("C:\\xampp\\Database\\miniGym.db");
    $sql = "UPDATE membership SET status = :status WHERE username = :username";
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':username', $_POST['username'], SQLITE3_TEXT);
    $stmt->bindParam(':status', $status, SQLITE3_TEXT);

    $result = $stmt->execute();

    if ($result) {
        $text = "<div class='alert alert-success fade show col-10' role='alert style=font-weight: bold;'>
        Payment status has been successfully updated!	
        </div>";
        return $text;
      } else {
        $text = "<div class='alert alert-danger fade show col-10' role='alert style=font-weight: bold;'>
        Payment status was unable to be updated. Please try again.	
        </div>";
        return $text;
      }
}