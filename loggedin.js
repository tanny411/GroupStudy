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
$(document).ready(function(){
	invite();

	$('.invites').on("click",function(e){
		e.stopPropagation();
		$('.notifs').toggleClass('notif-collapse');
	});

	$('body').on("click",function(){
		$('.notifs').addClass('notif-collapse');
	});

	$('#wa').on("click",function(e){
		e.stopPropagation();
		delInvite($(this));
	});

	$('#ac').on("click",function(e){
		e.stopPropagation();
		addToGrp($(this));
		delInvite($(this));
	});

});
function delInvite(obj){
	var id=obj.parent('li').children('#inviteid').text();
	obj.parent('li').slideUp(300, function() {
		obj.remove();
		var num=$('.notif-num').text();
		num--;
		$('.notif-num').text(num);
		if(num==0) {
			$('.notif-num').fadeTo(100,0);
			$('.nai').show();
		}
	});
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'deleteinvite.php', true);
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			$('.notifs').prepend(xhr.responseText);
			}
	};
	xhr.send("id="+id);
}
function addToGrp(obj){
	var id=obj.parent('li').children('#grpid').text();
	var xhr = new XMLHttpRequest();
	xhr.open('GET', 'add_to_grp.php?grp='+id, true);
	xhr.send();
}
function invite(){
	var num=$('.notif-num').text();
    if(num==0) $('.notif-num').fadeTo(1,0);
    else $('.nai').hide();
}
