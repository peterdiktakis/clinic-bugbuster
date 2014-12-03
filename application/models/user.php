<?php
Class User extends CI_Model {

  // The login function receives a username and password and validates the
  // give credentials against records in the database. If it is found that both
  // the username and password are of the correct combination, the database entry
  // is returned. Otherwise, if the credentials were wrong, and a username was matched,
  // the invalid login counter will be incremented. Else, the credentials are completely
  // wrong and don't exist.
  function login($username, $password) {

    $this->db->where('USER_ID', $username);
    $login = $this->db->get('USER')->row_array();

    //If we have found someone, that means at least the username was correct.
    if (count($login) != 0) {
      //Validate the password.
      $validPassword = password_verify($password, $login['HASHED_PASSWORD']);

      //If the password is not valid, increment the invalid login counter and return.
      if (!$validPassword) {
        $this->incrementInvalidLogin($login['USER_ID'], $login['INVALIDLOGINCOUNTER']);
        return false;
      }
      //Else check to see how many previous attempts were made.
      else {
        //If they haven't logged in 5 times yet, return the database row to dump into the session.
        if ($login['INVALIDLOGINCOUNTER'] < 5) {
          $this->resetLoginCount($login['USER_ID']);
          return $login;
        }
        //Else the logged in too many times, sorry!
        else {
          return false;
        }
      }
    }
    //Else we haven't found a user with this username.
    else {
      return false;
    }

  }

  // The getInvalidLoginCount function receives a username and queries the database
  // for the number of invalid attempts the user has made to login to this account.
  function getInvalidLoginCount($username) {
    $this->db->select('INVALIDLOGINCOUNTER');
    $this->db->where('USER_ID', $username);
    $query = $this->db->get('USER')->row_array();

    if (count($query) != 0) {
      return $query['INVALIDLOGINCOUNTER'];
    }
    else {
      return false;
    }
  }

  // If the invalid login counter is already at 5, then the function returns false.
  // Else, the database is updated for the given UserId.
  private function incrementInvalidLogin($userId, $invalidCount) {

    if ($invalidCount >= 5) {
      return false;
    }

    $invalidCount++;

    $data = array(
      'INVALIDLOGINCOUNTER' => $invalidCount
    );
    $this->db->where('USER_ID', $userId);
    $this->db->update('USER', $data);

    return true;
  }

  private function resetLoginCount($userId) {
    $data = array('INVALIDLOGINCOUNTER' => 0);
    $this->db->where('USER_ID', $userId);
    $this->db->update('USER', $data);

    return true;
  }

}
?>
