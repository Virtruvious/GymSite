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

function membershipText($membershipdetails)
{
  $membershiptext = $paymentstatus = '';

  if (!($membershipdetails == null)) {
    if ($membershipdetails[0]['status'] == 'pending') {
      $paymentstatus = '<span class="bg-danger"><hr>Your payment status is <b>PENDING</b>, once your payment has been processed you will be able to access our gym.</span>';
    }
  }

  if (!($membershipdetails == null) AND $membershipdetails[0]['status'] == 'suspended') {
    $membershiptext = '<h5><span class="bg-danger"<b>SUSPENDED</b></span> '.ucfirst($membershipdetails[0]['type']).' Pass</h5>Your <b>MiniGym <i>PRO</i> Membership</b> has been suspended, please re-subscribe below to reactivate.<br><form method="post"><button class="btn btn-outline-light" type="submit" name="resubmonthly" style="margin-top: 10px;">Monthly Pass £13.50</button></form><form method="post"><button class="btn btn-outline-light" name="resubday" style="margin-top: 10px;">Day Pass £5.50</button></form>';
    return $membershiptext;
  }

	if ($membershipdetails == null) {
		$membershiptext = '<h5>You currently do not have an active membership.</h5>Subscribe below to get access to our gym and our wide range of benefits!<br><form method="post"><button class="btn btn-outline-light" type="submit" name="monthly" style="margin-top: 10px;">Monthly Pass £13.50</button></form><form method="post"><button class="btn btn-outline-light" name="day" style="margin-top: 10px;">Day Pass £5.50</button></form>';
	} else if ($membershipdetails[0]['type'] == 'monthly') {
		$membershiptext = '<h5> Active '.ucfirst($membershipdetails[0]['type']).' Pass</h5>You now have access to our awesome facilities and services!<hr>Your <b>MiniGym <i>PRO</i> Membership</b> expires on <b>'.$membershipdetails[0]['expires'].'</b>'.$paymentstatus;
	} else {
    $membershiptext = '<h5> Active '.ucfirst($membershipdetails[0]['type']).' Pass</h5>You now have access to our awesome facilities and services!<hr>Your <b>MiniGym <i>PRO</i> Membership</b> expires on <b>'.$membershipdetails[0]['expires'].'</b>'.$paymentstatus;
  }
	return $membershiptext;
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

function addMembership($username, $type) {
  $db = new SQLite3("C:\\xampp\\Database\\miniGym.db");
  $sql = 'INSERT INTO membership (username, type, status, expires) VALUES (:username, :type, :status, :expires)';
  $stmt = $db->prepare($sql);

  if ($type == 'monthly') {
    $expires = date('Y/m/d', strtotime("+30 days"));
  } else {
    $expires = date('Y/m/d', strtotime("+1 day"));
  }

  $status = 'pending';
  $stmt->bindParam(':username', $username, SQLITE3_TEXT);
  $stmt->bindParam(':type', $type, SQLITE3_TEXT);
  $stmt->bindParam(':status', $status, SQLITE3_TEXT);
  $stmt->bindParam(':expires', $expires, SQLITE3_TEXT);

  $stmt->execute();

  return $stmt;
}

function reactivateMembership($username, $type) {
  $db = new SQLite3("C:\\xampp\\Database\\miniGym.db");
  $sql = 'UPDATE membership SET type = :type, status = :status, expires = :expires WHERE username = :username';
  $stmt = $db->prepare($sql);

  if ($type == 'monthly') {
    $expires = date('Y/m/d', strtotime("+30 days"));
  } else {
    $expires = date('Y/m/d', strtotime("+1 day"));
  }

  $status = 'pending';
  $stmt->bindParam(':username', $username, SQLITE3_TEXT);
  $stmt->bindParam(':type', $type, SQLITE3_TEXT);
  $stmt->bindParam(':status', $status, SQLITE3_TEXT);
  $stmt->bindParam(':expires', $expires, SQLITE3_TEXT);

  $stmt->execute();

  return $stmt;
}

function expiredMembership($username) {
  $db = new SQLite3("C:\\xampp\\Database\\miniGym.db");
  $sql = 'UPDATE membership SET status = :status WHERE username = :username';
  $stmt = $db->prepare($sql);

  $status = 'suspended';
  $stmt->bindParam(':username', $username, SQLITE3_TEXT);
  $stmt->bindParam(':status', $status, SQLITE3_TEXT);
  $stmt->execute();
}