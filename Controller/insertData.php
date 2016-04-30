<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

        $host="localhost";
	 $pass="dfat#2000";
	 $userName="confada2";
	 
	 $connection=null;
	 $connection=mysql_connect($host,$userName,$pass);
	if(!$connection)
        echo 'Failed to obtain a succesful connection to the localHost';
	mysql_select_db('fadama2',$connection)or die(mysql_error());
        
        $no=1;
        $phoneNo=8023195940;
         while ($no<=20000){ 
            
     //$sql="insert into farmers values('','1','34','720','6','6','nam','nam','single','Male','1','qwe','08060099476','nokia','1',now())";
       
             $sql="INSERT INTO `fadama2`.`farmers` (`ID`, `languageID`, `stateID`, `lgaID`, `fcaID`, `fugID`, `firstName`, `lastName`, `maritalStatus`, `sex`, `farmSize`, `address`, `MSISDN`, `phoneType`, `marketID`, `dateActivated`) VALUES ('', '1', '25', '510', '2', '3', 'test', NULL, 'test', 'Male', '', NULL, '$phoneNo', '', '', '2013-01-25 00:00:00');";
             mysql_query($sql)or die(mysql_error());
             
        $phoneNo++;
        $no++;
         }
//  echo crypt("He@~`-_=lo", 'CRYPT_BLOWFISH');
//  echo '<br>'. crypt("Hello", 'CRYPT_BLOWFISH');
//   echo '<br>'. crypt("Hello", CRYPT_BLOWFISH);
//  echo '<br>'. crypt("Hello", CRYPT_STD_DES);
//  echo '<br>'. crypt("wolrfuue", CRYPT_STD_DES);
// 
//   echo '<br>'. crypt("Hello", 'CRYPT_STD_DES');
//   

?>
