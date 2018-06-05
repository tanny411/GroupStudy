function oldgroup()
{
	document.querySelector(".b").style.display="block";
	document.querySelector(".old").style.display="block";
	document.querySelector(".new").style.display="none";
}
function newgroup()
{
	document.querySelector(".b").style.display="block";
	document.querySelector(".old").style.display="none";
	document.querySelector(".new").style.display="block";
}
function redirect(page)
{
	location.href = page;
}
function searchgrp(xmlhttp,file)
{
	xmlhttp.open('GET',file+"?text="+document.getElementById('searchgrp').value,true);
	xmlhttp.send();
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
}