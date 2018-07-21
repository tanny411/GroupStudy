$(document).ready(function(){

    $("#send").on("click",function(){
        pass=$("#pass").val();
        if(pass=="") return;
        tag="";
        $(".tag-item").each(function(){
            tag+=$(this).children(".value").text()+"#";
        });
        if(tag=="") return;
        msg=$("#msg").val();
        
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'send_invite.php', true);
        xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
               $('.error').html(xhr.responseText);
            }
        };
        xhr.send("pass="+pass+"&msg="+msg+"&tag="+tag);
    });

});
function redirect(page)
{
	location.href = page;
}