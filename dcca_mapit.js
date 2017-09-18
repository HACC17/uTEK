$(document).ready(function () {
    $("#island_selector").change(function () {
        $("#map_image").replaceWith("<img id=\"map_image\" src=\"" + $("#island_selector").val() + "\">");
    });
})

function change_setting(number) {
    if ($("#setting_" + number + "").css("border-style") == "none outset") {
        $("#setting_" + number + "").css("border-style", "none inset");
    }
    else if ($("#setting_" + number + "").css("border-style") == "none inset") {
        $("#setting_" + number + "").css("border-style", "none outset");
    }
}
/*
function check_speed () {
    alert("checking");
 //   window.location.href = "http://www.startpage.com";
}
*/
function get_results() {

    var xhttp;
    if (window.XMLHttpRequest) {
    // code for modern browsers
    xhttp = new XMLHttpRequest();
    } else {
    // code for IE6, IE5
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var jsonReturn = xhttp.responseText;
        var obj = JSON.parse(jsonReturn);
        var bookingsTable='<table border=1 cellspacing=0 cellpadding=5><tr><th>Connection Type</th><th>Service Provider</th><th>IP Address</th><th>result ID</th></tr></th><th>Download Speed</th></tr></th><th>Upload Speed</th></tr>';
        bookingsTable+='<tr><td>'+obj.connection_type+'</td><td>'+obj.ISP+'</td><td>'+obj.ipAddress+'</td><td>'+obj.rid+'</td></tr>'+'</td><td>'+obj.download_speed+'</td><td></td><td>'+obj.upload_speed+'</td><td>';
        bookingsTable += '</table>';
        document.getElementById("table1").innerHTML = bookingsTable;
    }
  };
  var id = 451;
  var url = "http://www.tonghoutse.com/hacc/return_result_api.php?rid=451"
  var para = "?rid="+id;
  xhttp.open("GET", url, true);
  xhttp.send();
    
    $("#speed_test_button").hide();
    $("#output_table").show();
    $("#speed_bars").show();
    $(".zippers").animate({width:"+=58%"},5000);
} 
function getResults(){

	var ajaxRequest;

	// Code for AXAX request on different browsers
	try{ajaxRequest = new XMLHttpRequest();}
	catch (e)
	{
		try{ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");}

		catch (e)
		{
			try{ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");}

			catch (e){alert("Your browser does not support ajax."); return false;}
		}
	};

	// Wait for readyState == 4

	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){

			var jsonReturn=ajaxRequest.responseText;

			var obj = JSON.parse(jsonReturn);
            alert(obj);
			//document.getElementById('id_numRecords').innerHTML=obj.bookings.length + ' Records Total';

			var bookingsTable='<table border=1 cellspacing=0 cellpadding=5><tr><th>Connection Type</th><th>Service Provider</th><th>IP Address</th><th>result ID</th></tr></th><th>Download Speed</th></tr></th><th>Upload Speed</th></tr>';
            bookingsTable+='<tr><td>'+obj.connection_type+'</td><td>'+obj.ISP+'</td><td>'+obj.ipAddress+'</td><td>'+obj.rid+'</td></tr>'+'</td><td>'+obj.download_speed+'</td><td></td><td>'+obj.upload_speed+'</td><td>';
			bookingsTable += '</table>';

			document.getElementById('table_1').innerHTML=bookingsTable;

		};
	};

	var url = "return_result_api.php?rid=451"
	ajaxRequest.open("GET", url, true);
	ajaxRequest.send(null);


};
