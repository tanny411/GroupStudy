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

        $("#pass").val("");
        $("#msg").val("");
        $(".name").val("");
        $(".tags").empty();
        $(".list").empty();
        $(".list").addClass('hide');
    });

    $(document).on("click",".del",function(){
        $(this).parent('.tag-item').remove();
    });

    $(".name").keyup(function(){
                
        val=$(this).val();
        if(val==""){
            $('.list').addClass('hide');
            return;
        }
        $('.list').removeClass('hide');

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'userlist.php?text='+val, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
               $('.list').html(xhr.responseText);
            }
        };
        xhr.send();
    });

    $(document).on("click",".list-item",function(){
        var name=$(this).children("input[type='hidden']").val();
        $('.list').addClass('hide');
        $(".name").val("");
        $('.tags').prepend("<div class=\"tag-item\"><div class=\"value\">"+name+"</div><div class=\"del\"> x&nbsp</div></div>");
    });
});
function redirect(page)
{
	location.href = page;
}