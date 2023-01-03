<?php

function getStaff () {
    $db = new SQLite3("C:\\xampp\\Database\\miniGym.db");
    $sql = "SELECT * FROM staff INNER JOIN roles on staff.id = roles.id INNER JOIN auth on staff.id = auth.id";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();

    while ($row = $result->fetchArray()) {
        $arrayresult [] = $row;
    }
    return $arrayresult;
}

function createStaff()
{
  $db = new SQLite3("C:\\xampp\\Database\\miniGym.db");
  $sql = 'INSERT INTO staff(id, fname, lname, email) VALUES (:staffid, :fname, :lname, :email)';
  $stmt = $db->prepare($sql);

  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $staffid = substr($fname, 0, 1) . substr($lname, 0, 1) . 0 . 1;

  insertauth($staffid, $_POST['password']);
  insertroles($staffid, $_POST['status'], $_POST['role']);

  $stmt->bindParam(':staffid', $staffid, SQLITE3_TEXT); 
  $stmt->bindParam(':fname', $fname, SQLITE3_TEXT);
  $stmt->bindParam(':lname', $lname, SQLITE3_TEXT);
  $stmt->bindParam(':email', $_POST['email'], SQLITE3_TEXT);

  $result = $stmt->execute();

  if ($result) {
    $text = "<div class='alert alert-success fade show col-10' role='alert style=font-weight: bold;'>
    Staff account has been successfully created!	
    </div>";
    return $text;
  } else {
    $text = "<div class='alert alert-danger fade show col-10' role='alert style=font-weight: bold;'>
    Staff account was unable to be created. Please try again.	
    </div>";
    return $text;
  }
}

function insertauth($staffid, $password) {
    $db = new SQLite3("C:\\xampp\\Database\\miniGym.db");
    $sql = "INSERT INTO auth(id, pwd) VALUES (:staffid, :password)";
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':staffid', $staffid, SQLITE3_TEXT);
    $stmt->bindParam(':password', $password, SQLITE3_TEXT);

    $stmt->execute();
}

function insertroles($staffid, $status, $role) {
    $db = new SQLite3("C:\\xampp\\Database\\miniGym.db");
    $sql = "INSERT INTO roles(id, status, role) VALUES (:staffid, :status, :role)";
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':staffid', $staffid, SQLITE3_TEXT);
    $stmt->bindParam(':status', $status, SQLITE3_TEXT);
    $stmt->bindParam(':role', $role, SQLITE3_TEXT);

    $stmt->execute();
}

function deleteStaff($id) {
    $db = new SQLite3("C:\\xampp\\Database\\miniGym.db");
    $sql = "DELETE FROM staff WHERE id = :id";
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':id', $id, SQLITE3_TEXT);

    $result = $stmt->execute();

    if ($result) {
        $text = "<div class='alert alert-success fade show col-10' role='alert style=font-weight: bold;'>
        Staff account has been successfully deleted!	
        </div>";
        return $text;
    } else {
        $text = "<div class='alert alert-danger fade show col-10' role='alert style=font-weight: bold;'>
        Staff account was unable to be deleted. Please try again.	
        </div>";
        return $text;
    }
}

function updateStatus($staffid, $status) {
    $db = new SQLite3("C:\\xampp\\Database\\miniGym.db");
    $sql = "UPDATE roles SET status = :status WHERE id = :id";
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':id', $staffid, SQLITE3_TEXT);
    $stmt->bindParam(':status', $status, SQLITE3_TEXT);

    $result = $stmt->execute();

    if ($result) {
      $text = "<div class='alert alert-success fade show col-10' role='alert style=font-weight: bold;'>
      Staff account has been set to ".$status."!	
      </div>";
      return $text;
  } else {
      $text = "<div class='alert alert-danger fade show col-10' role='alert style=font-weight: bold;'>
      Staff account was unable to be edited. Please try again.	
      </div>";
      return $text;
  }
}

function updateStaff($staffid)
  {
    $db = new SQLite3("C:\\xampp\\Database\\miniGym.db"); 
    $sql = 'UPDATE staff SET fname = :fname, lname = :lname, email = :email WHERE id = :id';
    $stmt = $db->prepare($sql);

    updateauth($staffid, $_POST['password']);
    updateroles($staffid, $_POST['status'], $_POST['role']);

    $stmt->bindParam(':id', $staffid, SQLITE3_TEXT);
    $stmt->bindParam(':fname', $_POST['fname'], SQLITE3_TEXT);
    $stmt->bindParam(':lname', $_POST['lname'], SQLITE3_TEXT);
    $stmt->bindParam(':email', $_POST['email'], SQLITE3_TEXT);

    $result = $stmt->execute();

    if ($result) {
      $text = "<div class='alert alert-success fade show col-10' role='alert style=font-weight: bold;'>
      Staff account details have been updated successfully!	
      </div>";
      return $text;
    } else {
      $text = "<div class='alert alert-danger fade show col-10' role='alert style=font-weight: bold;'>
      Staff account details have not been updated successfully. Please try again.	
      </div>";
      return $text;
    }
  }

function updateauth($staffid, $password)
{
  $db = new SQLite3("C:\\xampp\\Database\\miniGym.db");
  $sql = "UPDATE auth SET pwd = :password WHERE id = :id";
  $stmt = $db->prepare($sql);

  $stmt->bindParam(':id', $staffid, SQLITE3_TEXT);
  $stmt->bindParam(':password', $password, SQLITE3_TEXT);

  $stmt->execute();
}

function updateroles($staffid, $status, $role)
{
  $db = new SQLite3("C:\\xampp\\Database\\miniGym.db");
  $sql = "UPDATE roles SET status = :status, role = :role WHERE id = :id";
  $stmt = $db->prepare($sql);

  $stmt->bindParam(':id', $staffid, SQLITE3_TEXT);
  $stmt->bindParam(':status', $status, SQLITE3_TEXT);
  $stmt->bindParam(':role', $role, SQLITE3_TEXT);

  $stmt->execute();
}