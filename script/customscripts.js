/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function getbroadcastMsg( messageTitle ,animal,msgContent,selectedLang,image){
    var msgTitle = document.getElementById(messageTitle);    
    var msgtitleName = msgTitle.value;
    
    var animalTable = document.getElementById(animal);    
    var animalName= animalTable.value;
    
     var lang = document.getElementById(selectedLang);    
    var langID = lang.value;
    
    var msg="Practise="+msgtitleName+"&animalTable="+animalName+"&langID="+langID;
    document.getElementById(image).style.display = 'inline-block'; 
    if (window.XMLHttpRequest)
    {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById(msgContent).innerHTML=xmlhttp.responseText;
            
            document.getElementById(image).style.display = 'none';
        }
    } 
    xmlhttp.open("GET","../Controller/RequestController.php?"+msg,true);
    xmlhttp.send();
}
function getMessage(cropControl, msgTitleControl, seasonControl, boxToPopulateId,selectedLang,image){
    document.getElementById(image).style.display = 'inline-block';
    var crop = document.getElementById(cropControl);    
    var cropId = crop.value;
    
    var msgTitle = document.getElementById(msgTitleControl);    
    var msgTitleName = msgTitle.value;
    
    var season = document.getElementById(seasonControl);    
    var seasonName = season.value;
    
    var lang = document.getElementById(selectedLang);    
    var langID = lang.value;
   
    var msg="broadcastCropID="+cropId+"&msgTitle="+msgTitleName+"&season="+seasonName+"&langID="+langID;
   
    if (window.XMLHttpRequest)
    {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById(image).style.display = 'none';
            document.getElementById(boxToPopulateId).innerHTML=xmlhttp.responseText;
            document.getElementById('msg').innerHTML=  document.getElementById(boxToPopulateId).innerHTML;
            result= xmlhttp.responseText;            
        }
    } 
    xmlhttp.open("GET","../Controller/RequestController.php?"+msg,true);
    xmlhttp.send();
}
function composeEntities( selectBoxId, boxToPopulateId, param,image){
    var selectId = document.getElementById(selectBoxId);    
    var id = selectId.value;
    if (id=='-1') {
        alert('Please Make a  selection ') ;  
        return;
    }
    document.getElementById(image).style.display = 'inline-block';    
    var xmlhttp;
    
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById(boxToPopulateId).innerHTML=xmlhttp.responseText;
            document.getElementById(boxToPopulateId).disabled=false;
            result= xmlhttp.responseText;
            document.getElementById(image).style.display = 'none';
        }
    } 
    xmlhttp.open("GET","../Controller/RequestController.php?"+param+"="+id,true);
    xmlhttp.send();
}