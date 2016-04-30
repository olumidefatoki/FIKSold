<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function clean($string) {
    $detagged = strip_tags($string);  
   
        $stripped = stripslashes($detagged);
        $escaped = trim(mysql_real_escape_string($stripped));
   
   
    return $escaped;
}

function checkState($data) {

    $errorList = array();
    if ($data['state'] == '-1') {
        $errorList[] = " Please  Select a state";
    }
    return $errorList;
}

function MaanageCropCheck($data) {
    $errorList = array();

    if ($data['season'] == '-1') {
        $errorList[] = 'season';
    }

    return $errorList;
}

function CPErrorCheck($data) {
    $errorList = array();
    if (empty($data['CPassword'])) {
        $errorList[] = 'CPassword';
    }
    if (empty($data['NPassword'])) {
        $errorList[] = 'NPassword';
    }
    if (empty($data['NPassword2'])) {
        $errorList[] = 'NPassword2';
    }
    if (trim($data['NPassword']) != trim($data['NPassword2'])) {
        $errorList[] = "Password Mismatch";
    }
    return $errorList;
}

function UserErrorCheck($data) {
    $errorList = array();
    if (empty($data['phoneNo'])  || strlen($data['phoneNo']) != 11) {
        $errorList[] = 'phoneNo';
    }
    else  if (!is_numeric($data['phoneNo'])) {
          $errorList[] = 'Phone Number must be a number';
    }
    if ($data['userType'] == '-1') {
        $errorList[] = 'userType';
    }
    if (empty($data['username'])) {
        $errorList[] = 'username';
    }

    return $errorList;
}

function BroadcastErrorCheck($data) {
    $errorList = array();
    if ($data['state'] == '-1') {
        $errorList[] = 'state';
    }

//    if (!isset($data['lga']) || ($data['lga']=='-1')) {
//         $errorList[]='lga';
//    }
//     
//    if (!isset($data['fca']) || $data['fca']=='-1') {
//         $errorList[]='fca';
//    }
//     
//    if (!isset($data['fug']) || $data['fug']=='-1') {
//         $errorList[]='fug';
//    }
    if ($data['season'] == -1) {
        $errorList[] = 'season';
    }
    if (!isset($data['messageTitle']) || $data['messageTitle'] == '-1') {
        $errorList[] = 'messageTitle';
    }
    if ($data['cropID'] == '-1') {
        $errorList[] = 'cropID';
    }
    if (!isset($_SESSION['msg'])) {
        $errorList[] = 'msgContent';
    }
    if (empty($data['deliveryDate'])) {
        $errorList[] = 'deliveryDate';
    }
    return $errorList;
}

function BroadcastAnimalCheck($data) {
    $errorList = array();
    if ($data['state'] == '-1') {
        $errorList[] = 'state';
    }

//    if (!isset($data['lga']) || ($data['lga']=='-1')) {
//         $errorList[]='lga';
//    }
//     
//    if (!isset($data['fca']) || $data['fca']=='-1') {
//         $errorList[]='fca';
//    }
//     
//    if (!isset($data['fug']) || $data['fug']=='-1') {
//         $errorList[]='fug';
//    }

    if (!isset($data['messageTitle']) || $data['messageTitle'] == '-1') {
        $errorList[] = 'messageTitle';
    }
    if ($data['animal'] == '-1') {
        $errorList[] = 'animal';
    }
    if (!isset($_SESSION['msg'])) {
        $errorList[] = 'msgContent';
    }
    if (empty($data['deliveryDate'])) {
        $errorList[] = 'deliveryDate';
    }
    return $errorList;
}

function cropCycleErrorCheck($data) {
    $errorList = array();
    if ($data['season'] == '-1') {
        $errorList[] = 'season';
    }
    if ($data['langID'] == '-1') {
        $errorList[] = 'langID';
    }
    if ($data['crop'] == '-1') {
        $errorList[] = 'crop';
    }
    if ($data['PackagePractise'] == '-1') {
        $errorList[] = '$PackagePractise';
    }

    return $errorList;
}

function seasonCheck($data) {
    $errorList = array();
    if ($data['langID'] == '-1') {
        $errorList[] = 'langID';
    }
    if ($data['crop'] == '-1') {
        $errorList[] = 'crop';
    }
    if (!isset($data['PackagePractise']) || $data['PackagePractise'] == '-1') {
        $errorList[] = 'PackagePractise';
    }
    return $errorList;
}

function FUGErrorCheck($data) {
    $errorList = array();
    if ($data['state'] == '-1') {
        $errorList[] = 'state';
    }
    if ($data['lga'] == '-1') {
        $errorList[] = 'lga';
    }
    if ($data['fca'] == '-1') {
        $errorList[] = 'fca';
    }
    if (empty($data['fugName'])) {
        $errorList[] = 'fugName';
    }
    if (empty($data['fugLeaderName'])) {
        $errorList[] = 'fugLeaderName';
    }
    if (empty($data['fugLeaderPhoneNo']) || strlen($data['fugLeaderPhoneNo']) != 11) {
        $errorList[] = 'fugLeaderPhoneNo';
    }

    return $errorList;
}
function MarketErrorCheck($data) {
    $errorList = array();
    if ($data['crop'] == '-1') {
        $errorList[] = 'crop';
    }
    if ($data['measurement'] == '-1') {
        $errorList[] = 'measurement';
    }
       if (empty($data['unitPrice'])   ) {
        $errorList[] = 'unitPrice';
    }
    else if(!is_numeric($data['unitPrice'])){    
        $errorList[] = 'unitPrice';    
    }
    return $errorList;
}
function agroBusinessErrorCheck($data) {
    $errorList = array();
     if (empty($data['companyName'])   ) {
        $errorList[] = 'companyName';
    }
     if (empty($data['address'])   ) {
        $errorList[] = 'address';
    }
     
       if ($data['state'] == '-1') {
        $errorList[] = 'state';
    }
     else if(!is_numeric($data['phoneNumber'])){    
        $errorList[] = 'phoneNumber';    
    }
    return $errorList;
}
function MarketPriceErrorCheck($data) {
     if (empty($data['unitPrice'])   ) {
        $errorList[] = 'unitPrice';
    }
    else if(!is_numeric($data['unitPrice'])){
    
        $errorList[] = 'unitPrice';
    
    }
}
function FCAErrorCheck($data) {
    $errorList = array();
    if ($data['state'] == '-1') {
        $errorList[] = 'state';
    }
    if (!isset($data['lga']) || ($data['lga'] == '-1')) {
        $errorList[] = 'lga';
    }

    if (empty($data['fcaName'])) {
        $errorList[] = 'fcaName';
    }
    if (empty($data['fcaLeaderName'])) {
        $errorList[] = 'fcaLeaderName';
    }
    if (empty($data['fcaLeaderPhoneNo']) || strlen($data['fcaLeaderPhoneNo']) != 11) {
        $errorList[] = 'fcaLeaderPhoneNo';
    }
    return $errorList;
}

function FarmerErrorCheck($data) {

    $errorList = array();
    if ($data['state'] == -1) {
        $errorList[] = 'state';
    }

    if (!isset($data['lga']) || ($data['lga'] == '-1')) {
        $errorList[] = 'lga';
    }

    if (!isset($data['fca']) || $data['fca'] == '-1') {
        $errorList[] = 'fca';
    }

    if (!isset($data['fug']) || $data['fug'] == '-1') {
        $errorList[] = 'fug';
    }

    if ($data['market'] == '-1') {
        $errorList[] = 'market';
    }
    if (empty($data['fName'])) {
        $errorList[] = 'fName';
    }
    if (empty($data['phoneNo']) || strlen($data['phoneNo']) != 11) {
        $errorList[] = 'phoneNo';
    }
    
    return $errorList;
}

function livestockErrorCheck($data) {
    $errorList = array();
    if ($data['livestockName'] == '-1') {
        $errorList[] = 'livestockName';
    }
    if ($data['PackagePractise'] == '-1') {
        $errorList[] = 'PackagePractise';
    }
    if ($data['langID'] == '-1') {
        $errorList[] = 'langID';
    }
}

?>
