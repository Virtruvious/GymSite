<?php 
  function CheckDetails()
  {
    $db = new SQLite3("C:\\xampp\\Database\\miniGym.db"); 
    $sql = 'SELECT * FROM customer WHERE username = :username AND postcode = :postcode AND email = :email AND substr(datebirth, 6, 2) = :datebirth';
    $stmt = $db->prepare($sql); 

    $stmt->bindParam(':username', $_POST['username'], SQLITE3_TEXT);
    $stmt->bindParam(':postcode', $_POST['postcode'], SQLITE3_TEXT);
    $stmt->bindParam(':email', $_POST['email'], SQLITE3_TEXT);
    $stmt->bindParam(':datebirth', $_POST['birthmonth'], SQLITE3_TEXT);

    $result = $stmt->execute();

    $resetarray = [];
    while ($row = $result->fetchArray()) {
      $resetarray[] = $row;
    }

    return $resetarray;
  }

  function ResetPassword($username)
  {
    $db = new SQLite3("C:\\xampp\\Database\\miniGym.db"); 
    $sql = 'UPDATE customer SET password = :password WHERE username = :username';
    $stmt = $db->prepare($sql); 

    $stmt->bindParam(':password', $_POST['password1'], SQLITE3_TEXT);
    $stmt->bindParam(':username', $username, SQLITE3_TEXT);
    $stmt->execute();

    if ($stmt->execute()) {
      $text = "<div class='alert alert-success fade show col-10' role='alert style=font-weight: bold;'>
      Your password has been reset successfully!	
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
      </div>";
      return $text;
    } else {
      $text = "<div class='alert alert-danger fade show col-10' role='alert style=font-weight: bold;'>
      Your password has not been reset successfully. Please try again.	
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
      </div>";
      return $text;
    }
  }

  function errorMessage () {
    $text = "<div class='alert alert-danger fade show col-10' role='alert style=font-weight: bold;'>
    Please ensure all fields are filled.	
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
    </div>";

    return $text;
  }

  function incorrectDetails () {
    $text = "<div class='alert alert-danger fade show col-10' role='alert style=font-weight: bold;'>
    One or more of your details are incorrect.	
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
    </div>";

    return $text;
  }

  function correctDetails () {
    $text = "<div class='alert alert-success fade show col-10' role='alert style=font-weight: bold;'>
    Validated details are correct! Please now enter your new password below.	
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
    </div>";

    return $text;
  }

  function errorResetMessage () {
    $text = "<div class='alert alert-danger fade show col-10' role='alert style=font-weight: bold;'>
    Please ensure all password fields are filled.	
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
    </div>";

    return $text;
  }

  function errorPwdMatch () {
    $text = "<div class='alert alert-danger fade show col-10' role='alert style=font-weight: bold;'>
    The passwords do not match.	
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
    </div>";

    return $text;
  }