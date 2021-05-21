$(document).ready(function () {
    $('.datepicker').datepicker();
})

function dataTableAddOn() {
    let languages = {
        'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
      };
    
      $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
      $.extend(true, $.fn.dataTable.defaults, {
        columnDefs: [],
        order: [],
        scrollX: true,
        pageLength: 20,
        dom: 'lBfrtip<"actions">',
        buttons: []
      });
    
      $.fn.dataTable.ext.classes.sPageButton = '';
}

function printVal(val) {
    val = (typeof(val) == "undefined" || typeof(val) == null) ? "" : val;
    if(val != '') {
        val = val.replace(/[^a-zA-Z0-9- ]/g, "");
    }
    return val;
}

function printDate(val) {
    val = printVal(val);
    if(val == '') {
        return val;
    }
    var a = new Date(val * 1000);
    var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
    var year = a.getFullYear();
    var month = months[a.getMonth()];
    var date = a.getDate();
    var hour = a.getHours();
    var min = a.getMinutes();
    var sec = a.getSeconds();
    var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;
    return time;
}

function setCookie(c_name,value,exdays){ 
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + (((exdays==null) || (exdays<=0)) ? "" : "; expires="+exdate.toUTCString());
	//c_value=c_value+";domain="+location.host+";path=/";
	c_value=c_value+";path=/";
	document.cookie=c_name + "=" + c_value;
}

function getCookie(c_name){
	var i,x,y,ARRcookies=document.cookie.split(";");
	for (i=0;i<ARRcookies.length;i++){
		x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
		y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
		x=x.replace(/^\s+|\s+$/g,"");
		if (x==c_name){
			return unescape(y);
		}
	}
}

function showHideLogin(showLogin) {
    if(showLogin == false) {
        $('.forgotbody').hide();
        $('.loginbody').show();
        $(".signinheader").html("Sign In");
    } else {
        $('.forgotbody').show();
        $('.loginbody').hide();
        $(".signinheader").html("Forgot Password");
    }
}

var codevalue='';
function focusNext(step){
    if(step==1){
        codevalue='';
    } 
    
    if(step==6){
        codevalue+=$("#cardcodestep"+step).val();
        if(codevalue.length==6){
            fireBaseObj.redemeCode(codevalue);    
        }                    
    }else{
        if($("#cardcodestep"+step).val()!=''){
            nextStep=step+1;
            codevalue+=$("#cardcodestep"+step).val();
            $("#cardcodestep"+nextStep).focus();
        }
    }
}

function timeConverter(UNIX_timestamp){
    var a = new Date(UNIX_timestamp * 1000);
    var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
    var year = a.getFullYear();
    var month = months[a.getMonth()];
    var date = a.getDate();
    var hour = a.getHours();
    var min = a.getMinutes();
    var sec = a.getSeconds();
    var time = month+ ' '+date+', ' + year;
    return time;
}

function dateConverter(UNIX_timestamp){
    //return new Date(UNIX_timestamp).toLocaleDateString("en-US")
    var a = new Date(UNIX_timestamp * 1000);
    var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
    var year = a.getFullYear();
    var month = months[a.getMonth()];
    var date = a.getDate();
    var hour = a.getHours();
    var min = a.getMinutes();
    var sec = a.getSeconds();
    var time = a.getMonth()+1+ '/'+date+'/' + year;
    return time;
}