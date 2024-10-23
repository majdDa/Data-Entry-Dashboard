<?php 
include '../../_inc/functions1.php';
$date=date('Y-m-d h:s:i');
 
 
 for($i=0;$i<sizeof($_REQUEST["id_array"]);$i++)
  {
	    //echo $_REQUEST["id_array"][$i];
		//echo $_REQUEST["editing_date_array"][$i];
		 
		 
		  $arrVal=array($_REQUEST["sending_date_array"][$i]);
		  $arrCol=array("sending_date");
		  update("cp_monitoring",$arrCol,$arrVal,"id='".$_REQUEST['id_array'][$i]."'");
	 
		
	 
     
		
  } 
    echo '1';
  $GLOBALS['conn']->close();

?>