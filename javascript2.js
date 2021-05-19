var hamburger = document.getElementsByClassName("hamburger");
var hamburgerCheckbox = document.getElementById("responsive-nav");



hamburgerCheckbox.onclick = function()
{
	if(hamburgerCheckbox.checked == true)
	{
		hamburger.src="images/hamburgerClose.png";
	}
	else if(hamburgerCheckbox.checked == false)
	{
		hamburger.src="images/hamburger1.png";
	}
}





let star = document.querySelectorAll(".star-img");

let i = 0;
star[0].onclick = function()
{
	if(i == 0)
	{
		star[0].src = "images/star.png";
		i++;
	}
	else if(i == 1)
	{
		star[0].src = "images/star2.png";
		i--;
	}
	
}

