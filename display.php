<?php
    session_start();
    if($_SESSION['user']){
        $doc = new DOMDocument ();
        $doc->load('employees.xml');
        $list = $doc->getElementsByTagName('employee');
        if($list){
            echo "<table border='1'>";
            echo "<tr><td width='100'> ID </td> <td width='100'> First Name </td> <td width='100'> Last Name </td></tr>";
            foreach ($list as $employee){
                echo "<tr>";
                echo "<td width='200'>";
                echo $employee->getElementsByTagName('employee_id')->item(0)->nodeValue;
                echo " (";
                echo $employee->getElementsByTagName('email')->item(0)->nodeValue;
                echo ") ";
                echo "</td><td width='100'>";
                echo $employee->getElementsByTagName('firstname')->item(0)->nodeValue;
                echo "</td><td width='100'>";
                echo $employee->getElementsByTagName('lastname')->item(0)->nodeValue;
                echo "</td></tr>";
            }

            echo "</table>";
        } else 
            echo "No employees !";
    } else
        echo "Sorry! You need to be logged to access this page!";
?>