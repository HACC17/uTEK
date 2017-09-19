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

function back_to_main () {
    window.location.href = "index.html";
}

function send_report () {
    window.location.href = "dcca_mapit_outage_report.html";
}

function check_speed () {
    window.location.href = "dcca_mapit_speed_test.html";
}

function view_map () {
    window.location.href = "dcca_mapit_map_view.html";
}

function login () {
    window.location.href = "dcca_mapit_dashboard.html";
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
            //alert(obj);
			//document.getElementById('id_numRecords').innerHTML=obj.bookings.length + ' Records Total';
            var outputtable = '<tr><td>Test Result ID:</td><td>'+obj.rid+'</td></tr>';
            outputtable += '<tr><td>connection type</td><td>'+obj.connection_type+'</td></tr>';
            outputtable += '<tr><td>Service Provider:</td><td>'+obj.ISP+'</td></tr>';
            outputtable += '</tr><td>IP Address:</td><td>'+obj.ipAddress+'</td><tr>';
            outputtable += '</tr><td>Download Speed:</td><td>'+obj.download_speed+'</td><tr>';
            outputtable += '</tr><td>Upload Speed:</td><td>'+obj.upload_speed+'</td><tr>';
            document.getElementById("output_table").innerHTML = outputtable;

		};
	};

	var url = "return_result_api.php?rid=451"
	ajaxRequest.open("GET", url, true);
	ajaxRequest.send(null);
    
    $("#speed_test_button").hide();
    $("#output_table").show();
    $("#speed_bars").show();
    $(".zippers").animate({width:"+=58%"},5000);

};

