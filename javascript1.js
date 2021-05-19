var nextArrow = document.querySelector(".next");
var prevArrow = document.querySelector(".prev");
var pictures = document.querySelectorAll(".my-slides");
var sliderDiv = document.querySelector(".slider-div");
var img = document.querySelectorAll(".pic");

let position = 0;
pictures[position].style.display = "block";

for (let i = 0; i < pictures.length; i++) 
{
	sliderDiv.innerHTML += `<img class="pic2" src="">`;
	var pic2 = document.querySelectorAll(".pic2");
	pic2[i].src = img[i].src;
	console.log(img[i]);
}
var sliderDivLine = document.querySelectorAll(".pic2");
sliderDivLine[position].classList.add("pic2-opacity-1");

function hideIMG()
{
	pictures[position].style.display = "block";
	sliderDivLine[position].classList.add("pic2-opacity-1");
	sliderDivLine[position].classList.remove("pic2-opacity-50");
	for (let i = 0; i < pictures.length; i++) 
	{
		if (i !== position) 
		{
			pictures[i].style.display = "none";
			sliderDivLine[position].classList.remove("pic2-opacity-50");
			sliderDivLine[i].classList.add("pic2-opacity-50");
		}
	}
}

function control() 
{
	if (position >= 0 && position < pictures.length) 
	{
		hideIMG();
	} 	
	else if (position === pictures.length) 
	{
		position = 0;
		hideIMG();
	}
	else 
	{
		position = pictures.length - 1;
		hideIMG();
	}
}

for (let i = 0; i < sliderDivLine.length; i++) 
{
	sliderDivLine[i].onclick = function()
	{
		position = i;
		control();
	}
}

nextArrow.onclick= function()
{
	position++;
	control();
}

prevArrow.onclick = function()
{
	position--;
	control();
}

function slideIMG ()
{
	setInterval (function()
	{
		position++; 
		control();
	}, 
	2000);
}	

slideIMG();
