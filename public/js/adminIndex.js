
	$(function(){
		$('#login').click(function(){
			/*$('form').attr('action', 'index.php/admin/index/login');
			console.log('222');
			$('form').submit();*/
		});

		$('#register').click(function(){
			alert(222);
		});

	});

function refreshImage(url)
{
	$.ajax({
		type : "POST",
		url :  url,
		dataType : 'string',
		success : function(src){
			console.log(src);
			$(this).attr('src', src);
		},
		error : function(){

		}
	});
}
