<?php

include_once('entity.php');
include_once('utils.php');
include_once('SanitizeData.php');
include_once('ManageSessions.php');

function checkSession() {
    if (!isset($_SESSION['menuName'])) {
    header('location:../index.php');    
    exit;
    exit();
}
if (!isset($_SESSION['menuTableName'])) {
    header('location:../index.php');    
    exit;
    exit();
}
}
if (isset($_GET['menuTableName']) && isset($_GET['menuName'])) {
    unset($_SESSION['query']);
    unset($_SESSION['genricQuery']);
      entity::DbConnect();
    $_SESSION['menuName'] =clean($_GET['menuName']);
    $_SESSION['menuTableName'] = clean($_GET['menuTableName']);
    $menuTableName = clean($_GET['menuTableName']);
    mysql_close();
    if ($menuTableName == 'users') {
        header("Location:../View/ViewUsers.php");
        exit();
        exit;
    }
    else if ($menuTableName == 'lifecycle') {
        header("Location:../View/CropLifeCycle.php");
        exit();
        exit;
    }
    else if ($menuTableName == 'agrobusiness') {
        header("Location:../View/ViewAgroBusinessDealer.php");
        exit();
        exit;
    }
    else if ($menuTableName == 'broadcast') {
        header("Location:../View/ViewBroadcast.php");
        exit();
        exit;
    } else if ($menuTableName == 'farmers') {
        header("Location:../View/ViewFarmers.php");
        exit();
        exit;
    } else if ($menuTableName == 'fca') {
        header("Location:../View/ViewFca.php");
        exit();
        exit;
    } else if ($menuTableName == 'fug') {
        header("Location:../View/ViewFug.php");
        exit();
        exit;
    } else if ($menuTableName == 'markets') {
        header("Location:../View/ViewMarket.php");
        exit();
        exit;
    } else if ($menuTableName == 'animalhusbandry') {
        header("Location:../View/ViewAnimalHusbandry.php");
        exit();
        exit;
    } 
    else if ($menuTableName == 'vegetable') {
        header("Location:../View/ViewVegetable.php");
        exit();
        exit;
    }
    else if ($menuTableName == 'in_season' || $menuTableName == 'pre_season' || $menuTableName == 'post_season') {
        header("Location:../View/ViewSeasons.php");
        exit();
        exit;
    } else {
        header("Location:../View/ViewList.php");
    }
}
else if (isset($_GET['viewCropSold'])){
    unset($_SESSION['query']);
    unset($_SESSION['genricQuery']);
         $marketID=$_GET['marketID'];
         
       header("Location:../View/ViewMarketCrops.php?marketID=$marketID");
}
else if (isset($_GET['viewLivestockSold'])){
    unset($_SESSION['query']);
    unset($_SESSION['genricQuery']);
         $marketID=$_GET['marketID'];
         
       header("Location:../View/ViewMarketLivestockSold.php?marketID=$marketID");
}
else if (isset($_GET['parentTable']) && isset($_GET['childTable']) && isset($_GET['recID'])) {
    entity::DbConnect();
    $parentTable = clean($_GET['parentTable']);
    $childTable = clean($_GET['childTable']);
    $recID = clean($_GET['recID']);
     mysql_close();
    if ($parentTable == 'crops' && $childTable == 'diseases') {
        header("Location:../View/ViewCropDisease.php?recID=$recID&parentTable=$parentTable&childTable=$childTable");
    }
    else if ($parentTable == 'crops' && $childTable == 'fertilizers') {
        header("Location:../View/ViewCropFertilizer.php?recID=$recID&parentTable=$parentTable&childTable=$childTable");
    }
    else if ($parentTable == 'crops' && $childTable == 'pests') {
        header("Location:../View/ViewCropPest.php?recID=$recID&parentTable=$parentTable&childTable=$childTable");
    }
   else  if ($parentTable == 'crops' && $childTable == 'herbicides') {
        header("Location:../View/ViewCropHerbicides.php?recID=$recID&parentTable=$parentTable&childTable=$childTable");
    }
   else  if ($parentTable == 'crops' && $childTable == 'varietys') {
        header("Location:../View/ViewCropVariety.php?recID=$recID&parentTable=$parentTable&childTable=$childTable");
    }
}
else if (isset($_GET['ViewSeasonRec'])) {
    
    $ViewRecord = $_GET['ViewSeasonRec'];
    $tableName = $_SESSION['menuTableName'];
    if ($tableName == 'in_season') {
        header("Location:../View/ViewInSeasonRec.php?ViewRecord=$ViewRecord");
    }
    else if ($tableName == 'pre_season') {
        header("Location:../View/ViewPreSeasonRec.php?ViewRecord=$ViewRecord");
    }
   else  if ($tableName == 'post_season') {
        header("Location:../View/ViewPostSeasonRec.php?ViewRecord=$ViewRecord");
    }
}
else if (isset($_GET['ViewRecord'])) {
    $ViewRecord = $_GET['ViewRecord'];
    $tableName = $_SESSION['menuTableName'];
      //echo $tableName;die();
      
    if ($tableName == 'farmers') {
        header("Location:../View/ViewFarmerRecord.php?ViewRecord=$ViewRecord");
    } 
   
    else if ($tableName == 'marketcrop') {
        header("Location:../View/ViewMarketCropRecord.php?ViewRecord=$ViewRecord");
    }
    else if ($tableName == 'broadcast') {
        header("Location:../View/MonitorBroadcast.php?ViewRecord=$ViewRecord");
    } else if ($tableName == 'farmergroups') {
        header("Location:../View/ViewFarmerGroupRecord.php?ViewRecord=$ViewRecord");
    } else if ($tableName == 'markets') {
        header("Location:../View/ViewMarketRecord.php?ViewRecord=$ViewRecord");
    } else if ($tableName == 'fca') {
        header("Location:../View/ViewFcaRecord.php?ViewRecord=$ViewRecord");
    } else if ($tableName == 'fug') {
        header("Location:../View/ViewFugRecord.php?ViewRecord=$ViewRecord");
    } else if ($tableName == 'animalhusbandry' || $tableName == 'piggery' || $tableName == 'snail' || $tableName == 'poultry') {
        header("Location:../View/searchAnimals.php?ViewRecord=$ViewRecord");
    } else if ($tableName == 'users') {
        header("Location:../View/ViewUsersRecord.php?ViewRecord=$ViewRecord");
    } else {
        header("Location:../View/ViewRecord.php?ViewRecord=$ViewRecord");
    }
}
else if (isset($_GET['broadcastId'])) {

    $broadcastID = $_GET['broadcastId'];
    $result = entity::fetchtotalFarmer($broadcastID);
    echo mysql_result($result, 0, 0);
}
else if (isset($_GET['loadFarmer'])) {
    $id = $_GET['loadFarmer'];
    $result = entity::fetchloadedFarmer($id);
    echo mysql_result($result, 0, 0);
}
else if (isset($_GET['broadcastCropID']) && isset($_GET['msgTitle']) && isset($_GET['season'])) {
    entity::DbConnect();
    $cropID = clean($_GET['broadcastCropID']);
    $msgTitle =clean($_GET['msgTitle']);
    $season = clean($_GET['season']);
     $langID = clean($_GET['langID']);
    // echo  $cropID. $msgTitle. $season;
    $result = entity::fetchMessage($msgTitle, $season, $cropID,$langID);
    $rows = mysql_num_rows($result);
    if ($rows > 0) {
        $msg = mysql_result($result, 0, 0);
        $_SESSION['msg'] = $msg;
        $list = splitContent($msg);
        foreach ($list as $value) {
            echo $value;
        }
    } else {
        echo "No Sms Message";
    }
}
else if (isset($_GET['seasonType'])) {
      entity::DbConnect();
    $seasonType = clean($_GET['seasonType']);
    $result = entity::fetchEntityList($seasonType);
    $col = mysql_num_fields($result);
    for ($index = 4; $index < $col; $index++) {
        $fieldname = mysql_fieldname($result, $index);
        $id = $fieldname;
        $data = $fieldname;
        echo '<option value="' . $id . '">' . $data . '</option>';
    }
}
else if (isset($_GET['animalPractise'])) {
     entity::DbConnect();
    $animalPractise = clean(strtolower(trim($_GET['animalPractise'])));
    $result = entity::fetchEntityList($animalPractise);
    $col = mysql_num_fields($result);
    for ($index = 3; $index < $col; $index++) {
        $fieldname = mysql_fieldname($result, $index);
        $id = $fieldname;
        $data = $fieldname;
        echo '<option value="' . $id . '">' . $data . '</option>';
    }
}
else if (isset($_GET['add'])) {
    $action = 'add';
    $tableName = $_SESSION['menuTableName'];   
    if ($tableName == 'fishery') {
        header("Location:../View/Managefishery.php?action=$action");
    }
    else if ($tableName == 'agrobusiness') {
        $marketID=$_GET['marketID'];
        header("Location:../View/ManageAgroBusiness.php?action=$action");
    }
    else if ($tableName == 'marketcrop') {
        $marketID=$_GET['marketID'];
        header("Location:../View/ManageMarketCrop.php?action=$action&marketID=$marketID");
    }
    else if ($tableName == 'marketlivestock') {
        $marketID=$_GET['marketID'];
        header("Location:../View/ManageMarketLivestock.php?action=$action&marketID=$marketID");
    }
    else if ($tableName == 'cattle') {
        header("Location:../View/ManageCattle.php?action=$action");
    }
    else if ($tableName == 'okra') {
        header("Location:../View/ManageOkra.php?action=$action");
    }
    else if ($tableName == 'carrot') {
        header("Location:../View/ManageCarrot.php?action=$action");
    }
    else if ($tableName == 'cabbage') {
        header("Location:../View/ManageCabbage.php?action=$action");
    }
    else if ($tableName == 'watermelon') {
        header("Location:../View/ManageWater-Melon.php?action=$action");
    }
    else if ($tableName == 'onion') {
        header("Location:../View/ManageOnion.php?action=$action");
    }
     else if ($tableName == 'snail') {
        header("Location:../View/ManageSnail.php?action=$action");
    }
     else if ($tableName == 'poultry') {
        header("Location:../View/ManagePoultry.php?action=$action");
    }
     else if ($tableName == 'piggery') {
        header("Location:../View/ManagePiggery.php?action=$action");
    }
    else if ($tableName == 'users') {
        header("Location:../View/ManageUsers.php?action=$action");
    }
     else if ($tableName == 'fertilizers') {
        header("Location:../View/ManageFertilizer.php?action=$action");
    } else if ($tableName == 'crops') {
        header("Location:../View/ManageCrop.php?action=$action");
    } else if ($tableName == 'diseases') {
        header("Location:../View/ManageDisease.php?action=$action");
    } else if ($tableName == 'farms') {
        header("Location:../View/ManageFarm.php?action=$action");
    } else if ($tableName == 'farmers') {
        header("Location:../View/ManageFarmer.php?action=$action");
    } else if ($tableName == 'pests') {
        header("Location:../View/ManagePest.php?action=$action");
    } else if ($tableName == 'farmergroups') {
        header("Location:../View/ManageFarmerGroup.php?action=$action");
    } else if ($tableName == 'harvests') {
        header("Location:../View/ManageHarvest.php?action=$action");
    } else if ($tableName == 'markets') {
        header("Location:../View/ManageMarket.php?action=$action");
    } else if ($tableName == 'traders') {
        header("Location:../View/ManageTrader.php?action=$action");
    } else if ($tableName == 'croppestmappings') {

        header("Location:../View/AddCropPest.php?action=$action");
    } else if ($tableName == 'cropfertilizermappings') {
        header("Location:../View/AddCropFertilizer.php?action=$action");
    } else if ($tableName == 'cropdiseasemappings') {
        header("Location:../View/AddCropDisease.php?action=$action");
    } else if ($tableName == 'pesticides') {
        header("Location:../View/ManagePesticide.php?action=$action");
    } else if ($tableName == 'cropherbicides') {

        header("Location:../View/AddCropHerbicides.php?action=$action");
    } else if ($tableName == 'cropvarietys') {
        header("Location:../View/AddCropVariety.php?action=$action");
    } else if ($tableName == 'pestpesticidemappings') {
        header("Location:../View/AddPestPesticides.php?action=$action");
    } else if ($tableName == 'tradercropsolds') {
        header("Location:../View/AddTraderCrop.php?action=$action");
    } else if ($tableName == 'pestpesticidemappings') {
        header("Location:../View/AddPestPesticides.php?action=$action");
    } else if ($tableName == 'marketcrops') {
        header("Location:../View/AddMarketCrop.php?action=$action");
    } else if ($tableName == 'herbicides') {
        header("Location:../View/ManageHerbicide.php?action=$action");
    } else if ($tableName == 'in_season') {
        header("Location:../View/ManageInSeason.php?action=$action");
    } else if ($tableName == 'pre_season') {
        header("Location:../View/ManagePreSeason.php?action=$action");
    } else if ($tableName == 'post_season') {
        header("Location:../View/ManagePostSeason.php?action=$action");
    } else if ($tableName == 'broadcast') {
        header("Location:../View/SelectBroadcastTarget.php?action=$action");
    } else if ($tableName == 'fca') {
        header("Location:../View/ManageFca.php?action=$action");
    } else if ($tableName == 'fug') {
        header("Location:../View/ManageFug.php?action=$action");
    }
}
else if (isset($_GET['update'])) {
    $action = 'update';
    $tableName = $_SESSION['menuTableName'];
     //echo $tableName;DIE();
    if ($tableName == 'fertilizers') {
        $id = $_GET['redID'];
        header("Location:../View/ManageFertilizer.php?action=$action&id=$id");
    }
    else if ($tableName == 'marketcrop') {
        $id = $_GET['redID'];
        header("Location:../View/ManageMarketCrop.php?action=$action&id=$id");
    }
    else if ($tableName == 'piggery') {
        $id = $_GET['redID'];
        header("Location:../View/ManagePiggery.php?action=$action&id=$id");
    }
    else if ($tableName == 'poultry') {
        $id = $_GET['redID'];
        header("Location:../View/ManagePoultry.php?action=$action&id=$id");
    }
    else if ($tableName == 'snail') {
        $id = $_GET['redID'];
        header("Location:../View/ManageSnail.php?action=$action&id=$id");
    }
    else if ($tableName == 'fishery') {
        $id = $_GET['redID'];
        header("Location:../View/ManageFishery.php?action=$action&id=$id");
    }
    else if ($tableName == 'crops') {
        $id = $_GET['redID'];
        header("Location:../View/ManageCrop.php?action=$action&id=$id");
    }
   else  if ($tableName == 'diseases') {
        $id = $_GET['redID'];
        header("Location:../View/ManageDisease.php?action=$action&id=$id");
    }
    else if ($tableName == 'farms') {
        $id = $_GET['redID'];
        header("Location:../View/ManageFarm.php?action=$action&id=$id");
    }
    else if ($tableName == 'pests') {
        $id = $_GET['redID'];
        header("Location:../View/ManagePest.php?action=$action&tableName=Pest&id=$id");
    }
    else if ($tableName == 'markets') {
        $id = $_GET['redID'];
        header("Location:../View/ManageMarket.php?action=$action&tableName=Market&id=$id");
    }
    else if ($tableName == 'farmergroups') {
        $id = $_GET['redID'];
        header("Location:../View/ManageFarmerGroup.php?action=$action&tableName=FarmerGroup&id=$id");
    }
    else if ($tableName == 'farmers') {
        $id = $_GET['redID'];
        header("Location:../View/ManageFarmer.php?action=$action&tableName=Farmer&id=$id");
    }
   else if ($tableName == 'traders') {
        $id = $_GET['redID'];
        header("Location:../View/ManageTrader.php?action=$action&tableName=Trader&id=$id");
    }
    else if ($tableName == 'pesticides') {
        $id = $_GET['redID'];
        header("Location:../View/ManagePesticide.php?action=$action&tableName=Pesticide&id=$id");
    }
    else if ($tableName == 'herbicides') {
        $id = $_GET['redID'];
        header("Location:../View/ManageHerbicide.php?action=$action&tableName=Herbicide&id=$id");
    }
    else if ($tableName == 'in_season') {
        $id = $_GET['redID'];
        header("Location:../View/ManageInSeason.php?action=$action&tableName=$tableName&id=$id");
    }
    else if ($tableName == 'pre_season') {
        $id = $_GET['redID'];
        header("Location:../View/ManagePreSeason.php?action=$action&tableName=$tableName&id=$id");
    }
    else if ($tableName == 'post_season') {
        $id = $_GET['redID'];
        header("Location:../View/ManagePostSeason.php?action=$action&tableName=$tableName&id=$id");
    }
}
else if (isset($_GET['delete'])) {
    $action = 'delete';
    $tableName = $_SESSION['menuTableName'];
    $id = $_GET['redID'];
    entity::deleteRecord($tableName, $id);
    header("Location:../View/ViewList.php?actionSuccessfull&tableName=$tableName");
}
else if (isset($_POST['Next'])) {
    $errorList = MaanageCropCheck($_POST);
    if (count($errorList) > 0) {
        $_SESSION['error'] = $errorList;
        header("Location:../View/SelectSeason.php?action=add");
    } else {
        $_SESSION['menuTableName'] = $_POST['season'];
        $_SESSION['menuName'] = $_POST['season'];
        header("Location:../View/Season.php");
    }
}
else if (isset($_POST['NextBroadcast'])) {
    $errorList = MaanageCropCheck($_POST);
    if (count($errorList) > 0) {
        $_SESSION['error'] = $errorList;
        header("Location:../View/SelectBroadcastTarget.php?action=add");
    } else {
        $_SESSION['menuTableName'] = $_POST['season'];
        $_SESSION['menuName'] = $_POST['season'];
        $data = $_POST['season'];
        if ($data == 'animal') {
            header("Location:../View/BroadcastAnimal.php?action=add");
        } else if ($data == 'crop') {
            header("Location:../View/SelectCropBroadcastTarget.php?action=add");
        }
    }
}
else if (isset($_POST['NextBroadcast'])) {
    $errorList = MaanageCropCheck($_POST);
    if (count($errorList) > 0) {
        $_SESSION['error'] = $errorList;
        header("Location:../View/SelectBroadcastTarget.php?action=add");
    } else {
        $_SESSION['menuTableName'] = $_POST['season'];
        $_SESSION['menuName'] = $_POST['season'];
        $data = $_POST['season'];
        if ($data == 'animal') {
            header("Location:../View/BroadcastAnimal.php?action=add");
        } else if ($data == 'crop') {
            header("Location:../View/SelectCropBroadcastTarget.php?action=add");
        }
    }
}
else if (isset($_POST['NextCropBroadcast'])) {
    $errorList = MaanageCropCheck($_POST);
    if (count($errorList) > 0) {
        $_SESSION['error'] = $errorList;
        header("Location:../View/SelectCropBroadcastTarget.php?action=add");
    } else {
        $_SESSION['menuTableName'] = $_POST['season'];
        $_SESSION['menuName'] = $_POST['season'];
        $data = $_POST['season'];
        if ($data == 'vegatable') {
            header("Location:../View/BroadcastVegetable.php?action=add");
        } else if ($data == 'others') {
            header("Location:../View/BroadcastCrop.php?action=add");
        }
    }
}
else if (isset($_POST['changePassword'])) {   
    $errorList = CPErrorCheck($_POST);
    if (count($errorList) > 0) {
        $_SESSION['error'] = $errorList;
        header("Location:../View/ChangePassword.php");
    } else {
        $UserId = $_SESSION['UserID'];
        entity::DbConnect();
        $password = entity::fetchPassword($UserId);
        if ($password == trim($_POST['CPassword'])) {
            $newPassword = clean($_POST['NPassword']);
            entity::updateUser($newPassword, $UserId);
            $userPhone= $_SESSION['UserPhone'];
            $userName= $_SESSION['username'];
             $msg = "Dear {$userName},your password was successfully changed.Your new password is $newPassword.Send your comment,complains,suggestion on FIKS site to support@fiks.com.ng. ";
             $header = "Fadama";                 
             entity::insertMessage($userPhone, $msg, $header);
            header("Location:../View/ChangePassword.php?action=Success");
        } else {
            header("Location:../View/ChangePassword.php?respond");
        }
    }
}
else if (isset($_POST['createUsers'])) {
    checkSession();
    $errorList = UserErrorCheck($_POST);
    if (count($errorList) > 0) {
        $_SESSION['error'] = $errorList;
        header("Location:../View/ManageUsers.php?action=add");
    } else {
        entity::DbConnect();
        $username = clean($_POST['username']);
        $phoneNo = clean($_POST['phoneNo']);
        $userType = clean($_POST['userType']);
        $userCategory = $_SESSION['UserType'];
        if ($userCategory == 'State') {
            $state = $_SESSION['stateId'];
        } else if ($userCategory == 'SuperAdmin') {
            if (isset($_POST['state'])) {
                $state = clean($_POST['state']);
            } else {
                $state = "";
            }
        }

        if (isset($_POST['lga'])) {
            $lga = $_POST['lga'];
        } else {
            $lga = "";
        }
        if (isset($_POST['fca'])) {
            $fca = $_POST['fca'];
        } else {
            $fca = "";
        }
        if (isset($_POST['fug'])) {
            $fug = $_POST['fug'];
        } else {
            $fug = "";
        }
        if ($userType == 'FADAMA') {
            $privilege = 2;
        } elseif ($userType == 'STATE') {
            $privilege = 3;
        } elseif ($userType == 'FARMER') {
            $privilege = 4;
        } 
            $recCount= entity::checkUsersRecord($phoneNo);      
        if ($recCount>0) {
         header("Location:../View/ManageUsers.php?action=$action&respond=duplicateEntry"); 
        }
        else{
        $password = genPassword();
        $msg = "Dear {$username},your account has been created on FIKS .Your username is {$phoneNo} and password is {$password}.Send your comment,complains,suggestion on FIKS site to support@fiks.com.ng.";
        $header = "Fadama";
        $id = entity::insertUsers($username, $state, $lga, $fca, $fug, $phoneNo, $password, $privilege);
        entity::insertMessage($phoneNo, $msg, $header);
        mysql_close();
        header("Location:../View/ManageUsers.php?action=Success");
    }
}
    }
else if (isset($_POST['add'])) {
    checkSession();
    $action = 'add';
    $tableName = $_SESSION['menuTableName'];
    //echo $tableName; die();

    if ($tableName == 'fca') {
        $errorList = FCAErrorCheck($_POST);
        if (count($errorList) > 0) {
            $_SESSION['error'] = $errorList;
            header("Location:../View/ManageFca.php?action=add");
        } else {
            entity::DbConnect();
            $state = clean($_POST['state']);
            $lga = clean($_POST['lga']);
            $fcaName = clean($_POST['fcaName']);
            $fcaLeaderName = clean($_POST['fcaLeaderName']);
            $fcaLeaderPhoneNo = clean($_POST['fcaLeaderPhoneNo']);
            $id = entity::insertFca($fcaName, $fcaLeaderName, $fcaLeaderPhoneNo, $state, $lga);
            mysql_close();
            header("Location:../View/ViewFcaRecord.php?ViewRecord=$id&action=$action");
        }
    }
    else  if ($tableName == 'marketcrop') {       
        $errorList = MarketErrorCheck($_POST); 
        //var_dump($errorList);die();
        if (count($errorList) > 0) {
            $_SESSION['error'] = $errorList;
            $marketID=$_POST['marketID'];
            header("Location:../View/ManageMarketCrop.php?action=add&marketID=$marketID");
        } else {           
            entity::DbConnect();
            $cropID = clean($_POST['crop']);
            $unitPrice = clean($_POST['unitPrice']);
            $cropMeasurementID = clean($_POST['measurement']);
            $marketID = clean($_POST['marketID']);
            $recCount= entity::checkMarketCrop($marketID,$cropID,$cropMeasurementID);      
        if ($recCount>0) {
         header("Location:../View/ManageMarketCrop.php?action=add&marketID=$marketID&respond=duplicateEntry"); 
        }
        else{
            $id = entity::insertMarketCrop($cropID, $unitPrice, $cropMeasurementID, $marketID);
            mysql_close();
             header("Location:../View/ViewMarketCropRecord.php?ViewRecord=$id");
            //header("Location:../View/ViewFugRecord.php?ViewRecord=$id&action=$action");
            }
        }
    }
    else  if ($tableName == 'marketlivestock') {       
        $errorList = MarketErrorCheck($_POST); 
        //var_dump($errorList);die();
        if (count($errorList) > 0) {
            $_SESSION['error'] = $errorList;
            $marketID=$_POST['marketID'];
            header("Location:../View/ManageMarketLivestock.php?action=add&marketID=$marketID");
        } else {           
            entity::DbConnect();
            $cropID = clean($_POST['crop']);
            $unitPrice = clean($_POST['unitPrice']);
            $cropMeasurementID = clean($_POST['measurement']);
            $marketID = clean($_POST['marketID']);
            $recCount= entity::checkMarketLivestock($marketID,$cropID,$cropMeasurementID);      
        if ($recCount>0) {
         header("Location:../View/ManageMarketLivestock.php?action=add&marketID=$marketID&respond=duplicateEntry"); 
        }
        else{
            $id = entity::insertMarketLivestock($cropID, $unitPrice, $cropMeasurementID, $marketID);
            mysql_close();
             header("Location:../View/ViewMarketLivestockRecord.php?ViewRecord=$id");
            // echo $id;die();
            //header("Location:../View/ViewFugRecord.php?ViewRecord=$id&action=$action");
            }
        }
    }
    else  if ($tableName == 'agrobusiness') {       
        $errorList = agroBusinessErrorCheck($_POST); 
       // var_dump($errorList);echo count($errorList);die();
        if (count($errorList) > 0) {
            $_SESSION['error'] = $errorList;
            $marketID=$_POST['marketID'];
            header("Location:../View/ManageAgroBusiness.php?action=add");
        } else {           
            entity::DbConnect();
            $companyName = clean($_POST['companyName']);
            $contactName = clean($_POST['contactName']);
            $address = clean($_POST['address']);
            $email = clean($_POST['email']);
            $phoneNumber = clean($_POST['phoneNumber']);
            $state = clean($_POST['state']);
            
            $id = entity::insertAgroBusiness($companyName, $contactName, $address, $email, $phoneNumber, $state );
            mysql_close();
             header("Location:../View/ViewAgroBusinessRecord.php?ViewRecord=$id");
            //header("Location:../View/ViewFugRecord.php?ViewRecord=$id&action=$action");
            
        }
    }
   else  if ($tableName == 'fug') {
        $errorList = FUGErrorCheck($_POST);
        if (count($errorList) > 0) {
            $_SESSION['error'] = $errorList;
            header("Location:../View/ManageFUG.php?action=add");
        } else {
            entity::DbConnect();
            $fca = clean($_POST['fca']);
            $fugName = clean($_POST['fugName']);
            $fugLeaderName = clean($_POST['fugLeaderName']);
            $fugLeaderPhoneNo = clean($_POST['fugLeaderPhoneNo']);

            $id = entity::insertFug($fugName, $fugLeaderName, $fugLeaderPhoneNo, $fca);
            mysql_close();
            header("Location:../View/ViewFugRecord.php?ViewRecord=$id&action=$action");
        }
    }
    else if ($tableName == 'fertilizers') {
        entity::DbConnect();
        $name = clean($_POST['name']);
        $description = clean($_POST['description']);
        $id = entity::insertFertilizer($name, $description);
        mysql_close();
        header("Location:../View/ViewRecord.php?ViewRecord=$id&action=$action");
    }
   else  if ($tableName == 'crops') {
        entity::DbConnect();
        $name = clean(trim($_POST['name']));
        $description = clean(trim($_POST['description']));
        $cycleMonth = clean(trim($_POST['cycleMonth']));
        $id = entity::insertCrop($name, $description, $cycleMonth);
        mysql_close();
        header("Location:../View/ViewRecord.php?ViewRecord=$id&action=$action");
    }
   else  if ($tableName == 'diseases') {
        entity::DbConnect();
        $name = clean($_POST['name']);
        $affectedCrop = clean($_POST['affectedCrop']);
        $treatment = clean($_POST['treatment']);
        $id = entity::insertDisease($name, $affectedCrop, $treatment);
        mysql_close();
        header("Location:../View/ViewRecord.php?ViewRecord=$id&action=$action");
    }

   else if ($tableName == 'pests') {
        entity::DbConnect();
        $name = clean($_POST['name']);
        $description = clean($_POST['description']);
        $control = clean($_POST['control']);
        $id = entity::insertPest($name, $description, $control );
        entity::DbConnect();
        header("Location:../View/ViewRecord.php?ViewRecord=$id&action=$action");
    }
  else  if ($tableName == 'markets') {
        entity::DbConnect();
        $name = clean($_POST['name']);
        $address = clean($_POST['address']);
        $state = clean($_POST['state']);
        $lga = clean($_POST['lga']);
        $marketDay = clean($_POST['marketDay']);
        $ward = clean($_POST['ward']);
        $id = entity::insertMarket($name, $address, $state, $lga, $ward, $marketDay);
        mysql_close();
        header("Location:../View/ViewMarket.php?ViewRecord=$id&action=$action");
    }

  else  if ($tableName == 'farmers') {
        $errorList = FarmerErrorCheck($_POST);
        if (count($errorList) > 0) {
            $_SESSION['error'] = $errorList;
            header("Location:../View/ManageFarmer.php?action=add");
        } else {
            entity::DbConnect();
            $state = clean($_POST['state']);
            $lga = clean($_POST['lga']);
            $fca = clean($_POST['fca']);
            $fug = clean($_POST['fug']);
            $crop1 = clean($_POST['crop1']);
            $crop2 = clean($_POST['crop2']);
            $crop3 = clean($_POST['crop3']);
            $fName = clean($_POST['fName']);
            $lName = clean($_POST['lName']);
            $status = clean($_POST['status']);
            $gender = clean($_POST['gender']);
            $size = clean($_POST['size']);
            $address = clean($_POST['address']);
            $phoneNo = clean($_POST['phoneNo']);
            $language = clean($_POST['language']);
            $fug = clean($_POST['fug']);
            $phoneType = clean($_POST['phoneType']);
            $market = clean($_POST['market']);
            $animal = clean($_POST['animal']);
            
            $recCount= entity::checkFarmersRecord($phoneNo);      
        if ($recCount>0) {
         header("Location:../View/ManageFarmer.php?action=add&respond=duplicateEntry"); 
        }
        else{
            $id = entity::insertFarmer($fName, $lName, $status, $gender, $size, $address, $phoneNo, $language, $phoneType, $market, $fug, $fca, $lga, $state, $crop1, $crop2, $crop3, $animal);
            entity::DbConnect();
            header("Location:../View/ViewFarmerRecord.php?ViewRecord=$id&action=$action");
           }
        }
    }
  else   if ($tableName == 'cropfertilizermappings') {
        entity::DbConnect();
        $crop = clean($_POST['cropID']);
        $fertilizer = clean($_POST['fertilizer']);
        $timing = clean($_POST['timing']);
        $dosage = clean($_POST['dosage']);
        $id = entity::insertCropFertilizer($crop, $fertilizer, $timing, $dosage);
        mysql_close();
        header("Location:../View/ManageCropRelationship.php?recID=$crop&parentTable=crops&childTable=fertilizers");
    }
  else   if ($tableName == 'cropdiseasemappings') {
        entity::DbConnect();
        $crop = clean($_POST['cropID']);
        $disease = clean($_POST['disease']);
        $symptom = clean($_POST['symptom']);
        $control = clean($_POST['control']);
        $id = entity::insertCropDisease($crop, $disease, $symptom, $control);
        mysql_error();
        header("Location:../View/ManageCropRelationship.php?recID=$crop&parentTable=crops&childTable=diseases");
    }
  else  if ($tableName == 'croppestmappings') {
        entity::DbConnect();
        $crop = clean($_POST['cropID']);
        $pest = clean($_POST['pest']);
        $control = clean($_POST['control']);
        $id = entity::insertCropPest($crop, $pest, $control);
        mysql_close();
        header("Location:../View/ManageCropRelationship.php?recID=$crop&parentTable=crops&childTable=pests");
    }
  else   if ($tableName == 'cropvarietys') {
        entity::DbConnect();
        $variety = clean($_POST['variety']);
        $original = clean($_POST['original']);
        $characteristics = clean($_POST['characteristics']);
        $yield = clean($_POST['yield']);
        $cropID = clean($_POST['cropID']);
        entity::insertCropVariety($variety, $original, $characteristics, $yield, $cropID);
        mysql_close();
        header("Location:../View/ManageCropRelationship.php?recID=$cropID&parentTable=crops&childTable=varietys");
    }
   else if ($tableName == 'cropherbicides') {
        entity::DbConnect();
        $herbicideID = clean($_POST['herbicideID']);
        $applicationPeriod = clean($_POST['applicationPeriod']);
        $qty = clean($_POST['qty']);
        $cropID = clean($_POST['cropID']);
        entity::insertCropHerbicide($herbicideID, $applicationPeriod, $qty, $cropID);
        mysql_close();
        header("Location:../View/ManageCropRelationship.php?recID=6&parentTable=crops&childTable=herbicides");
    }
   else if ($tableName == 'pesticides') {
        entity::DbConnect();
        $name = clean($_POST['name']);
        $description = clean($_POST['description']);
        $id = entity::insertPesticide($name, $description);
        mysql_close();
        header("Location:../View/ViewRecord.php?ViewRecord=$id&action=$action");
    }
   else if ($tableName == 'herbicides') {
        entity::DbConnect();
        $name = clean($_POST['name']);
        $description = clean($_POST['description']);
        $timing = clean($_POST['timing']);
        $dosage = clean($_POST['dosage']);
        $id = entity::insertHerbicide($name, $description, $timing, $dosage);
        mysql_close();
        header("Location:../View/ViewRecord.php?ViewRecord=$id&action=$action");
    }
  else  if ($tableName == 'pestpesticidemappings') {
        entity::DbConnect();
        $pestID = clean($_POST['pestID']);
        $pesticideID = clean($_POST['pesticideID']);
        $id = entity::insertPestPesticide($pestID, $pesticideID);
        mysql_close();
        header("Location:../View/AddPestPesticides.php?action=success");
    }

  else  if ($tableName == 'in_season') {
        entity::DbConnect();
        $langID = clean($_POST['langID']);
        $cropVariety = clean($_POST['cropID']);
        $seedRate = clean($_POST['seedRate']);
        $accessChannel = clean($_POST['accessChannel']);
        $seedTreatment = clean($_POST['seedTreatment']);
        $sowingDate = clean($_POST['sowingDate']);
        $spacing = clean($_POST['spacing']);
        $fertilizerApp = clean($_POST['fertilizerApp']);
        $weedControl = clean($_POST['weedControl']);
        $chemicalControl = clean($_POST['chemicalControl']);
        $harvesting = clean($_POST['harvesting']);
        $striga = clean($_POST['striga']);
        $diseases = clean($_POST['diseases']);
        $IPM = clean($_POST['IPM']);
        $storage = clean($_POST['storage']);
        $extraInfo = clean($_POST['extraInfo']);
        $id = entity::insertInSeason($langID, $cropVariety, $accessChannel, $seedRate, $seedTreatment, $sowingDate, $spacing, $fertilizerApp, $weedControl, $chemicalControl, $harvesting, $striga, $diseases, $IPM, $extraInfo, $storage);
        mysql_close();
        header("Location:../View/ViewInSeasonRec.php?ViewRecord=$id&action=$action");
    }
   else if ($tableName == 'fishery') {
        entity::DbConnect();
        $langID = clean($_POST['langID']);
        $accessChannel = clean($_POST['accessChannel']);
        $SiteSelection = clean($_POST['SiteSelection']);
        $FarmManagement = clean($_POST['FarmManagement']);
        $WaterSupplyQuality = clean($_POST['WaterSupplyQuality']);
        $FishFeeds = clean($_POST['FishFeeds']);
        $PondManagement = clean($_POST['PondManagement']);
        $FishStock = clean($_POST['FishStock']);
        $Harvest = clean($_POST['Harvest']);
        $Processing = clean($_POST['Processing']);

        $FishDisease = clean($_POST['FishDisease']);
        $Treatment = clean($_POST['Treatment']);
        $BusinessPlan = clean($_POST['BusinessPlan']);

        $id = entity::insertFishery($langID, $accessChannel, $SiteSelection, $FarmManagement, $WaterSupplyQuality, $FishFeeds, $PondManagement, $FishStock, $Processing, $Harvest, $FishDisease, $Treatment, $BusinessPlan);
        mysql_close();

        header("Location:../View/ViewFisheryRecord.php?ViewFishRecord=$id");
    }
    else if ($tableName == 'snail') {     
        entity::DbConnect();        
        $langID = clean($_POST['langID']);
        $accessChannel = clean($_POST['accessChannel']);
        $SiteSelection = clean($_POST['SiteSelection']);
        $RecommendedSpecies = clean($_POST['RecommendedSpecies']);
        $SnaileryConstruction = clean($_POST['SnaileryConstruction']);
        $FoodFeeding = clean($_POST['FoodFeeding']);
        $PredatorsParasitesDiseases = clean($_POST['PredatorsParasitesDiseases']);
        $BreedingManagement = clean($_POST['BreedingManagement']);
        $HarvestingStorage = clean($_POST['HarvestingStorage']);
        $Market = clean($_POST['Market']);
        $extraInfo = clean($_POST['extraInfo']);
        $recCount= entity::checkSnailRecord($langID,$accessChannel);      
        if ($recCount>0) {
         header("Location:../View/ManageSnail.php?action=$action&respond=duplicateEntry"); 
        }
        else{
        $id = entity::insertSnail($langID, $accessChannel, $SiteSelection, $RecommendedSpecies,$SnaileryConstruction,$FoodFeeding,$PredatorsParasitesDiseases,$BreedingManagement,$HarvestingStorage,$Market,$extraInfo);
        mysql_close();

        header("Location:../View/ViewSnailRec.php?ViewRecord=$id&action=$action");
        }
    }
     else if ($tableName == 'piggery') {     
        entity::DbConnect();        
        $langID = clean($_POST['langID']);
        $accessChannel = clean($_POST['accessChannel']);
        $Site_Selection = clean($_POST['Site_Selection']);
        $HousingEquipment = clean($_POST['HousingEquipment']);
        $BreedsBreeding = clean($_POST['BreedsBreeding']);
        $PigManagement = clean($_POST['PigManagement']);
        $FeedsFeeding = clean($_POST['FeedsFeeding']);
        $HealthManagement = clean($_POST['HealthManagement']);
        $processing = clean($_POST['processing']);
        $Marketing = clean($_POST['Marketing']);
        
        $recCount= entity::checkPiggeryRecord($langID,$accessChannel);      
        if ($recCount>0) {
         header("Location:../View/ManagePiggery.php?action=$action&respond=duplicateEntry"); 
        }
        else{
        $id = entity::insertPiggery($langID, $accessChannel, $Site_Selection, $HousingEquipment,$BreedsBreeding,$PigManagement,$FeedsFeeding,$HealthManagement,$processing,$Marketing);
        mysql_close();

        header("Location:../View/ViewPiggeryRec.php?ViewRecord=$id&action=$action");
        }
    }
    else if ($tableName == 'okra') {     
        entity::DbConnect();        
        $langID = clean($_POST['langID']);
        $accessChannel = clean($_POST['accessChannel']);
       
        $cropRotation = clean($_POST['cropRotation']);
        $plantSpacing = clean($_POST['plantSpacing']);
        $irrigation = clean($_POST['irrigation']);
        $varieties = clean($_POST['varieties']);
        $diseases = clean($_POST['diseases']);
        $insectPest = clean($_POST['insectPest']);
        $Harvest = clean($_POST['Harvest']);
        $storage = clean($_POST['storage']);
        $recCount= entity::checkOkraCount($langID,$accessChannel);      
        if ($recCount>0) {
         header("Location:../View/ManageOkra.php?action=$action&respond=duplicateEntry"); 
        }
        else{
        $id = entity::insertOkra($langID, $accessChannel,  $cropRotation,$plantSpacing,$irrigation,$varieties,$diseases,$insectPest,$Harvest,$storage);
        mysql_close();

        header("Location:../View/ViewOkraRecord.php?ViewRecord=$id&action=$action");
        }
    }
    else if ($tableName == 'carrot') {     
        entity::DbConnect();        
        $langID = clean($_POST['langID']);
        $accessChannel = clean($_POST['accessChannel']);
        $soilPreparation = clean($_POST['soilPreparation']);
        $seedRate = clean($_POST['seedRate']);
        $sowingMethod = clean($_POST['sowingMethod']);
        $fertilizer = clean($_POST['fertilizer']);
        $interculture = clean($_POST['interculture']);
        $plantProtection = clean($_POST['plantProtection']);
        $harvest = clean($_POST['harvest']);
        
        $recCount= entity::checkCarrotCount($langID,$accessChannel);      
        if ($recCount>0) {
         header("Location:../View/ManageCarrot.php?action=$action&respond=duplicateEntry"); 
        }
        else{
        $id = entity::insertCarrot($langID, $accessChannel, $soilPreparation, $seedRate,$sowingMethod,$fertilizer,$interculture,$plantProtection,$harvest);
        mysql_close();

        header("Location:../View/ViewCarrotRecord.php?ViewRecord=$id&action=$action");
        }
    }
     else if ($tableName == 'cabbage') {     
        entity::DbConnect();        
        $langID = clean($_POST['langID']);
        $accessChannel = clean($_POST['accessChannel']);
        $siteSelection = clean($_POST['siteSelection']);
        $climate = clean($_POST['climate']);
        $cultivation = clean($_POST['cultivation']);
        $seedling = clean($_POST['seedling']);
        $spacing = clean($_POST['spacing']);
        $fertilizer = clean($_POST['fertilizer']);
        $weedControl = clean($_POST['weedControl']);
        $disease = clean($_POST['disease']);
        $harvest = clean($_POST['harvest']);
        $yield = clean($_POST['yield']);
        $recCount= entity::checkCabbageCount($langID,$accessChannel);      
        if ($recCount>0) {
         header("Location:../View/ManageCabbage.php?action=$action&respond=duplicateEntry"); 
        }
        else{
        $id = entity::insertCabbage($langID, $accessChannel, $siteSelection, $climate,$cultivation,$seedling,$spacing,$fertilizer,$weedControl,$disease,$harvest,$yield);
        mysql_close();
        header("Location:../View/ViewCabbageRecord.php?ViewRecord=$id&action=$action");
        }
    }
    else if ($tableName == 'watermelon') {     
        entity::DbConnect();        
        $langID = clean($_POST['langID']);
        $accessChannel = clean($_POST['accessChannel']);
        $landPreparation = clean($_POST['landPreparation']);
        $manuring = clean($_POST['manuring']);
        $afterCultivation = clean($_POST['afterCultivation']);
        $diseasePest = clean($_POST['diseasePest']);
        $seedRate = clean($_POST['seedRate']);
        
        $recCount= entity::checkWatermelonCount($langID,$accessChannel);      
        if ($recCount>0) {
         header("Location:../View/ManageWater-Melon.php?action=$action&respond=duplicateEntry"); 
        }
        else{
        $id = entity::insertWatermelon($langID,$accessChannel, $landPreparation, $manuring,$afterCultivation,$diseasePest,$seedRate);
        mysql_close();
        header("Location:../View/ViewWater-MelonRecord.php?ViewRecord=$id&action=$action");
        }
    } else if ($tableName == 'onion') {     
        entity::DbConnect();        
        $langID = clean($_POST['langID']);
        $accessChannel = clean($_POST['accessChannel']);
        $soil = clean($_POST['soil']);
        $variety = clean($_POST['variety']);
        $spacing = clean($_POST['spacing']);
        $nutrientMag = clean($_POST['nutrientMag']);
        $pestMag = clean($_POST['pestMag']);
        $diseaseMag = clean($_POST['diseaseMag']);
        $yield = clean($_POST['yield']);
        $seedRate = clean($_POST['seedRate']);
        
        
        $recCount= entity::checkOnionCount($langID,$accessChannel);      
        if ($recCount>0) {
         header("Location:../View/ManageOnion.php?action=$action&respond=duplicateEntry"); 
        }
        else{
        $id = entity::insertOnion($langID,$accessChannel, $soil, $seedRate,$variety,$spacing,$nutrientMag,$pestMag,$diseaseMag,$yield);
        mysql_close();
        header("Location:../View/ViewOnionRecord.php?ViewRecord=$id&action=$action");
        }
    }
    else if ($tableName == 'poultry') {
       
        entity::DbConnect();
        $langID = clean($_POST['langID']);
        $accessChannel = clean($_POST['accessChannel']);
        $Site_Selection = clean($_POST['Site_Selection']);
        $Housing = clean($_POST['Housing']);
        $Recommended_Breeds = clean($_POST['Recommended_Breeds']);
        $Feeds_Feeding_Equipment = clean($_POST['Feeds_Feeding_Equipment']);
        $Pests_Diseases_Management = clean($_POST['Pests_Diseases_Management']);
        $Record_Management = clean($_POST['Record_Management']);
        $Processing = clean($_POST['Processing']);
        $Waste_Management_Sanitation = clean($_POST['Waste_Management_Sanitation']);
        
        $id = entity::insertPoultry($langID, $accessChannel, $Housing,$Site_Selection, $Recommended_Breeds, $Feeds_Feeding_Equipment, $Pests_Diseases_Management, $Record_Management, $Processing, $Waste_Management_Sanitation);
        mysql_close();

        header("Location:../View/ViewPoultryRec.php?ViewRecord=$id&action=$action");
    }
  else  if ($tableName == 'pre_season') {
        entity::DbConnect();
        $langID = clean($_POST['langID']);
        $cropID = clean($_POST['cropID']);
        $site = clean($_POST['site']);
        $accessChannel = clean($_POST['accessChannel']);
        $land = clean($_POST['land']);
        $ploughing = clean($_POST['ploughing']);
        $harrowing = clean($_POST['harrowing']);
        $ridging = clean($_POST['ridging']);
        $extraInfo = clean(trim($_POST['extraInfo']));
        $extraInfo2 = clean(trim($_POST['extraInfo2']));
        $extraInfo3 = clean(trim($_POST['extraInfo3']));
         $recCount= entity::checkPreSeasonRecord($langID,$accessChannel);      
        if ($recCount>0) {
         header("Location:../View/ManagePreSeason.php?action=$action&respond=duplicateEntry"); 
        }
        else{
        $id = entity::insertPreSeason($langID, $cropID, $accessChannel, $site, $land, $ploughing, $ridging, $harrowing, $extraInfo, $extraInfo2, $extraInfo3);
        mysql_close();
        header("Location:../View/ViewPreSeasonRec.php?ViewRecord=$id&action=$action");
        }
    }
    else if ($tableName == 'post_season') {
        entity::DbConnect();
        $cropID = clean($_POST['cropID']);
        $langID = clean($_POST['langID']);
        $accessChannel = clean($_POST['accessChannel']);
        $processing = clean($_POST['processing']);
        $delivery = clean($_POST['delivery']);
        $storage = clean($_POST['storage']);
        $farmBus = clean($_POST['farmBus']);
        $finance = clean($_POST['finance']);
        $extraInfo = clean($_POST['extraInfo']);
        $rawMaterial = clean($_POST['rawMaterial']);
        $id = entity::insertPostSeason($cropID, $langID, $accessChannel, $processing, $delivery, $storage, $farmBus, $finance, $rawMaterial, $extraInfo);
        mysql_close();
        header("Location:../View/ViewPostSeasonRec.php?ViewRecord=$id&action=$action");
    }
}
else if (isset($_POST['update'])) {
    checkSession();
    $action = 'update';
    $tableName = $_SESSION['menuTableName'];
    
    if ($tableName == 'fca') {
        $errorList = FCAErrorCheck($_POST);
        $id=$_POST['fcaID'];
        if (count($errorList) > 0) {
            $_SESSION['error'] = $errorList;
           
            header("Location:../View/ManageFca.php?action=update&id=$id");
        } else {
            entity::DbConnect();
            $state = clean($_POST['state']);
            $lga = clean($_POST['lga']);
            $fcaName = clean($_POST['fcaName']);
            $fcaLeaderName = clean($_POST['fcaLeaderName']);
            $fcaLeaderPhoneNo = clean($_POST['fcaLeaderPhoneNo']);
            entity::updatefca($id,$fcaName, $fcaLeaderName, $fcaLeaderPhoneNo, $state, $lga);
            mysql_close();
            header("Location:../View/ViewFcaRecord.php?ViewRecord=$id&action=$action");
        }
    }
   else if ($tableName == 'marketcrop') {
        $errorList = MarketPriceErrorCheck($_POST); 
       
        if (count($errorList) > 0) {
            $_SESSION['error'] = $errorList;
            $marketID=$_POST['ID'];
            header("Location:../View/ManageMarketCrop.php?action=update&marketID=$marketID");
        } else {
           
            entity::DbConnect();
           
            $unitPrice = clean($_POST['unitPrice']);
            
           
            $recid=clean($_POST['id']);
                 
        
            $id = entity::updateMarketCrop($recid, $unitPrice);
            mysql_close();
             header("Location:../View/ViewMarketCropRecord.php?ViewRecord=$recid");
            //header("Location:../View/ViewFugRecord.php?ViewRecord=$id&action=$action");
            }
        
    }
    else if ($tableName == 'fug') {
         $id=$_POST['fugID'];
         $errorList = FUGErrorCheck($_POST);
        if (count($errorList) > 0) {
            $_SESSION['error'] = $errorList;
            header("Location:../View/ManageFUG.php?action=update&id=$id");
        } else {
            entity::DbConnect();
            $id= clean($_POST['fugID']);
            $fca = clean($_POST['fca']);
            $fugName = clean($_POST['fugName']);
            $fugLeaderName = clean($_POST['fugLeaderName']);
            $fugLeaderPhoneNo = clean($_POST['fugLeaderPhoneNo']);
             entity::updateFug($id,$fugName, $fugLeaderName, $fugLeaderPhoneNo, $fca);
            mysql_close();
            header("Location:../View/ViewFugRecord.php?ViewRecord=$id&action=$action");
        }
    }
    else if ($tableName == 'fertilizers') {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $id = $_POST['id'];
        echo $id;
        entity::updateFertilizer($name, $description, $id);
        header("Location:../View/ViewRecord.php?ViewRecord=$id&action=$action");
    }
    if ($tableName == 'crops') {
        $name = clean(trim($_POST['name']));
        $description = clean(trim($_POST['description']));
        $cycleMonth = clean(trim($_POST['cycleMonth']));
        $id = $_POST['id'];

        entity::updateCrop($name, $description, $cycleMonth, $id);
        header("Location:../View/ViewRecord.php?ViewRecord=$id&action=$action");
    }
   else if ($tableName == 'diseases') {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $id = $_POST['id'];
        entity::updateDisease($name, $description, $id);
        header("Location:../View/ViewRecord.php?ViewRecord=$id&action=$action");
    }

    else if ($tableName == 'pests') {
        entity::DbConnect();
        $name =  clean($_POST['name']);
        $description = clean($_POST['description']);
          $control =clean($_POST['control']);
        $id = clean($_POST['id']);
        entity::updatePest($name, $description, $control, $id);
        header("Location:../View/ViewRecord.php?ViewRecord=$id&action=$action");
    }
  else  if ($tableName == 'markets') {
        $name = trim($_POST['name']);
        $address = trim($_POST['address']);
        $state = trim($_POST['state']);
        $lga = trim($_POST['lga']);
        $ward = trim($_POST['ward']);
        $marketDay = trim($_POST['marketDay']);
        $id = $_POST['id'];
        entity::updateMarket($name, $address, $state, $lga, $marketDay, $id);
        header("Location:../View/ViewMarket.php?ViewRecord=$id&action=$action");
    }

    else if ($tableName == 'farmers') {
        $errorList = FarmerErrorCheck($_POST);
        if (count($errorList) > 0) {
            $_SESSION['error'] = $errorList;
            $id = $_POST['id'];
            header("Location:../View/ManageFarmer.php?action=update&tableName=Farmer&id=$id");
        } else {
            entity::DbConnect();
            $state = clean($_POST['state']);
            $lga = clean($_POST['lga']);
            $fca = clean($_POST['fca']);
            $fug = clean($_POST['fug']);
            $crop1 = clean($_POST['crop1']);
            $crop2 = clean($_POST['crop2']);
            $crop3 = clean($_POST['crop3']);
            $fName = clean($_POST['fName']);
            $lName = clean($_POST['lName']);
            $status = clean($_POST['status']);
            $gender = clean($_POST['gender']);
            $size = clean($_POST['size']);
            $address = clean($_POST['address']);
            $phoneNo = clean($_POST['phoneNo']);
            $language = clean($_POST['language']);
            $fug = clean($_POST['fug']);
            $phoneType = clean($_POST['phoneType']);
            $market = clean($_POST['market']);
            $animal = clean($_POST['animal']);
            $id = clean($_POST['id']);
            entity::updateFarmer($id, $fName, $lName, $status, $gender, $size, $address, $phoneNo, $language, $phoneType, $market, $fug, $fca, $lga, $state, $crop1, $crop2, $crop3, $animal);
            header("Location:../View/ViewFarmerRecord.php?ViewRecord=$id&action=$action");
        }
    }

    else if ($tableName == 'pesticides') {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $id = $_POST['id'];
        // echo $id."  ".$name."  ".$description;

        entity::updatePesticide($name, $description, $id);
        header("Location:../View/ViewRecord.php?ViewRecord=$id&action=$action");
    }
   else if ($tableName == 'herbicides') {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $id = $_POST['id'];
        // echo $id."  ".$name."  ".$description;
        entity::updateHerbicide($name, $description, $id);
        header("Location:../View/ViewRecord.php?ViewRecord=$id&action=$action");
    }
    else if ($tableName == 'in_season') {
        entity::DbConnect();
        $id = clean($_POST['id']);
        $langID = clean($_POST['langID']);
        $cropVariety = clean($_POST['crop']);
        $seedRate = clean($_POST['seedRate']);
        $accessChannel = clean($_POST['accessChannel']);
        $seedTreatment = clean($_POST['seedTreatment']);
        $sowingDate = clean($_POST['sowingDate']);
        $spacing = clean($_POST['spacing']);
        $fertilizerApp = clean($_POST['fertilizerApp']);
        $weedControl = clean($_POST['weedControl']);
        $chemicalControl = clean($_POST['chemicalControl']);
        $harvesting = clean($_POST['harvesting']);
        $striga = clean($_POST['striga']);
        $diseases = clean($_POST['diseases']);
        $IPM = clean($_POST['IPM']);
        $storage = clean($_POST['storage']);
        $extraInfo = htmlspecialchars(trim($_POST['extraInfo']));
        entity::updateInSeason($id, $langID, $accessChannel, $seedRate, $seedTreatment, $sowingDate, $spacing, $fertilizerApp, $weedControl, $chemicalControl, $harvesting, $striga, $diseases, $IPM, $storage, $extraInfo);

        header("Location:../View/ViewInSeasonRec.php?ViewRecord=$id&action=$action");
    }
    else if ($tableName == 'pre_season') {
        entity::DbConnect();
        $id = clean($_POST['id']);
        $langID = clean($_POST['langID']);

        $site = clean($_POST['site']);
        $accessChannel = clean($_POST['accessChannel']);
        $land = clean($_POST['land']);
        $ploughing = clean($_POST['ploughing']);
        $harrowing = clean($_POST['harrowing']);
        $ridging = clean($_POST['ridging']);
        $extraInfo = clean(trim($_POST['extraInfo']));
        $extraInfo2 = clean(trim($_POST['extraInfo2']));
        $extraInfo3 = clean(trim($_POST['extraInfo3']));
        entity::updatePreSeason($accessChannel, $site, $land, $ploughing, $ridging, $harrowing, $extraInfo, $extraInfo2, $extraInfo3, $id);
        mysql_close();
        header("Location:../View/ViewPreSeasonRec.php?ViewRecord=$id&action=$action");
    }
   else  if ($tableName == 'post_season') {
        entity::DbConnect();
        $id = clean($_POST['id']);

        $langID = clean($_POST['langID']);
        $accessChannel = clean($_POST['accessChannel']);
        $processing = clean($_POST['processing']);
        $delivery = clean($_POST['delivery']);
        $storage = clean($_POST['storage']);
        $farmBus = clean($_POST['farmBus']);
        $finance = clean($_POST['finance']);
        $extraInfo = clean($_POST['extraInfo']);
        $rawMaterial = clean($_POST['rawMaterial']);
        entity::updatePostSeason($id, $langID, $accessChannel, $processing, $delivery, $storage, $farmBus, $finance, $rawMaterial, $extraInfo);
        header("Location:../View/ViewPostSeasonRec.php?ViewRecord=$id&action=$action");
    }
    else if ($tableName == 'piggery') {     
        entity::DbConnect();        
       
        $Site_Selection = clean($_POST['Site_Selection']);
        $HousingEquipment = clean($_POST['HousingEquipment']);
        $BreedsBreeding = clean($_POST['BreedsBreeding']);
        $PigManagement = clean($_POST['PigManagement']);
        $FeedsFeeding = clean($_POST['FeedsFeeding']);
        $HealthManagement = clean($_POST['HealthManagement']);
        $processing = clean($_POST['processing']);
        $Marketing = clean($_POST['Marketing']);
        $recID=clean($_POST['recID']);
       
         entity::updatePiggery($recID, $Site_Selection, $HousingEquipment,$BreedsBreeding,$PigManagement,$FeedsFeeding,$HealthManagement,$processing,$Marketing);
        mysql_close();

        header("Location:../View/ViewPiggeryRec.php?ViewRecord=$recID&action=$action");
        
    }
    
}
else if (isset($_GET['stateId'])) {
    echo "<option value='-1'>Select Lga</option>";
     entity::DbConnect();
    $id = clean($_GET['stateId']);
    $lgaResult = entity::fetchLGA('lga', $id);

    while ($row = mysql_fetch_array($lgaResult)) {
        $id = $row['lgaID'];
        $data = $row['lgaName'];
        echo '<option value="' . $id . '">' . $data . '</option>';
    }
}
else if (isset($_GET['lgaid'])) {
    echo "<option value='-1'>Select Ward</option>";
     entity::DbConnect();
    $id = clean($_GET['lgaid']);
    $lgaResult = entity::fetchWard('wards', $id);
    while ($row = mysql_fetch_array($lgaResult)) {
        $id = $row['wardID'];
        $data = $row['wardName'];
        echo '<option value="' . $id . '">' . $data . '</option>';
    }
}
else if (isset($_GET['farmerlgaid'])) {
    echo "<option value='-1'>Select FCA</option>";
     entity::DbConnect();
    $lgaid = clean($_GET['farmerlgaid']);
    $result = entity::fetchfarmerFCA($lgaid);
    while ($row = mysql_fetch_array($result)) {
        $id = $row['ID'];
        $data = $row['Name'];
        echo '<option value="' . $id . '">' . $data . '</option>';
    }
}
else if (isset($_GET['fcaId'])) {
    echo "<option value='-1' >Select FUG</option>";
     entity::DbConnect();
    $lgaid = clean($_GET['fcaId']);
    $result = entity::fetchfarmerfug($lgaid);
    while ($row = mysql_fetch_array($result)) {
        $id = $row['ID'];
        $data = $row['Name'];
        echo '<option value="' . $id . '">' . $data . '</option>';
    }
}
else if (isset($_GET['fugId'])) {
    echo "<option value='-1' >Select MARKET</option>";
     entity::DbConnect();
    $fugId = clean($_GET['fugId']);
    $result = entity::fetchfarmerMarket($fugId);
    while ($row = mysql_fetch_array($result)) {
        $id = $row['ID'];
        $data = $row['Name'];
        echo '<option value="' . $id . '">' . $data . '</option>';
    }
}
else if (isset($_GET['cropMeasurement'])) {
    echo "<option value='-1' >Select a Measurement type</option>";
     entity::DbConnect();
    $cropMeasurement = clean($_GET['cropMeasurement']);
    $result = entity::fetchCropMeasure($cropMeasurement);
    while ($row = mysql_fetch_array($result)) {
        $id = $row['ID'];
        $data = $row['Measurement'];
        echo '<option value="' . $id . '">' . $data . '</option>';
    }
}
else if (isset($_GET['livestockMeasurement'])) {
    echo "<option value='-1' >Select a Measurement type</option>";
     entity::DbConnect();
    $livestockMeasurement = clean($_GET['livestockMeasurement']);
    $result = entity::fetchLivestockMeasure($livestockMeasurement);
    while ($row = mysql_fetch_array($result)) {
        $id = $row['ID'];
        $data = $row['Measurement'];
        echo '<option value="' . $id . '">' . $data . '</option>';
    }
}
else if (isset($_POST['cropId'])) {
     entity::DbConnect();
    $cropId = clean($_POST['cropId']);
    $varietyResult = entity::fetchCropVariety('cropvarietys', $cropId);

    while ($row = mysql_fetch_array($varietyResult)) {
        $id = $row['ID'];
        $data = $row['Name'];
        echo '<option value="' . $id . '">' . $data . '</option>';
    }
}
else if (isset($_GET['Practise']) && isset($_GET['animalTable'])) {
    entity::DbConnect();
    $Practise = clean($_GET['Practise']);
    $animalTable = clean(strtolower($_GET['animalTable']));
    $langID=clean($_GET['langID']);
    $result = entity::fetchTableMsg($Practise, $animalTable,$langID);
    $rows = mysql_num_rows($result);
    if ($rows > 0) {
        $msg = mysql_result($result, 0, 0);
        $_SESSION['msg'] = $msg;
        $list = splitContent($msg);
        foreach ($list as $value) {
            echo $value;
        }
    } else {
        echo "No Sms Message";
    }
}
else if (isset($_POST['BroadcastCrop'])) {
    entity::DbConnect();
    $errorList = array();
    $searchCriteria = '';
    $searchValue = '';
    $errorList = BroadcastErrorCheck($_POST);
    if (count($errorList) > 0) {
        $_SESSION['error'] = $errorList;
        header("Location:../View/BroadcastCrop.php?action=add");
    } else {

        if (isset($_POST['state']) && $_POST['state'] != -1) {
            $searchValue = clean($_POST['state']);
            $searchCriteria = 'stateID';
            if (isset($_POST['lga']) && $_POST['lga'] != -1) {
                $searchValue = clean($_POST['lga']);
                $searchCriteria = 'lgaID';
                if (isset($_POST['fca']) && $_POST['fca'] != -1) {
                    $searchValue = clean($_POST['fca']);
                    $searchCriteria = 'fcaID';
                    if (isset($_POST['fug']) && $_POST['fug'] != -1) {
                        $searchValue = clean($_POST['fug']);
                        $searchCriteria = 'fugID';
                    }
                }
            }
        }

        $season = clean($_POST['season']);
        $messageTitle = clean($_POST['messageTitle']);
        $cropID = clean($_POST['cropID']);
        $deliveryDate = clean($_POST['deliveryDate']);
        $msgContent = htmlspecialchars_decode($_SESSION['msg']);
        unset($_SESSION['msg']);
        $deliveryDate = clean(str_replace("/", "-", $deliveryDate) . ':00');
        // sanitizeBroadcast($_POST);
        $cropRow = entity::fetchcropName($cropID);
        $cropName = mysql_result($cropRow, 0, 0);
        $description = "Scheduled {$messageTitle} messages for {$season} for {$cropName}";
        $stockName = 'Crop';
        $stockID = $cropID;
        $userId = $_SESSION['UserID'];
                entity::insertBroadcast($searchCriteria, $searchValue, $description, $stockName, $stockID, $messageTitle, $msgContent, $deliveryDate, $userId);
        mysql_close();
        header("Location:../View/ViewBroadcast.php");
    }
}
else if (isset($_POST['BroadcastAnimal'])) {
    entity::DbConnect();
    $errorList = array();
    $searchCriteria = '';
    $searchValue = '';
    $errorList = BroadcastAnimalCheck($_POST);
    if (count($errorList) > 0) {
        $_SESSION['error'] = $errorList;
        header("Location:../View/BroadcastAnimal.php?action=add");
    } else {

        if (isset($_POST['state']) && $_POST['state'] != -1) {
            $searchValue = clean($_POST['state']);
            $searchCriteria = 'stateID';
            if (isset($_POST['lga']) && $_POST['lga'] != -1) {
                $searchValue = clean($_POST['lga']);
                $searchCriteria = 'lgaID';
                if (isset($_POST['fca']) && $_POST['fca'] != -1) {
                    $searchValue = clean($_POST['fca']);
                    $searchCriteria = 'fcaID';
                    if (isset($_POST['fug']) && $_POST['fug'] != -1) {
                        $searchValue = clean($_POST['fug']);
                        $searchCriteria = 'fugID';
                    }
                }
            }
        }
        $messageTitle = clean($_POST['messageTitle']);
        $animal = clean($_POST['animal']);
        $deliveryDate = clean($_POST['deliveryDate']);
        $msgContent = htmlspecialchars_decode($_SESSION['msg']);
        unset($_SESSION['msg']);
        $deliveryDate = clean(str_replace("/", "-", $deliveryDate) . ':00');
        $description = "Scheduled {$messageTitle} messages  for {$animal}";
        $stockName = 'Animal';
        echo $animal;
        $animalRow = entity::fetchAnimalId($animal);
        $stockID = mysql_result($animalRow, 0, 0);
        $userId = $_SESSION['UserID'];
        entity::insertBroadcast($searchCriteria, $searchValue, $description, $stockName, $stockID, $messageTitle, $msgContent, $deliveryDate, $userId);
        mysql_close();
        header("Location:../View/ViewBroadcast.php");
    }
}
else if (isset($_POST['BroadcastVegatable'])) {
    entity::DbConnect();
    $errorList = array();
    $searchCriteria = '';
    $searchValue = '';
    $errorList = BroadcastAnimalCheck($_POST);
    if (count($errorList) > 0) {
        $_SESSION['error'] = $errorList;
        header("Location:../View/BroadcastVegetable.php?action=add");
    } else {

        if (isset($_POST['state']) && $_POST['state'] != -1) {
            $searchValue = clean($_POST['state']);
            $searchCriteria = 'stateID';
            if (isset($_POST['lga']) && $_POST['lga'] != -1) {
                $searchValue = clean($_POST['lga']);
                $searchCriteria = 'lgaID';
                if (isset($_POST['fca']) && $_POST['fca'] != -1) {
                    $searchValue = clean($_POST['fca']);
                    $searchCriteria = 'fcaID';
                    if (isset($_POST['fug']) && $_POST['fug'] != -1) {
                        $searchValue = clean($_POST['fug']);
                        $searchCriteria = 'fugID';
                    }
                }
            }
        }
        $messageTitle = clean($_POST['messageTitle']);
        $animal = clean($_POST['animal']);
        $deliveryDate = clean($_POST['deliveryDate']);
        $msgContent = htmlspecialchars_decode($_SESSION['msg']);
        unset($_SESSION['msg']);
        $deliveryDate = clean(str_replace("/", "-", $deliveryDate) . ':00');
        $description = "Scheduled {$messageTitle} messages  for {$animal}";
               $stockName = 'Crop';       
        $animalRow = entity::fetchAnimalId($animal);
        $stockID = mysql_result($animalRow, 0, 0);
        $userId = $_SESSION['UserID'];
        entity::insertBroadcast($searchCriteria, $searchValue, $description, $stockName, $stockID, $messageTitle, $msgContent, $deliveryDate, $userId);
        mysql_close();
        header("Location:../View/ViewBroadcast.php");
    }
}
else if (isset($_GET['ResetPassword'])) {
    $password=genPassword();
    $userRecordID=$_GET['userRecID'];
    entity::DbConnect();
    entity::updateUser($password, $userRecordID);
    $result=entity::fetchUser($userRecordID);
    $username=mysql_result($result, 0, 'Name');
    $phoneNo=mysql_result($result, 0, 'UserName');
    $msg = "Dear {$username},Your username is {$phoneNo} and password is {$password}.Send your comment,complains,suggestion on FIKS site to support@fiks.com.ng.";
    $header = "Fadama";
        entity::insertMessage($phoneNo, $msg, $header);
        mysql_close();
    header("Location:../View/ViewResetUsersRecord.php?ViewRecord=$userRecordID");
//    echo $userRecordID .'<br>';
//    echo $msg . '<br>';
//    echo $password;
//    die();
}
function populateWardMarket($ward, $startpoint, $limit) {
    entity::DbConnect();
    $ward=clean($ward);
    $startpoint=clean($startpoint);
    $limit=clean($limit);
    $result = entity::getWardMarket($ward, $startpoint, $limit);
    return $result;
}
function populatelgaMarket($lga, $startpoint, $limit) {
    $result = entity::getlgaMarket($lga, $startpoint, $limit);
    return $result;
}
function populateStateMarket($state, $startpoint, $limit) {
    $result = entity::getStateMarket($state, $startpoint, $limit);
    return $result;
}
function populateStateFarmer($stateId, $startpoint, $limit) {
    $result = entity::getStateFarmer($stateId, $startpoint, $limit);
    return $result;
}
function populateLgaFarmer($lgaId, $startpoint, $limit) {
    $result = entity::getlgaFarmer($lgaId, $startpoint, $limit);
    return $result;
}
function populateFcaFarmer($lgaId, $startpoint, $limit) {
    $result = entity::getFcaFarmer($lgaId, $startpoint, $limit);
    return $result;
}
function populateStateAgroBusiness($state, $startpoint, $limit) {
    $result = entity::populateStateAgroBusiness($state, $startpoint, $limit);
    return $result;
}

function populateFUGFarmer($lgaId, $startpoint, $limit) {
    $result = entity::getFugFarmer($lgaId, $startpoint, $limit);
    return $result;
}

?>