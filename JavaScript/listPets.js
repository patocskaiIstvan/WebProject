var hamburger = document.getElementsByClassName("hamburger");
var hamburgerCheckbox = document.getElementById("responsive-nav");

let star = document.querySelectorAll(".star-img");

//a képre kattintva megváltoztatja az elérési útját (src), majd újra rákattintva vissza állítja
for(let k = 0; k<star.length; k++)
{
	star[k].addEventListener("click",function()
	{
		if(star[k].getAttribute('src') == "../images/star2.png")
		{
				star[k].src="../images/star.png";
		}
		else if(star[k].getAttribute('src') == "../images/star.png")
		{
				star[k].src="../images/star2.png";
		}
	})
}




