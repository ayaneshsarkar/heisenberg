<?php 
  session_start(); 
  
  // Flash Message Helper
  // EXAMPLE flash - ('register-success', 'You are now registered', 'alert alert-danger)
  // DISPLAY IN THE VIEW - echo flash('register_success);
  
  function flash($name = '', $message = '', $class='alert alert-success') {

    if (!empty($name)) {
      if (!empty($message) && empty($_SESSION[$name])) {

        if (!empty($_SESSION[$name])) {
          unset($_SESSION[$name]);
        }

        if (!empty($_SESSION[$name . '_class'])) {
          unset($_SESSION[$name . '_class']);
        }

        $_SESSION[$name] = $message;
        $_SESSION[$name . '_class'] = $class;

      } elseif (empty($_SESSION[$message]) && !empty($_SESSION[$name])) {

        $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
        echo '<div class="'.$class.'" id="msg-flash">'.$_SESSION[$name].'</div>';
        unset($_SESSION[$name]);
        unset($_SESSION[$name . '_class']);

      }
    }

  }

  function isLoggedIn() {
    if (isset($_SESSION['user_id'])) {
      return true;
    } else {
      return false;
    }
  }
