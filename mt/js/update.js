function _update(id)
{ 
  $("#res").fadeOut();
  var id=id;
  var code=$("#service_id").val();
  var smstxt=$("#smstxt").val();
  var sdate=$("#sdate").val();

  if(!code.trim() || !smstxt.trim() || !sdate.trim())
   {
    alert('please enter all data');
   }
   else
   {  
      $.post("pages/update/update.php", 
       {
		id:id,   
        code:code,
        smstxt:smstxt,
        sdate:sdate
       },
       function(data, status){ //alert(data);
	    if(data== 1)
		{
			$("#res").fadeIn();
			$("#smstxt").val('');
			setTimeout(function(){window.location='sms.php'; }, 1500);			
        }
	   }
      );
   }
}