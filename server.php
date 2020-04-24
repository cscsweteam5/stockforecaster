<?php

/*
    @uthor: Ernest243
    date: 3/27/2020
*/

// Initialize var for collecting data

    $firstName = "";
    $lastName = "";
    $emailAddress = "";
    $userName = "";
    $password = "";
    $birthDate = "";
    $phoneNumber = "";

    // Array of errros
    $errors = array();

    // Establishing db connection
    $db = mysqli_connect('localhost', 'root', '', 'user_crypto');

    //Verification after the submit button has been clicked
    if(isset($_POST['submit_user'])) {

        $firstName = mysqli_real_escape_string($db, $_POST['inputFirst']);
        $lastName = mysqli_real_escape_string($db, $_POST['inputLast']);
        $emailAddress = mysqli_real_escape_string($db, $_POST['inputEmail']);
        $userName = mysqli_real_escape_string($db, $_POST['inputUser']);
        $password = mysqli_real_escape_string($db, $_POST['inputPassword']);
        $birthDate = mysqli_real_escape_string($db, $_POST['inputBirthDate']);
        $phoneNumber = mysqli_real_escape_string($db, $_POST['inputNumber']);

        // Check for error
       
        /*
        * Check for different error here such as empty field,
        * length requirement, etc. 
        */

        // if no error(s), proceed to save the user to the database
        if (count($errors == 0)) {

            //Hash the password before saving it for security purposes
            $password = md5($password);

            // Quer to insert the new user to the database
            $sql = "INSERT INTO users(FNAME, LNAME, EMAIL, USERNAME, USER_PASSWORD, BIRTH_DATE, PHONE_NUMBER) 
                    VALUES ('$firstName', '$lastName', '$emailAddress', '$userName', '$password', '$birthDate', '$phoneNumber' )";
            
            mysqli_query($db, $sql);

            echo $sql;
        }

        // Close the connection
        mysqli_close($db);
    }
?>