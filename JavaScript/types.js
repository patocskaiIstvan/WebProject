let cbox2 = document.getElementsByClassName("cbox2");
let cbox2Div = document.getElementsByClassName("cbox2-div");
let slider2 = document.getElementsByClassName("slider2");

let i = 0;
//ez a kód részlet is a csúszka designolásához kellett, balra illetve jobbra helyezi a csúszkát a ki/be kapcsolásnál
cbox2Div[0].onclick = function()
{
	if(i == 0)
	{
		cbox2Div[0].style.backgroundColor="#0077c0";
		slider2[0].style.left="20px";
		slider2[0].style.backgroundColor="#99FFFF";
		i++;
		cbox2[0].checked = true;
	}
	else if(i == 1)
	{
		cbox2Div[0].style.backgroundColor="#0077c0";
		slider2[0].style.backgroundColor="#99FFFF";
		slider2[0].style.left="0px";
		i--;
		cbox2[0].checked = false;
	}
}
