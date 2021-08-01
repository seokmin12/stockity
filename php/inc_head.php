<?php
  session_start();
  if( isset( $_SESSION['id'] ) ) {
    $user_login = TRUE;
  }
?>