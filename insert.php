<?php

    session_start();
    if($_SESSION['user']['type'] == "administrator"){
        echo "<form action='insert.php' method='post'>";
        echo "<label>Employee ID:</label><br />";
        echo "<input type='text' name='employee_id' placeholder='Enter ID' required/>";
        echo "<br/><br/>";
        echo "<label>Email:</label><br />";
        echo "<input type='text' name='email' placeholder='Enter Email' required/>";
        echo "<br/><br/>";
        echo "<label>First Name:</label><br />";
        echo "<input type='text' name='firstname' placeholder='Enter First Name' required/>";
        echo "<br/><br/>";
        echo "<label>Last Name:</label><br />";
        echo "<input type='text' name='lastname' placeholder='Enter Last Name' required/>";
        echo "<br/><br/>";

        echo "<button type='submit' name='submit' value='create'>Submit</button>";
        echo "</form>";

        include("display.php");

        if($_POST['submit']=="create"){
            $dom = new DOMDocument ();
            $dom->load('employees.xml');
            $list = $dom->getElementsByTagName('employee');
            if($list){
                foreach ($list as $employee){
                    if($employee->getElementsByTagName('employee_id')->item(0)->nodeValue == $_POST['employee_id']){
                        echo "Sorry, the SID you typed in has already existed in the table. Try a new one!";
                        exit;
                    }
                }
            }

            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;
            
            $employee = $dom->createElement('employee');
            $employee->appendChild($dom->createElement('employee_id', $_POST['employee_id']));
            $employee->appendChild($dom->createElement('email', $_POST['email']));
            $employee->appendChild($dom->createElement('lastname', $_POST['lastname']));
            $employee->appendChild($dom->createElement('firstname', $_POST['firstname']));
            $dom->documentElement->appendChild($employee);

            if($doc = $dom->save('employees.xml'))
                echo("<meta http-equiv='refresh' content='0'>");
            else 
                echo "Error while saving the employee !";
        }
    } else  
        echo "Sorry! You need to be logged as ADMINISTRATOR to access this page!";

?>