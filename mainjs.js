function redirect(page)
{
	location.href = page;
}
	
function load(div,file,func)
{
	if(window.XMLHttpRequest){
		xmlhttp= new XMLHttpRequest();
	}
	else {
		xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
	}
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById(div).innerHTML=xmlhttp.responseText;
		}
	};
			
	func(xmlhttp,file);
		
	/*
	xhttp.open("POST", "ajax_test.asp", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("fname=Henry&lname=Ford");			
	*/
}
		
function loadfile(xmlhttp,file)
{
	xmlhttp.open('GET',file,true);
	xmlhttp.send();
}
function getloadfile(xmlhttp,file)
{
	xmlhttp.open('GET',file+"?search_text="+document.search.search_text.value,true);
	xmlhttp.send();
}
function postloadfile(xmlhttp,file)
{
	parameters='text='+document.getElementById('insert_text').value;
	xmlhttp.open('POST',file,true);
	xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xmlhttp.send(parameters);
}
		