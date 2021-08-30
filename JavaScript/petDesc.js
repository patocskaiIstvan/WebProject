let cbox1 = document.getElementsByClassName("cbox1");
let cbox1Div = document.getElementsByClassName("cbox1-div");
let slider1 = document.getElementsByClassName("slider1");
let cboxStatus = document.getElementsByClassName("cbox-status");
let changeActivateState = document.querySelector(".changeActivateState");


//kattintásra beállítja az alábbi CSS értékeket, (Itt lett designolva a csúszka)
cbox1Div[0].onclick = function()
{
	
	if(changeActivateState.value == "0")
	{
		cboxStatus[0].innerHTML="Aktív";
		cbox1Div[0].style.backgroundColor="#0077c0";
		slider1[0].style.left="20px";
		slider1[0].style.backgroundColor="#99FFFF";
		cbox1[0].checked = true;
		changeActivateState.value="1";
	}
	else if(changeActivateState.value == "1")
	{
		cboxStatus[0].innerHTML="Inaktív";
		cbox1Div[0].style.backgroundColor="#0077c0";
		slider1[0].style.backgroundColor="#99FFFF";
		slider1[0].style.left="0px";
		cbox1[0].checked = false;
		changeActivateState.value="0";
	}
	
}


//Ez ugyanaz mint a felső kód kattintás listener nélkül, azért kellett, hogy az oldal betöltödésekor automatikusan lefusson.
if(changeActivateState.value== 0)
{
	console.log("érték 0 ");
	cboxStatus[0].innerHTML="Inaktív";
	cbox1Div[0].style.backgroundColor="#0077c0";
	slider1[0].style.backgroundColor="#99FFFF";
	slider1[0].style.left="0px";
	cbox1[0].checked = false;
}

if(changeActivateState.value == 1)
{
	console.log("érték 1 ");
	cboxStatus[0].innerHTML="Aktív";
	cbox1Div[0].style.backgroundColor="#0077c0";
	slider1[0].style.left="20px";
	slider1[0].style.backgroundColor="#99FFFF";
	cbox1[0].checked = true;
}