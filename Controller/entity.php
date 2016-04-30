<?php
session_start();
class entity {
    var $sn;
    var $ID;
    var $name;
    public static $mylist = array();
    var $colName;
    var $value;

    public static function DbConnect() {
        $host = "localhost";
        $pass = "F4d4m4!";
        $userName = "fadama";
        $database = "fadama";
        $connection = null;
        $connection = mysql_connect($host, $userName, $pass);
        if (!$connection)
            echo 'Failed to obtain a succesful connection to the localHost';
        mysql_select_db($database, $connection) or die(mysql_error());
    }

    public static function StateUser($startpoint, $limit, $stateId) {
        self::DbConnect();
        $list = array();
        $sql = " select * from users where State={$stateId} ";
        $_SESSION['genricQuery'] = $sql;
        $sql.=" LIMIT {$startpoint} , {$limit} ";
        $result = mysql_query($sql) or die(mysql_error());
        while ($rd = mysql_fetch_array($result)) {
            $obj = new entity();
            $obj->ID = $rd[0];
            $obj->name = $rd[1];

            $list[] = $obj;
            self::$mylist[] = $obj;
        }
        mysql_close();
        return $list;
    }

    public static function fetchList($table, $startpoint, $limit) {
        self::DbConnect();
        $list = array();
        $tableName = strtolower($table);
        $_SESSION['genricQuery'] = "select * from {$tableName}";
        $sql = " select * from {$tableName} LIMIT {$startpoint} , {$limit}";

        $result = mysql_query($sql) or die(mysql_error());
        while ($rd = mysql_fetch_array($result)) {
            $obj = new entity();
            $obj->ID = $rd[0];
            $obj->name = $rd[1];

            $list[] = $obj;
            self::$mylist[] = $obj;
        }
        mysql_close();
        return $list;
    }

    public static function fetchFarmerList($table, $startpoint, $limit) {
        self::DbConnect();
        $tableName = strtolower($table);
        $sql = " select ID,firstName,lastName,MSISDN,address from {$tableName} ";
        $_SESSION['query'] = $sql;
        $sql = $sql . " LIMIT {$startpoint} , {$limit}";
        $result = mysql_query($sql) or die(mysql_error());
        mysql_close();
        return $result;
    }
    public static function fetchAllInseason($startpoint, $limit) {
        self::DbConnect();
       
        $sql = "select i.ID, c.Name, l.Name, i.AccessChannel from in_season i, crops c, languages l where i.CropID=c.ID and i.langID=l.ID and i.AccessChannel='Mobile' ";
        $_SESSION['query'] = $sql;
        $sql = $sql . " LIMIT {$startpoint} , {$limit}";
        $result = mysql_query($sql) or die(mysql_error());
        mysql_close();
        return $result;
    }
    public static function fetchAllPreseason($startpoint, $limit) {
        self::DbConnect();
       
        $sql = "select i.ID, c.Name, l.Name, i.AccessChannel from pre_season i, crops c, languages l where i.CropID=c.ID and i.langID=l.ID and i.AccessChannel='Mobile'";
        $_SESSION['query'] = $sql;
        $sql = $sql . " LIMIT {$startpoint} , {$limit}";
        $result = mysql_query($sql) or die(mysql_error());
        mysql_close();
        return $result;
    }
    public static function fetchCropPreseason($cropName,$startpoint, $limit) {
        self::DbConnect();
       
        $sql = "select i.ID, c.Name, l.Name, i.AccessChannel from pre_season i, crops c, languages l where i.CropID=c.ID and i.langID=l.ID and c.Name='$cropName'";
        $_SESSION['query'] = $sql;
        $sql = $sql . " LIMIT {$startpoint} , {$limit}";
        $result = mysql_query($sql) or die(mysql_error());
        mysql_close();
        return $result;
    }
     public static function fetchAllPostseason($startpoint, $limit) {
        self::DbConnect();
       
        $sql = "select i.ID, c.Name, l.Name, i.AccessChannel from post_season i, crops c, languages l where i.CropID=c.ID and i.langID=l.ID";
        $_SESSION['query'] = $sql;
        $sql = $sql . " LIMIT {$startpoint} , {$limit}";
        $result = mysql_query($sql) or die(mysql_error());
        mysql_close();
        return $result;
    }
     public static function fetchAllStateFarmerList($table, $startpoint, $limit,$stateID) {
        self::DbConnect();
        $tableName = strtolower($table);
        $sql = " select ID,firstName,lastName,MSISDN,address from {$tableName} where stateID='$stateID'";
        $_SESSION['query'] = $sql;
        $sql = $sql . " LIMIT {$startpoint} , {$limit}";
        $result = mysql_query($sql) or die(mysql_error());
        mysql_close();
        return $result;
    }


    public static function fetchFailedMessage($id) {
        self::DbConnect();
        $sql = "SELECT COUNT(statusID)  FROM outMessages WHERE  statusID=13  and broadcastID='$id' ";
        $result = mysql_query($sql) or die(mysql_error());
        mysql_close();
        return $result;
    }

    public static function fetchSentMessage($id) {
        self::DbConnect();
        $sql = "SELECT COUNT(statusID)  FROM outMessages WHERE  statusID=11  and broadcastID='$id' ";
        $result = mysql_query($sql) or die(mysql_error());
        mysql_close();
        return $result;
    }

    public static function fetchPendingMessage($id) {
        self::DbConnect();
        $sql = "SELECT COUNT(statusID)  FROM outMessages WHERE  statusID=7  and broadcastID='$id' ";
        $result = mysql_query($sql) or die(mysql_error());
        mysql_close();
        return $result;
    }

    public static function fetchcropVarietyRec($table, $recID) {
        self::DbConnect();
        $sql = " select CV.cropID, C.Name,CV.Name,CV.originalName,CV.characteristics,CV.yield from " . $table . " CV inner join crops C on CV.cropID=C.ID  and CV.ID='$recID'";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchcropPestRec($table, $recID) {
        self::DbConnect();
        $sql = " select CP.cropID, C.Name,P.Name,CP.controlMeasure from " . $table . " CP inner join crops C on CP.cropID=C.ID inner join pests P on CP.pestID=P.ID and CP.ID='$recID'";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchcropHerbicidesRec($table, $recID) {
        self::DbConnect();
        $sql = " select CH.cropID, C.Name,H.Name,CH.timing,CH.dosage from " . $table . " CH inner join crops C on CH.cropID=C.ID inner join herbicides H on CH.herbicideID=H.ID and CH.ID='$recID'";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchcropFertilizerRec($table, $recID) {
        self::DbConnect();
        $sql = " select CF.cropID, C.Name,F.Name,CF.timing,CF.dosage from " . $table . " CF inner join crops C on CF.cropID=C.ID inner join fertilizers F on CF.fertilizerID=F.ID and CF.ID='$recID'";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchcropDiseaseRec($table, $recID) {
        self::DbConnect();
        $sql = " select CD.cropID, C.Name,D.Name,CD.Symptom,CD.Control from " . $table . " CD inner join crops C on CD.cropID=C.ID inner join diseases D on CD.diseaseID=D.ID and CD.ID='$recID'";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchFcaList($menuTableName, $fcaId, $startpoint, $limit) {
        self::DbConnect();

        $sql = " select ID,firstName,lastName,MSISDN,address from {$menuTableName} where FUGID='$fcaId' LIMIT {$startpoint} , {$limit}";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function limitquery($query, $startpoint, $limit) {
        self::DbConnect();
        $sql = $query . " LIMIT {$startpoint} , {$limit}";
        $result = mysql_query($sql) or die(mysql_error());
        mysql_close();
        return $result;
    }

    public static function limitCropQuery($menuTableName, $query, $startpoint, $limit) {
        self::DbConnect();
        $list = array();
        $tableName = strtolower($menuTableName);
        $sql = $query . " LIMIT {$startpoint} , {$limit}";        
        $result = mysql_query($sql) or die(mysql_error());
        while ($rd = mysql_fetch_array($result)) {
            $obj = new entity();
            $obj->ID = $rd[0];
            $obj->name = $rd[1];
            $list[] = $obj;
            self::$mylist[] = $obj;
        }
        mysql_close();
        return $list;
    }

    public static function fetchAllFcaList($menuTableName, $startpoint, $limit) {
        self::DbConnect();
        $_SESSION['query'] = " select ID,Name,groupLeadName,groupPhoneNo from {$menuTableName}";
        $sql = " select ID,Name,groupLeadName,groupPhoneNo from {$menuTableName}  LIMIT {$startpoint} , {$limit}";
        $result = mysql_query($sql) or die(mysql_error());
        mysql_close();
        return $result;
    }

    public static function fetchFarmerFugList($menuTableName, $fcaId) {
        self::DbConnect();

        $sql = " select count(*) as num from {$menuTableName} where FUGID='$fcaId' ";
        $result = mysql_query($sql) or die(mysql_error());
        mysql_close();
        return $result;
    }

    public static function fetchStateFug($stateId, $startpoint, $limit) {
        self::DbConnect();
        $sql = "select f.ID,f.Name,f.groupLeadName,f.groupPhoneNo from fug  f inner join fca  fca on fca.ID=f.FCAID  and fca.stateID=$stateId ";
        $_SESSION['query'] = $sql;
        $sql = $sql . "  LIMIT {$startpoint} , {$limit}";
        $result = mysql_query($sql) or die(mysql_error("fetchStateFug"));
        mysql_close();
        return $result;
    }

    public static function fetchLgaFug($lgaId, $startpoint, $limit) {
        self::DbConnect();
        $sql = "select f.ID,f.Name,f.groupLeadName,f.groupPhoneNo from fug  f inner join fca  fca on fca.ID=f.FCAID  and fca.LgaID=$lgaId ";
        $_SESSION['query'] = $sql;
        $sql = $sql . "  LIMIT {$startpoint} , {$limit}";
        $result = mysql_query($sql) or die(mysql_error("fetchLgaFug"));
        mysql_close();
        return $result;
    }

    public static function fetchTableMsg($Practise, $animalTable,$langID) {
        self::DbConnect();
        $sql = "select {$Practise} from {$animalTable}  where accessChannel = 'Mobile' and langID='$langID'";

        $result = mysql_query($sql) or die(mysql_error());
        mysql_close();
        return $result;
    }

    public static function fetchFcaFug($fcaId, $startpoint, $limit) {
        self::DbConnect();
        $sql = "select f.ID,f.Name,f.groupLeadName,f.groupPhoneNo from fug  f where f.FCAID =$fcaId ";
        $_SESSION['query'] = $sql;
        $sql = $sql . "  LIMIT {$startpoint} , {$limit}";
        $result = mysql_query($sql) or die(mysql_error("fetchFcaFug"));
        mysql_close();
        return $result;
    }

    public static function fetchAllFug($startpoint, $limit) {
        self::DbConnect();
        $sql = "select f.ID,f.Name,f.groupLeadName,f.groupPhoneNo from fug  f  ";
        $_SESSION['query'] = $sql;
        $sql = $sql . "  LIMIT {$startpoint} , {$limit}";
        $result = mysql_query($sql) or die(mysql_error("fetchAllFug"));
        mysql_close();
        return $result;
    }

    public static function fetchstateFca($menuTableName, $stateId, $startpoint, $limit) {
        self::DbConnect();
        $sql = "select ID,Name,groupLeadName,groupPhoneNo from {$menuTableName} where stateID=$stateId";
        $_SESSION['query'] = $sql;
        $sql = $sql . " LIMIT {$startpoint} , {$limit}";
        $result = mysql_query($sql) or die(mysql_error());
        mysql_close();

        return $result;
    }

    public static function fetchlgaFca($menuTableName, $lgaId, $startpoint, $limit) {
        self::DbConnect();
        $_SESSION['query'] = " select ID,Name,groupLeadName,groupPhoneNo from {$menuTableName} where LgaID=$lgaId";
        $sql = "  select ID,Name,groupLeadName,groupPhoneNo from {$menuTableName} where LgaID=$lgaId  LIMIT {$startpoint} , {$limit}";
        $result = mysql_query($sql) or die(mysql_error());
        mysql_close();
        return $result;
    }

    public static function getlgaMarket($lga, $startpoint, $limit) {
        self::DbConnect();
        $sql = "select ID,  Name,marketAddress from markets where lgaID='$lga'";
        $_SESSION['query'] = $sql;
        $sql = $sql . "  limit {$startpoint}, {$limit}";
        $result = mysql_query($sql) or die(mysql_error());
        mysql_close();
        return $result;
    }

    public static function getStateMarket($state, $startpoint, $limit) {
        self::DbConnect();
        $sql = "select ID,  Name,marketAddress from markets where stateID='$state'";
        $_SESSION['query'] = $sql;
        $sql = $sql . "  limit {$startpoint}, {$limit}";
        $result = mysql_query($sql) or die(mysql_error());
        mysql_close();
        return $result;
    }

    public static function getStateFarmer($stateId, $startpoint, $limit) {
        self::DbConnect();
        $sql = "select f.ID,  f.firstName,f.lastName,f.MSISDN ,f.address from farmers f where f.stateID='$stateId'";
        $_SESSION['query'] = $sql;
        $sql = $sql . "  limit {$startpoint}, {$limit}";
        $result = mysql_query($sql) or die(mysql_error());
        mysql_close();
        return $result;
    }

    public static function getlgaFarmer($lgaId, $startpoint, $limit) {
        self::DbConnect();
        $sql = " select f.ID, f.firstName,f.lastName,f.MSISDN ,f.address from farmers f where  f.lgaID='$lgaId'";
        $_SESSION['query'] = $sql;
        $sql = $sql . " limit {$startpoint}, {$limit}";
        $result = mysql_query($sql) or die(mysql_error());
        mysql_close();
        return $result;
    }

    public static function getFcaFarmer($fcaId, $startpoint, $limit) {
        self::DbConnect();
        $sql = "select  f.ID,f.firstName,f.lastName,f.MSISDN ,f.address from farmers f where f.fcaID='$fcaId'";
        $_SESSION['query'] = $sql;
        $sql = $sql . " limit {$startpoint}, {$limit}";
        $result = mysql_query($sql) or die(mysql_error());
        mysql_close();
        return $result;
    }

    public static function getFugFarmer($fugId, $startpoint, $limit) {
        self::DbConnect();
        $sql = "select  f.ID,f.firstName,f.lastName,f.MSISDN ,f.address from farmers f inner join fug  fug on  f.FUGID=fug.ID   and  fug.ID='$fugId'";
        $_SESSION['query'] = $sql;
        $sql = $sql . "  limit {$startpoint}, {$limit}";
        $result = mysql_query($sql) or die(mysql_error());
        mysql_close();
        return $result;
    }

    public static function fetchAnimal($menuTableName, $startpoint, $limit, $category) {
        self::DbConnect();
        $sql = " select  * from  {$menuTableName} where category='$category'";
        $_SESSION['query'] = $sql;
        $sql = $sql . "  limit {$startpoint}, {$limit}";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }
public static function fetchVegatable($startpoint, $limit) {
        self::DbConnect();
        $sql = " select  * from  vegetable ";
        $_SESSION['query'] = $sql;
        
        $sql = $sql . "  limit {$startpoint}, {$limit}";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchRec($table, $name, $startpoint, $limit) {
        self::DbConnect();
        $list = array();
        $tableName = strtolower($table);
        $_SESSION['genricQuery'] = "select * from " . $tableName . " where Name = '$name'";
        $sql = " select * from " . $tableName . " where Name like '%$name%' LIMIT {$startpoint} , {$limit}";
      
        $result = mysql_query($sql) or die(mysql_error());
        while ($rd = mysql_fetch_array($result)) {
            $obj = new entity();
            $obj->ID = $rd[0];
            $obj->name = $rd[1];

            $list[] = $obj;
            self::$mylist[] = $obj;
        }

        mysql_close();
        return $list;
    }

    public static function fetchTableRecord($tableName, $id) {
        self::DbConnect();
        $list = array();
        $id = mysql_real_escape_string($id);
        $sql = " select * from " . $tableName . " where id ='$id'";
        $result = mysql_query($sql) or die(mysql_error());

        $cols = mysql_num_fields($result);


        for ($i = 0; $i < $cols; $i++) {
            if ($tableName == 'users' && $i == 2) {
                
            } else {
                $obj = new entity();
                $obj->colName = mysql_fieldname($result, $i);
                $obj->value = mysql_result($result, 0, $obj->colName);
                $list[] = $obj;
            }
        }



        mysql_close();
        return $list;
    }

    public static function fetchMenu() {
        self::DbConnect();
        $sql = " select * from menu";
        $result = mysql_query($sql) or die(mysql_error());
        mysql_close();
        return $result;
    }

    public static function deleteRecord($tableName, $id) {
        self::DbConnect();
        $id = mysql_real_escape_string($id);
        $sql = " delete from " . $tableName . " where ID ='$id'";
        mysql_query($sql) or die(mysql_error());
        mysql_close();
    }

    public static function insertFertilizer($name, $description) {

        $tableName = $_SESSION['menuTableName'];
        $sql = " insert into  " . $tableName . " values('','$name','$description')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from " . $tableName . " where Name='$name'and  fertilizerDescription='$description'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }

        return $id;
    }

    public static function insertFca($fcaName, $fcaLeaderName, $fcaLeaderPhoneNo, $state, $lga) {

        $sql = " insert into fca values('','$fcaName','$fcaLeaderName','$fcaLeaderPhoneNo','$state','$lga',now())";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from fca where Name='$fcaName'and  groupLeadName='$fcaLeaderName'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }

        return $id;
    }

    public static function insertUsers($username, $state, $lga, $fca, $fug, $phoneNo, $password, $privilege) {

        $sql = " insert into users values('','$username', '$state','$lga','$fca','$fug', '$phoneNo','$password','$privilege')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from users where Name='$username'and  password='$password'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }

        return $id;
    }

    public static function insertMessage($username, $msg, $header) {

        $sql = " insert into  outMessages(messageID,messageContent,destAddress,sourceAddress,statusID,dateInserted,no_Of_Retry,max_Send,bucketID,dateModified)  values('','$msg','$username','$header','7',now(),'0','0','0',now())";
        mysql_query($sql) or die(mysql_error());
    }

    public static function insertFug($fugName, $fugLeaderName, $fugLeaderPhoneNo, $fca) {
        $sql = " insert into fug values('','$fugName','$fugLeaderName','$fugLeaderPhoneNo','$fca',now())";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from fug where Name='$fugName'and  groupPhoneNo='$fugLeaderPhoneNo'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }
        return $id;
    }
public static function insertMarketCrop($cropID, $unitPrice, $cropMeasurementID, $marketID) {
        $sql = " insert into marketcrop values('','$marketID','$cropID','1','$unitPrice','$cropMeasurementID')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from marketcrop where marketID='$marketID' and cropID='$cropID' and cropMeasurementID='$cropMeasurementID'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }
        return $id;
    }
    public static function insertMarketLivestock($cropID, $unitPrice, $cropMeasurementID, $marketID) {
        $sql = " insert into marketlivestock values('','$marketID','$cropID','1','$unitPrice','$cropMeasurementID')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from marketlivestock where marketID='$marketID' and livestockID='$cropID' and livestockMeasurementID='$cropMeasurementID'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }
        return $id;
    }
    public static function insertAgroBusiness($companyName, $contactName, $address, $email, $phoneNumber, $state ) {
        $sql = " insert into agrobusiness values('','$companyName', '$contactName', '$address', '$email', '$phoneNumber', '$state')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from agrobusiness where companyName='$companyName' and contactName='$contactName' and email='$email'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }
        return $id;
    }
    public static function insertPesticide($name, $description) {

        $tableName = $_SESSION['menuTableName'];
        $name = mysql_real_escape_string($name);
        $description = mysql_real_escape_string($description);
        $sql = " insert into  " . $tableName . " values('','$name','$description')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from  " . $tableName . " where Name='$name'and  pesticideDescription='$description'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }

        return $id;
    }

    public static function insertHerbicide($name, $description, $timing, $dosage) {

        $tableName = $_SESSION['menuTableName'];
        $name = mysql_real_escape_string($name);
        $description = mysql_real_escape_string($description);
        $timing = mysql_real_escape_string($timing);
        $dosage = mysql_real_escape_string($dosage);
        $sql = " insert into  " . $tableName . " values('','$name','$description','$timing','$dosage')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from  " . $tableName . " where Name='$name'and  herbicideDescription='$description'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }

        return $id;
    }

    public static function insertMarket($name, $address, $state, $lga, $ward, $marketDay) {

        $tableName = $_SESSION['menuTableName'];
        $sql = " insert into " . $tableName . " values('','$name','$address','$ward','$lga','$state','$marketDay')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from " . $tableName . " where Name='$name' and  marketAddress='$address' and lgaID='$lga'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }

        return $id;
    }

    public static function insertPest($name, $description, $control ) {

        $tableName = $_SESSION['menuTableName'];
        $name = mysql_real_escape_string($name);
        $description = mysql_real_escape_string($description);
        $sql = " insert into  " . $tableName . " values('','$name','$description',' $control')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from  " . $tableName . " where Name='$name'and  pestDescription='$description'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }

        return $id;
    }

    public static function insertDisease($name, $affectedCrop, $treatment) {

        $tableName = $_SESSION['menuTableName'];

        $sql = " insert into  " . $tableName . " values('','$name','$affectedCrop','$treatment')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from  diseases where Name='$name'and AffectedCrop='$affectedCrop'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }

        return $id;
    }

    public static function insertCropFertilizer($crop, $fertilizer, $timing, $dosage) {

        $tableName = $_SESSION['menuTableName'];
        $crop = mysql_real_escape_string($crop);
        $fertilizer = mysql_real_escape_string($fertilizer);
        $sql = " insert into  " . $tableName . " values('','$crop','$fertilizer','$timing','$dosage')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from " . $tableName . " where cropID='$crop'and  fertilizerID='$fertilizer'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }
        return $id;
    }

    public static function insertCropDisease($crop, $disease, $symptom, $control) {

        $tableName = $_SESSION['menuTableName'];
        $crop = mysql_real_escape_string($crop);
        $disease = mysql_real_escape_string($disease);
        $sql = " insert into  " . $tableName . " values('','$crop','$disease','$symptom','$control')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from " . $tableName . " where cropID='$crop'and  diseaseID='$disease'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }
        return $id;
    }

    public static function insertCropVariety($variety, $original, $characteristics, $yield, $cropID) {

        $tableName = $_SESSION['menuTableName'];
        $variety = mysql_real_escape_string($variety);
        $original = mysql_real_escape_string($original);
        $characteristics = mysql_real_escape_string($characteristics);
        $yield = mysql_real_escape_string($yield);
        $cropID = mysql_real_escape_string($cropID);
        $sql = " insert into  " . $tableName . " values('','$variety','$original','$characteristics','$yield','$cropID')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from " . $tableName . " where cropID='$cropID'and  Name='$variety'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }
        return $id;
    }

    public static function insertCropPest($crop, $pest, $control) {

        $tableName = $_SESSION['menuTableName'];

        $sql = " insert into  " . $tableName . " values('','$crop','$pest','$control')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from " . $tableName . " where cropID='$crop'and  pestID='$pest'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }
        return $id;
    }

    public static function insertCrop($name, $description, $cycleMonth) {

        $tableName = $_SESSION['menuTableName'];
        $sql = " insert into  " . $tableName . " values('','$name','$description','$cycleMonth')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from " . $tableName . " where Name='$name'and  cropDescription='$description'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }
        return $id;
    }

    public static function insertInSeason($langID, $cropVariety, $accessChannel, $seedRate, $seedTreatment, $sowingDate, $spacing, $fertilizerApp, $weedControl, $chemicalControl, $harvesting, $striga, $diseases, $IPM, $extraInfo, $storage) {

        $tableName = $_SESSION['menuTableName'];

        $sql = " insert into  " . $tableName . " values('','$langID','$accessChannel','$cropVariety','$seedRate','$seedTreatment','$sowingDate','$spacing','$fertilizerApp','$weedControl','$chemicalControl','$harvesting','$striga','$diseases','$IPM','$storage','$extraInfo')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from " . $tableName . " where langID='$langID'and  cropID='$cropVariety' and accessChannel='$accessChannel'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }
        return $id;
    }

    public static function updatePostSeason($id, $langID, $accessChannel, $processing, $delivery, $storage, $farmBus, $finance, $rawMaterial, $extraInfo) {
        self::DbConnect();

        $sql = " update post_season set langID='$langID',accessChannel='$accessChannel',processing='$processing',delivery='$delivery', 
   storage='$storage',farmBusinessPlaning='$farmBus',farmerFinancing='$finance',rawMaterial='$rawMaterial',extrainfo='$extraInfo'
   where ID='$id'";
        mysql_query($sql) or die(mysql_error());

        mysql_close();
    }

    public static function updateInSeason($id, $langID, $accessChannel, $seedRate, $seedTreatment, $sowingDate, $spacing, $fertilizerApp, $weedControl, $chemicalControl, $harvesting, $striga, $diseases, $IPM, $storage, $extraInfo) {
        self::DbConnect();
        $sql = " update in_season set AccessChannel='$accessChannel',seedRate='$seedRate',seedTreatment='$seedTreatment', 
   sowingDate='$sowingDate',spacing='$spacing',fertilizerApplication='$fertilizerApp',weedControl='$weedControl',chemicalControl='$weedControl',
   harvesting='$harvesting',Striga='$striga',Diseases='$diseases',IntegratedPestManagement='$IPM',extra_Info='$extraInfo',storage='$storage' where ID='$id'";
        mysql_query($sql) or die(mysql_error());
        mysql_close();
    }

    public static function updatePreSeason($accessChannel, $site, $land, $ploughing, $ridging, $harrowing, $extraInfo, $extraInfo2, $extraInfo3, $id) {
        self::DbConnect();

        $sql = " update pre_season set AccessChannel='$accessChannel',siteSelection='$site',landPreparation='$land', 
   ploughing='$ploughing',Harrowing='$harrowing',ridging='$ridging',extraInfo1='$extraInfo',extraInfo2='$extraInfo2',extraInfo3='$extraInfo3' where ID='$id'";
        mysql_query($sql) or die(mysql_error());

        mysql_close();
    }

    public static function insertPreSeason($langID, $cropID, $accessChannel, $site, $land, $ploughing, $ridging, $harrowing, $extraInfo, $extraInfo2, $extraInfo3) {

        $tableName = $_SESSION['menuTableName'];
        $sql = " insert into  " . $tableName . " values('','$langID','$accessChannel','$cropID','$site','$land','$ploughing','$harrowing','$ridging','$extraInfo','$extraInfo2','$extraInfo3')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from " . $tableName . " where langID='$langID'and  cropID='$cropID' and accessChannel='$accessChannel'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }
        return $id;
    }

    public static function insertFishery($langID, $accessChannel, $SiteSelection, $FarmManagement, $WaterSupplyQuality, $FishFeeds, $PondManagement, $FishStock, $Processing, $Harvest, $FishDisease, $Treatment, $BusinessPlan) {

        $tableName = $_SESSION['menuTableName'];
        $sql = " insert into  " . $tableName . " values('','$langID','$accessChannel','$SiteSelection','$FarmManagement','$WaterSupplyQuality','$FishFeeds','$PondManagement','$FishStock','$Processing','$Harvest','$FishDisease','$Treatment','$BusinessPlan')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from " . $tableName . " where langID='$langID' and accessChannel='$accessChannel'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }
        return $id;
    }
 public static function insertPiggery($langID, $accessChannel, $Site_Selection, $HousingEquipment,$BreedsBreeding,$PigManagement,$FeedsFeeding,$HealthManagement,$processing,$Marketing) {
        $sql = " insert into  piggery  values('','$langID','$accessChannel','$Site_Selection','$HousingEquipment','$BreedsBreeding','$PigManagement','$FeedsFeeding','$HealthManagement','$processing','$Marketing')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from piggery where langID='$langID' and accessChannel='$accessChannel'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }
        return $id;
                }   
    public static function insertOkra($langID, $accessChannel, $cropRotation,$plantSpacing,$irrigation,$varieties,$diseases,$insectPest,$Harvest,$storage) {
        $sql = " insert into  okra  values('','$langID','$accessChannel','$cropRotation','$plantSpacing','$irrigation','$varieties','$diseases','$insectPest','$Harvest','$storage')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from okra where langID='$langID' and accessChannel='$accessChannel'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }
        return $id;
    }
    public static function insertCarrot($langID, $accessChannel, $soilPreparation, $seedRate,$sowingMethod,$fertilizer,$interculture,$plantProtection,$harvest) {
        $sql = " insert into  carrot  values('','$langID','$accessChannel','$soilPreparation','$seedRate','$sowingMethod','$fertilizer','$interculture','$plantProtection','$harvest')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from carrot where langID='$langID' and accessChannel='$accessChannel'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }
        return $id;
    }
    public static function insertSnail($langID, $accessChannel, $SiteSelection, $RecommendedSpecies,$SnaileryConstruction,$FoodFeeding,$PredatorsParasitesDiseases,$BreedingManagement,$HarvestingStorage,$Market,$extraInfo) {
        $sql = " insert into  snail  values('','$langID','$accessChannel','$SiteSelection','$RecommendedSpecies','$SnaileryConstruction','$FoodFeeding','$PredatorsParasitesDiseases','$BreedingManagement','$HarvestingStorage','$Market','$extraInfo')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from snail where langID='$langID' and accessChannel='$accessChannel'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }
        return $id;
    }
      public static function insertPoultry($langID, $accessChannel, $Housing,$Site_Selection, $Recommended_Breeds, $Feeds_Feeding_Equipment, $Pests_Diseases_Management, $Record_Management, $Processing, $Waste_Management_Sanitation) {
        $sql = " insert into  poultry  values('','$langID','$accessChannel','$Housing','$Site_Selection','$Recommended_Breeds','$Feeds_Feeding_Equipment','$Pests_Diseases_Management','$Record_Management','$Processing','$Waste_Management_Sanitation')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from poultry where langID='$langID' and accessChannel='$accessChannel'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }
        return $id;
    }
    public static function insertCabbage($langID, $accessChannel, $siteSelection, $climate,$cultivation,$seedling,$spacing,$fertilizer,$weedControl,$disease,$harvest,$yield) {
        $sql = " insert into  cabbage  values('','$langID','$accessChannel','$siteSelection','$climate','$cultivation','$seedling','$spacing','$fertilizer','$weedControl','$disease','$harvest','$yield')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from cabbage where langID='$langID' and accessChannel='$accessChannel'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }
        return $id;
    }
     public static function insertWatermelon($langID,$accessChannel, $landPreparation, $manuring,$afterCultivation,$diseasePest,$seedRate) {
        $sql = " insert into  watermelon  values('','$langID','$accessChannel', '$landPreparation', '$manuring','$afterCultivation','$diseasePest','$seedRate')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from watermelon where langID='$langID' and accessChannel='$accessChannel'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }
        return $id;
    }
//     public static function insertWatermelon($langID,$accessChannel, $landPreparation, $manuring,$afterCultivation,$diseasePest,$seedRate) {
//        $sql = " insert into  watermelon  values('','$langID','$accessChannel', '$landPreparation', '$manuring','$afterCultivation','$diseasePest','$seedRate')";
//        mysql_query($sql) or die(mysql_error());
//        $sql = "select ID from watermelon where langID='$langID' and accessChannel='$accessChannel'";
//        $result = mysql_query($sql) or die(mysql_error());
//        $rows = mysql_num_rows($result);
//        for ($index = 0; $index < count($rows); $index++) {
//            $id = mysql_result($result, $index, 0);
//        }
//        return $id;
//    }
    public static function insertOnion($langID,$accessChannel, $soil, $seedRate,$variety,$spacing,$nutrientMag,$pestMag,$diseaseMag,$yield) {
        $sql = " insert into  onion  values('','$langID','$accessChannel','$soil', '$seedRate','$variety','$spacing','$nutrientMag','$pestMag','$diseaseMag','$yield')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from onion where langID='$langID' and accessChannel='$accessChannel'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }
        return $id;
    }
    public static function insertPostSeason($cropID, $langID, $accessChannel, $processing, $delivery, $storage, $farmBus, $finance, $rawMaterial, $extraInfo) {

        $tableName = $_SESSION['menuTableName'];
        $sql = " insert into  " . $tableName . " values('','$langID','$accessChannel','$cropID','$processing','$delivery','$storage','$farmBus','$finance','$rawMaterial','$extraInfo')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from " . $tableName . " where langID='$langID'and  cropID='$cropID' and accessChannel='$accessChannel'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }
        return $id;
    }

    public static function insertPestPesticide($pestID, $pesticideID) {
        $tableName = $_SESSION['menuTableName'];
        $sql = " insert into  " . $tableName . " values('','$pestID','$pesticideID')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from " . $tableName . " where pestID='$pestID'and pesticideID='$pesticideID'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }
        return $id;
    }

    public static function insertCropHerbicide($herbicideID, $applicationPeriod, $qty, $cropID) {

        $tableName = $_SESSION['menuTableName'];


        $sql = " insert into  " . $tableName . " values('','$cropID','$herbicideID','$applicationPeriod','$qty')";
        mysql_query($sql) or die(mysql_error());
        $sql = "select ID from " . $tableName . " where cropID='$cropID'and  herbicideID='$description'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }
        return $id;
    }

    public static function insertBroadcast($searchCriteria, $searchValue, $description, $stockName, $stockID, $messageTitle, $msgContent, $deliveryDate, $userId) {

        $sql = " insert into  broadcast values('','$searchCriteria','$searchValue','$description','$stockName','$stockID','$messageTitle','$msgContent',now(),now(),'7','$userId')";
        mysql_query($sql) or die(mysql_error());
        
    }

    public static function insertFarmer($fName, $lName, $status, $gender, $size, $address, $phoneNo, $language, $phoneType, $market, $fug, $fca, $lga, $state, $crop1, $crop2, $crop3, $animal) {

        $tableName = $_SESSION['menuTableName'];
        $sql = " insert into  " . $tableName . " values('','$language','$state','$lga','$fca','$fug','$fName','$lName','$status','$gender','$size','$address','$phoneNo','$phoneType','$market',now())";
        mysql_query($sql);
        $sql = "select ID from  " . $tableName . " where firstName='$fName'and lastName='$lName'and MSISDN='$phoneNo'";
        $result = mysql_query($sql) or die(mysql_error());
        $rows = mysql_num_rows($result);
        for ($index = 0; $index < count($rows); $index++) {
            $id = mysql_result($result, $index, 0);
        }
        if ($crop1 != '-1') {
            $sql = "insert into farmercrops values('','$id','$crop1')";
            $result = mysql_query($sql) or die(mysql_error());
        }
        if ($crop2 != '-1') {
            $sql = "insert into farmercrops values('','$id','$crop2')";
            $result = mysql_query($sql) or die(mysql_error());
        }
        if ($crop3 != '-1') {
            $sql = "insert into farmercrops values('','$id','$crop3')";
            $result = mysql_query($sql) or die(mysql_error());
        }
        if ($animal != '-1') {
            $sql = "insert into farmeranimalhusbandry values('','$id','$animal')";
            $result = mysql_query($sql) or die(mysql_error());
        }
        return $id;
    }

    public static function updateFertilizer($name, $description, $id) {
        self::DbConnect();

        $tableName = $_SESSION['menuTableName'];
        $sql = "update  " . $tableName . "  set Name='$name', fertilizerDescription='$description' where ID='$id'";
        mysql_query($sql) or die(mysql_error());
        mysql_close();
    }

    public static function updateTrader($name, $marketID, $id) {
        self::DbConnect();
        $tableName = $_SESSION['menuTableName'];
        $name = mysql_real_escape_string($name);
        $marketID = mysql_real_escape_string($marketID);
        $id = mysql_real_escape_string($id);

        $sql = "update  " . $tableName . "  set Name='$name', marketID='$marketID' where ID='$id'";
        mysql_query($sql) or die(mysql_error());
        mysql_close();
    }

    public static function updateUser($newPassword, $UserId) {
        $sql = "update users set password='$newPassword' where ID ='$UserId'";
        mysql_query($sql) or die(mysql_error());
    }

    public static function updateMarket($name, $address, $state, $lga, $marketDay, $id) {
        self::DbConnect();
        $tableName = $_SESSION['menuTableName'];

        $sql = "update  " . $tableName . " set Name='$name',marketAddress='$address',lgaID='$lga',stateID='$state',marketDay='$marketDay' where ID='$id'";
        mysql_query($sql) or die(mysql_error());
        mysql_close();
    }

    public static function updatePest($name, $description,$control, $id) {
        self::DbConnect();
        $tableName = $_SESSION['menuTableName'];
        $sql = "update  " . $tableName . "  set Name='$name', pestDescription='$description', pestControl='$control' where ID='$id'";
        mysql_query($sql) or die(mysql_error());
        mysql_close();
    }

    public static function updateFarm($name, $size, $location, $lga, $id) {
        self::DbConnect();
        $tableName = $_SESSION['menuTableName'];
        $name = mysql_real_escape_string($name);
        $size = mysql_real_escape_string($size);
        $location = mysql_real_escape_string($location);
        $lga = mysql_real_escape_string($lga);
        $id = mysql_real_escape_string($id);

        $sql = "update  " . $tableName . "  set Name='$name',farmSize='$size',farmLocation='$location',lgaID=' $lga' where ID='$id'";
        mysql_query($sql) or die(mysql_error());
        mysql_close();
    }

    public static function updateDisease($name, $description, $id) {
        self::DbConnect();
        $tableName = $_SESSION['menuTableName'];
        $name = mysql_real_escape_string($name);
        $description = mysql_real_escape_string($description);
        $id = mysql_real_escape_string($id);
        $sql = "update  " . $tableName . "  set Name='$name', diseaseDescription='$description' where ID='$id'";
        mysql_query($sql) or die(mysql_error());
        mysql_close();
    }

 public static   function updatefca($id,$fcaName, $fcaLeaderName, $fcaLeaderPhoneNo, $state, $lga) {
         self::DbConnect();
         $sql="update fca set Name='$fcaName', groupLeadName='$fcaLeaderName',groupPhoneNo='$fcaLeaderPhoneNo',stateID='$state',LgaID='$lga' where ID='$id'";
         mysql_query($sql) or die(mysql_error());   
        mysql_close();
    }
 public static   function updateFug($id,$fugName, $fugLeaderName, $fugLeaderPhoneNo, $fca) {
         self::DbConnect();
         $sql="update fug set Name='$fugName', groupLeadName='$fugLeaderName',groupPhoneNo='$fugLeaderPhoneNo',FCAID='$fca' where ID='$id'";
         mysql_query($sql) or die(mysql_error());
         mysql_close();
    }
    public static   function updateMarketCrop($recid, $unitPrice) {
         self::DbConnect();
         $sql="update marketcrop  set unitPrice='$unitPrice' where ID='$recid'";
        
         mysql_query($sql) or die(mysql_error());
         mysql_close();
    }
    public static function updateFarmer($id, $fName, $lName, $status, $gender, $size, $address, $phoneNo, $language, $phoneType, $market, $fug, $fca, $lga, $state, $crop1, $crop2, $crop3, $animal) {
        self::DbConnect();

        $sql = "update  farmers   set languageID='$language' , stateID='$state', lgaID= '$lga',fcaID='$fca',fugID='$fug'
   ,lastName='$lName',firstName='$fName', maritalStatus='$status', sex='$gender', MSISDN='$phoneNo' ,phoneType='$phoneType'
       ,address='$address', marketID='$market' where ID='$id'";
        mysql_query($sql) or die(mysql_error());
        $sql = "delete from farmercrops where farmerID='$id'";
        mysql_query($sql) or die(mysql_error());
        if ($crop1 != '-1') {
            $sql = "insert into farmercrops values('','$id','$crop1')";
            $result = mysql_query($sql) or die(mysql_error());
        }
        if ($crop2 != '-1') {
            $sql = "insert into farmercrops values('','$id','$crop2')";
            $result = mysql_query($sql) or die(mysql_error());
        }
        if ($crop3 != '-1') {
            $sql = "insert into farmercrops values('','$id','$crop3')";
            $result = mysql_query($sql) or die(mysql_error());
        }
        $sql = "delete from farmeranimalhusbandry where farmerID='$id'";
        mysql_query($sql) or die(mysql_error());
        if ($animal != '-1') {
            $sql = "insert into farmeranimalhusbandry values('','$id','$animal')";
            $result = mysql_query($sql) or die(mysql_error());
        }

        mysql_close();
    }

    public static function updateCrop($name, $description, $cycleMonth, $id) {
        self::DbConnect();
        $tableName = $_SESSION['menuTableName'];
        $sql = "update  " . $tableName . "  set Name='$name', cropDescription='$description',cropCycleMonths='$cycleMonth' where ID='$id'";
        mysql_query($sql) or die(mysql_error());
        mysql_close();
    }

    public static function updatePesticide($name, $description, $id) {
        self::DbConnect();
        $tableName = $_SESSION['menuTableName'];
        $name = mysql_real_escape_string($name);
        $description = mysql_real_escape_string($description);
        $id = mysql_real_escape_string($id);

        $sql = "update  " . $tableName . "  set Name='$name', pesticideDescription='$description' where ID='$id'";
        mysql_query($sql) or die(mysql_error());
        mysql_close();
    }

    public static function updateHerbicide($name, $description, $id) {
        self::DbConnect();
        $tableName = $_SESSION['menuTableName'];
        $name = mysql_real_escape_string($name);
        $description = mysql_real_escape_string($description);
        $id = mysql_real_escape_string($id);

        $sql = "update  " . $tableName . "  set Name='$name',herbicideDescription='$description' where ID='$id'";
        mysql_query($sql) or die(mysql_error());
        mysql_close();
    }

    public static function fetchSeasonPractise($season, $PackagePractise, $crop, $lang, $accessChannel) {
        self::DbConnect();
        $sql = " select  {$PackagePractise}, c.Name,l.Name,s.ID from  {$season} s inner join crops c  inner join languages l where s.cropID={$crop}  and  s.langID={$lang} and s.accessChannel='$accessChannel'";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchPractise($season, $PackagePractise, $crop, $lang) {
        self::DbConnect();
        $sql = " select  {$PackagePractise}, c.Name from  {$season} s inner join crops c on s.cropID = c.ID and  s.cropID={$crop}  and  s.langID={$lang} and s.accessChannel='Web'";
        //echo  $sql ;
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchLivestockPractise($livestockName, $PackagePractise, $lang) {
        self::DbConnect();
        $sql = " select ID, {$PackagePractise} from  $livestockName where  accessChannel='Web' and langID='$lang' ";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchcropName($id) {

        $sql = " select  Name from  crops where  ID = '$id' ";

        $result = mysql_query($sql) or die(mysql_error('select crop'));
        return $result;
    }

    public static function fetchAnimalId($name) {

        $sql = " select  ID from  animalhusbandry where  Name = '$name' ";

        $result = mysql_query($sql) or die(mysql_error('fetchAnimalId'));
        return $result;
    }

    public static function fetchRecord($tableName, $id) {
        self::DbConnect();
        $sql = " select * from " . $tableName . " where ID ='$id'";
       
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchtotalFarmer($id) {
        self::DbConnect();
        $sql = " select count(f.ID), b.farmerGroupID  from  broadcast b inner join farmers f on f.FUGID= b.farmerGroupID and b.ID ='$id'";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchloadedFarmer($id) {
        self::DbConnect();
        $sql = " select count(o.farmerID)  from broadcast b inner join  outMessages o on o.farmerID= b.ID and b.farmerGroupID='$id'";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchLGA($tableName, $id) {
        self::DbConnect();
        $sql = " select * from " . $tableName . " where stateID='$id'";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchLGARecord($tableName, $id) {
        self::DbConnect();
        $sql = " select * from " . $tableName . " where lgaID='$id'";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchbroadcast($tableName,$startpoint, $limit) {
        self::DbConnect();
        $sql = " select * from " . $tableName . " order by dateInserted desc";
         $_SESSION['genricQuery'] = $sql;
        $sql = $sql . "  limit {$startpoint}, {$limit}";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchWardRecord($tableName, $id) {
        self::DbConnect();
        $sql = " select * from " . $tableName . " where wardID='$id'";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchState($tableName, $id) {
        self::DbConnect();
        $sql = " select * from " . $tableName . " where stateID='$id'";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchWard($tableName, $id) {
        self::DbConnect();
        $sql = " select * from " . $tableName . " where lgaID='$id'";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function getStateName($state) {
        self::DbConnect();
        $sql = " select stateName from states where stateID='$state'";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchSeasonRecord($tableName, $name) {
        self::DbConnect();
        $sql = " select * from " . $tableName . " where Name ='$name'";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchinSeasonRecord($tableName, $ID) {
        self::DbConnect();
        $sql = " select * from " . $tableName . " where cropVarietyID ='$ID'";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchOtherSeasonRecord($tableName, $ID) {
        self::DbConnect();
        $sql = " select * from " . $tableName . " where cropID ='$ID'";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchCropVariety($tableName, $ID) {
        self::DbConnect();
        $sql = " select * from " . $tableName . " where cropID ='$ID'";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchMapping($tableName, $id, $fieldName) {

        self::DbConnect();
        $fieldName = substr_replace($fieldName, "", -1);
        $sql = " select * from " . $tableName . " where " . $fieldName . "ID ='$id'";

        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchEntity($tableName, $startpoint, $limit) {
        self::DbConnect();
        $sql = " select * from {$tableName} limit {$startpoint},{$limit} ";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchEntityList($tableName) {
        self::DbConnect();
        $sql = " select * from {$tableName}  ";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchMessage($msgTitle, $season, $cropID,$langID) {
        self::DbConnect();
        $sql = "select {$msgTitle} from {$season} where cropID='$cropID' and accessChannel='Mobile' and langID='$langID'";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchfarmerFCA($lgaId) {
        self::DbConnect();
        $sql = " select * from fca where LgaID='$lgaId' ";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchfarmerFUG($Id) {
        self::DbConnect();
        $sql = " select * from fug where FCAID='$Id' ";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }
     public static function fetchfarmerMarket($Id) {
        self::DbConnect();
        $sql = " SELECT m.`ID` , m.`Name` FROM `markets` m, fug fg, fca fa, 
        lga l WHERE m.`lgaID` = l.lgaID AND l.lgaID = fa.lgaID AND fa.ID = fg.fcaID AND fg.ID ='$Id' ";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }
    public static function fetchCropMeasure($Id) {
        self::DbConnect();
        $sql = " SELECT * from cropmeasurement where cropID='$Id'";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }
     public static function fetchLivestockMeasure($Id) {
        self::DbConnect();
        $sql = " SELECT * from livestockmeasurement where animalHusbandryID='$Id'";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }
    public static function fetchUser($recID) {
        self::DbConnect();
        $sql = " select u.ID, u.Name,u.State,u.Lga,u.Fca,u.Fug, p.UserType,u.UserName from  users u inner join privilege p ON u.Privilege=p.ID and u.ID='$recID'";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function login($username, $password) {
        self::DbConnect();
        $sql = " select u.ID, u.Name,u.State,u.Lga,u.Fca,u.Fug, p.UserType,p.Roles, u.UserName  from  users u inner join privilege p ON u.Privilege=p.ID and u.UserName='$username' and u.password='$password'";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function fetchRowCount($table) {
        self::DbConnect();
        $sql = "SELECT COUNT(*) as `num` FROM {$table}";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function daysOfWeek() {
        $daysList = array();
        $daysList[] = 'Monday';
        $daysList[] = 'Tuesday';
        $daysList[] = 'Wednesday';
        $daysList[] = 'Thursday';
        $daysList[] = 'Friday';
        $daysList[] = 'Saturday';
        $daysList[] = 'Sunday';
        return $daysList;
    }

    public static function StateUserList() {
        $userType = array();
        $userType[] = 'FARMER';
        
        return $userType;
    }

    public static function FadamaUserList() {
        $userType = array();
        $userType[] = 'FADAMA';
        $userType[] = 'STATE';
        $userType[] = 'FARMER';
        
        return $userType;
    }

    public static function getTableMapping($value, $parentTable) {
        $tableName = $value;
        if ($value == 'diseases') {
            $tableName = 'cropdiseasemappings';
        }
        if ($value == 'fertilizers') {
            $tableName = 'cropfertilizermappings';
        }
        if ($value == 'pests') {
            $tableName = 'croppestmappings';
        }
        if ($value == 'herbicides') {
            $tableName = 'cropherbicides';
        }
        if ($value == 'varietys') {
            $tableName = 'cropvarietys';
        }
        if ($value == 'pesticides') {
            $tableName = 'pestpesticidemappings';
        }


        return $tableName;
    }

    public static function previousTable($value) {
        $tableName = $value;
        if ($value == 'cropdiseasemappings') {
            $tableName = 'crops';
        }
        if ($value == 'cropfertilizermappings') {
            $tableName = 'crops';
        }
        if ($value == 'croppestmappings') {
            $tableName = 'crops';
        }
        if ($value == 'cropherbicides') {
            $tableName = 'crops';
        }
        if ($value == 'cropvarietys') {
            $tableName = 'crops';
        }
        if ($value == 'pestpesticidemappings') {
            $tableName = 'pests';
        }
        if ($value == 'tradercropsolds') {
            $tableName = 'traders';
        }
        if ($value == 'marketcrops') {
            $tableName = 'markets';
        }
        return $tableName;
    }

    public static function FetchCrop($ID) {
        self::DbConnect();
        $sql = " select cropID  from farmercrops where farmerID='$ID' ";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function FetchfarmerAnimal($ID) {
        self::DbConnect();
        $sql = " select ah.name  from farmeranimalhusbandry fah inner join  animalhusbandry ah on fah.animalhusbandryID =ah.ID and  fah.farmerID='$ID' ";
        $result = mysql_query($sql) or die(mysql_error());
        return $result;
        mysql_close();
    }

    public static function decode($TargetFarmer) {

        if ($TargetFarmer == 'stateID') {
            $TargetFarmer = 'State';
        }
        if ($TargetFarmer == 'lgaID') {
            $TargetFarmer = 'LGA';
        }
        if ($TargetFarmer == 'fcaID') {
            $TargetFarmer = 'FCA';
        }
        if ($TargetFarmer == 'fugID') {
            $TargetFarmer = 'FUG';
        }
        return $TargetFarmer;
    }
 public static function animalHusCategory($TargetFarmer) {
     if ($TargetFarmer == 'Fishery') {
            $TargetFarmer = 'Aquaculture';
        }
        if ($TargetFarmer == 'Snail') {
            $TargetFarmer = 'Livestock';
        }
        if ($TargetFarmer == 'Piggery') {
            $TargetFarmer = 'Livestock';
        }
        if ($TargetFarmer == 'Poultry') {
            $TargetFarmer = 'Livestock';
        }
        return $TargetFarmer;
 }
    public static function fechtargetName($TargetFarmer, $TargetName) {
        $targetName = $TargetName;
        if ($TargetFarmer == 'State') {
            $stateRow = entity::fetchState('states', $TargetName);
            $targetName = mysql_result($stateRow, 0, 2);
        }
        if ($TargetFarmer == 'LGA') {
            $lgaRow = entity::fetchLGARecord('lga', $TargetName);
            $targetName = mysql_result($lgaRow, 0, 2);
        }
        if ($TargetFarmer == 'FCA') {
            $fcaRow = entity::fetchRecord('fca', $TargetName);
            $targetName = mysql_result($fcaRow, 0, 1);
        }
        if ($TargetFarmer == 'FUG') {
            $fugRow = entity::fetchRecord('fug', $TargetName);
            $targetName = mysql_result($fugRow, 0, 1);
        }
        return $targetName;
    }

    public static function fetchPassword($UserId) {
        $password = "";
        $sql = " select password from users where ID='$UserId'";
        $result = mysql_query($sql) or die(mysql_error());
        $row = mysql_num_rows($result);
        if ($row > 0) {
            $password = mysql_result($result, 0, 0);
        }
        return $password;
    }

    public static function checkSnailRecord($langID,$accessChannel) {
        self::DbConnect();
        $sql = "select count(*) from snail where langID='$langID' and accessChannel='$accessChannel'";
        $result = mysql_query($sql) or die(mysql_error());
        $num=mysql_result($result,0,0) ;
        return $num;
        mysql_close();   
        }
         public static function checkPreSeasonRecord($langID,$accessChannel) {
        self::DbConnect();
        $sql = "select count(*) from pre_season where langID='$langID' and accessChannel='$accessChannel'";
        $result = mysql_query($sql) or die(mysql_error());
        $num=mysql_result($result,0,0) ;
        return $num;
        mysql_close();   
        }
        public static function checkUsersRecord($phoneNo) {
        self::DbConnect();
        $sql = "select count(UserName) from users where UserName='$phoneNo'";
        $result = mysql_query($sql) or die(mysql_error());
        $num=mysql_result($result,0,0) ;
        return $num;
        mysql_close();   
        }
        public static function checkFarmersRecord($phoneNo) {
        self::DbConnect();
        $sql = "select count(MSISDN) from farmers where MSISDN='$phoneNo'";
        $result = mysql_query($sql) or die(mysql_error());
        $num=mysql_result($result,0,0) ;
        return $num;
        mysql_close();   
        }
     public static function checkPiggeryRecord($langID,$accessChannel) {
        self::DbConnect();
        $sql = "select count(*) from piggery where langID='$langID' and accessChannel='$accessChannel'";
        $result = mysql_query($sql) or die(mysql_error());
        $num=mysql_result($result,0,0) ;
        return $num;
        mysql_close();   
        }
      public static function checkOkraCount($langID,$accessChannel) {
        self::DbConnect();
        $sql = "select count(*) from okra where langID='$langID' and accessChannel='$accessChannel'";
        $result = mysql_query($sql) or die(mysql_error());
        $num=mysql_result($result,0,0) ;
        return $num;
        mysql_close();   
        }
         public static function checkCarrotCount($langID,$accessChannel) {
        self::DbConnect();
        $sql = "select count(*) from carrot where langID='$langID' and accessChannel='$accessChannel'";
        $result = mysql_query($sql) or die(mysql_error());
        $num=mysql_result($result,0,0) ;
        return $num;
        mysql_close();   
        }
          public static function checkCabbageCount($langID,$accessChannel) {
        self::DbConnect();
        $sql = "select count(*) from cabbages where langID='$langID' and accessChannel='$accessChannel'";
        $result = mysql_query($sql) or die(mysql_error());
        $num=mysql_result($result,0,0) ;
        return $num;
        mysql_close();   
        }
          public static function checkWatermelonCount($langID,$accessChannel) {
        self::DbConnect();
        $sql = "select count(*) from watermelon where langID='$langID' and accessChannel='$accessChannel'";
        $result = mysql_query($sql) or die(mysql_error());
        $num=mysql_result($result,0,0) ;
        return $num;
        mysql_close();   
        }
        public static function checkMarketCrop($marketID,$cropID,$cropMeasurementID) {
        self::DbConnect();
        $sql = "select count(*) from marketcrop where marketID='$marketID' and cropID='$cropID' and cropMeasurementID='$cropMeasurementID'";
        $result = mysql_query($sql) or die(mysql_error());
        $num=mysql_result($result,0,0) ;
        return $num;
        mysql_close();   
        }
        public static function checkMarketLivestock($marketID,$cropID,$cropMeasurementID) {
        self::DbConnect();
        $sql = "select count(*) from marketlivestock where marketID='$marketID' and livestockID='$cropID' and livestockMeasurementID='$cropMeasurementID'";
        $result = mysql_query($sql) or die(mysql_error());
        $num=mysql_result($result,0,0) ;
        return $num;
        mysql_close();   
        }
        public static function checkOnionCount($langID,$accessChannel) {
        self::DbConnect();
        $sql = "select count(*) from onion where langID='$langID' and accessChannel='$accessChannel'";
        $result = mysql_query($sql) or die(mysql_error());
        $num=mysql_result($result,0,0) ;
        return $num;
        mysql_close();   
        }
    public static function updatePiggery($recID, $Site_Selection, $HousingEquipment, $BreedsBreeding, $PigManagement, $FeedsFeeding, $HealthManagement, $processing, $Marketing) {
        self::DbConnect();
        $sql = "update piggery set SiteSelection='$Site_Selection',HousingEquipment='$HousingEquipment', BreedsBreeding='$BreedsBreeding',PigManagement='$PigManagement',FeedsFeeding='$FeedsFeeding',HealthManagement='$HealthManagement',Processing='$processing',
   Marketing='$Marketing' where ID='$recID'";
        mysql_query($sql) or die(mysql_error());
        mysql_close();   
    }

    public static function populateMarket($startpoint, $limit) {
        self::DbConnect();
        $sql = "select ID,  Name,marketAddress from markets ";
        $_SESSION['query'] = $sql;
        $sql = $sql . "  limit {$startpoint}, {$limit}";
        $result = mysql_query($sql) or die(mysql_error());
        mysql_close();
        return $result;
    }  
    public static function populateAgroBusiness($startpoint, $limit) {
        self::DbConnect();
        $sql = "select  *  from agrobusiness ";
        $_SESSION['query'] = $sql;        
        $sql = $sql . "  limit {$startpoint}, {$limit}";
        $result = mysql_query($sql) or die(mysql_error());
        mysql_close();         
        return $result;
    } 
    public static function populateStateAgroBusiness($state, $startpoint, $limit) {
        self::DbConnect();
        $sql = "select  *  from agrobusiness where state='$state'";
        $_SESSION['query'] = $sql;        
        $sql = $sql . "  limit {$startpoint}, {$limit}";
        $result = mysql_query($sql) or die(mysql_error());
        mysql_close();         
        return $result;
    } 
    public static function populateAgroBusinessRec($id) {
        self::DbConnect();
        $sql = "select  *  from agrobusiness where ID ='$id' ";
        $result = mysql_query($sql) or die(mysql_error());
        mysql_close();         
        return $result;
    } 
    public static function populateMarketCrop($marketID,$startpoint, $limit) {
        self::DbConnect();
        $sql = "select mc.ID,c.Name,mc.qty,mc.unitPrice,cm.Measurement from markets m,crops c,marketcrop mc,cropmeasurement cm
        where m.ID=mc.marketID and c.ID=mc.cropID and cm.ID=mc.cropMeasurementID and m.ID= '$marketID'";
        $_SESSION['query'] = $sql;
        $sql = $sql . "  limit {$startpoint}, {$limit}";
        $result = mysql_query($sql) or die(mysql_error());
         mysql_close();
        return $result;
    }
    public static function populateMarketLivestock($marketID,$startpoint, $limit) {
        self::DbConnect();
        $sql = "SELECT mc.ID, c.Name, mc.qty, mc.unitPrice, cm.Measurement, m.Name, m.ID FROM markets m, animalhusbandry c, marketlivestock mc, livestockmeasurement cm
         WHERE m.ID = mc.marketID AND c.ID = mc.livestockID AND cm.ID = mc.livestockMeasurementID AND m.ID= '$marketID'";
        $_SESSION['query'] = $sql;
        $sql = $sql . "  limit {$startpoint}, {$limit}";
        $result = mysql_query($sql) or die(mysql_error());
         mysql_close();
        return $result;
    }
public static function fetchMarketCropRec($marketID) {
        self::DbConnect();
        $sql = "select mc.ID,c.Name,mc.qty,mc.unitPrice,cm.Measurement,m.Name,m.ID from markets m,crops c,marketcrop mc,cropmeasurement cm
        where m.ID=mc.marketID and c.ID=mc.cropID and cm.ID=mc.cropMeasurementID and mc.ID= '$marketID'";
       
        $result = mysql_query($sql) or die(mysql_error());
         mysql_close();
        return $result;
    }
public static function fetchMarketLivestockRec($ID) {
        self::DbConnect();
        $sql = "select mc.ID,c.Name,mc.qty,mc.unitPrice,cm.Measurement,m.Name,m.ID from markets m,animalhusbandry c,marketlivestock mc,
            livestockmeasurement cm   where m.ID=mc.marketID and c.ID=mc.livestockID and cm.ID=mc.livestockMeasurementID and mc.ID='$ID'";
       
        $result = mysql_query($sql) or die(mysql_error());
         mysql_close();
        return $result;
    }    
}
?>


