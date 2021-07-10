<?php 
// this delete all active sessions
Session::del();
Session::delCookie(['authId']);

// and redirect class do the directing after all the session has been deleted
goBack();