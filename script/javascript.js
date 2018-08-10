var vis=0;
function dropdown()
{
	if(vis==0)
	{
		document.getElementById('submenu').style.display="block";
		vis=1;
	}
	else if(vis==1)
	{
		document.getElementById('submenu').style.display="none";
		vis=0;
	}
}

function readURL(input) 
{
	if (input.files && input.files[0]) 
	{
		var reader = new FileReader();

		reader.onload = function (e) 
		{
			$('#img_prev').css('background-image', "url('"+e.target.result+"')");
		};
		reader.readAsDataURL(input.files[0]);
	}	
}

