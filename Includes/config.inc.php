<?php
    /*
        This file does the following:
        -Has site settings in one location
        -Stores URLs and URIs as constants
        -Sets how errors will be handled
        -Establishes a connection to the database
    */

    //Errors are emailed here
    $contact_email = 'mudashiruagm@gmail.com';

    //Determine whether we are working on a local server
    //or a real server
    if (stristr($_SERVER['HTTP_HOST'],'local') || (strstr($_SERVER['HTTP_HOST'],0,7) == '192.168')){
        $local = TRUE;
    }
    else{
        $local = FALSE;
    }

    //Determine the location of files and URL
    if ($local){
        //Always debug when running locally
        $debug = TRUE;

        //Define the constants
        DEFINE('BASE_URI','C:/xampp/htdocs/Widget_Shopping/');
        DEFINE('BASE_URL','http://localhost/Widget_Shopping/');
    }
    else{

    }
    
    //Assume debugging is off
    if (!isset($debug)){
        $debug = FALSE;
    }

    //Error Management
    function my_error_handler($e_number,$e_message,$e_file,$e_line,$e_vars){
        global $debug, $contact_email;

        //Build the error message
        $message = "An error occured in script '$e_file ' on line $e_line: <br /><br />
                    $e_message <br /><br />";

        //Add Date and Time
        $message .= "Date/Time:" . date('n-j-Y H:i:s') . "<br />";
        
        $message .= "<pre>" . print_r($e_vars,1) . "</pre><br /><br />";

        if ($debug){ //Show the error
            echo '<p class="error">' . $message . '</p>';
        }
        else{
            //Log the error
            error_log($message,1,$contact_email); //Send email

            //Only print error message if its not a notice or strict
            if (($e_number != E_NOTICE) && ($e_number < 2038)){
                echo '<p class="error">A System error occurred, We apologize for the inconvenience.</p>';
            }
        }//End of $debug if

    } //End of function

    //Use my error handler
    set_error_handler('my_error_handler');


    //Database stuff
    DEFINE('DB_HOST','localhost');
    DEFINE('DB_USER','root');
    DEFINE('DB_PASSWORD','iambad0245389652');
    DEFINE('DB_NAME','widget_shopping');

   @ $db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR trigger_error("Could not connect");

    function escape_date($data){
        global $db;

        if (ini_get('magic_quotes_gpc')){
            $data = stripslashes($data);

        }

        //Trim
        return mysqli_real_escape_string($db,trim($data));
    }
?>