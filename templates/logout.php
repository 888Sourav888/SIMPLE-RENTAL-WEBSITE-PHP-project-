<?php
    //This is the logout file , that destorys the session and
    // returns the user to the page where the logout button was clicked
    session_start() ;
    session_destroy() ;
    header('location:'.$_SERVER['HTTP_REFERER'] ) ;
    //the key 'HTTP_REFERER' in the server super global array contains the 
    //path of the previously loaded page 
?>