<?php 
  function staffLogin()
  {
    $db = new SQLite3("C:\\xampp\\Database\\miniGym.db");
    $sql = 'SELECT * FROM auth LEFT JOIN roles ON auth.id = roles.id WHERE auth.id = :id AND auth.pwd = :password';
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':id', $_POST['id'], SQLITE3_TEXT);
    $stmt->bindParam(':password', $_POST['password'], SQLITE3_TEXT);

    $result = $stmt->execute();

    $loginarray = [];
    while ($row = $result->fetchArray()) {
      $loginarray[] = $row;
    }

    return $loginarray;
  }

  function RedirectTo ($link){
    echo '<script language="javascript">window.location.href ="'.$link.'"</script>';
}