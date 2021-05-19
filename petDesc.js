let cbox1 = document.getElementsByClassName("cbox1");
let cbox1Div = document.getElementsByClassName("cbox1-div");
let slider1 = document.getElementsByClassName("slider1");
let cboxStatus = document.getElementsByClassName("cbox-status");


let i = 0;
cbox1Div[0].onclick = function()
{
	if(i == 0)
	{
		cboxStatus[0].innerHTML="Aktív";
		cbox1Div[0].style.backgroundColor="#0077c0";
		slider1[0].style.left="20px";
		slider1[0].style.backgroundColor="#99FFFF";
		i++;
		cbox1[0].checked = true;
	}
	else if(i == 1)
	{
		cboxStatus[0].innerHTML="Inaktív";
		cbox1Div[0].style.backgroundColor="#0077c0";
		slider1[0].style.backgroundColor="#99FFFF";
		slider1[0].style.left="00px";
		i--;
		cbox1[0].checked = false;
	}
	
}




