var nextArrow = document.querySelector(".next");
var prevArrow = document.querySelector(".prev");
var pictures = document.querySelectorAll(".my-slides");
var sliderDiv = document.querySelector(".slider-div");
var img = document.querySelectorAll(".pic");

//kép pozicíója
let position = 0;
pictures[position].style.display = "block";

//át megy a pictures hosszán, és hozzáad mindegyikhez egy HTMl elemet, majd megváltoztatja a src értéküket
for (let i = 0; i < pictures.length; i++) 
{
	sliderDiv.innerHTML += `<img class="pic2" src="">`;
	var pic2 = document.querySelectorAll(".pic2");
	pic2[i].src = img[i].src;
	console.log(img[i]);
}
//új változó pic2, majd kap egy új CSS osztályt pic2-opacity-1
var sliderDivLine = document.querySelectorAll(".pic2");
sliderDivLine[position].classList.add("pic2-opacity-1");


//az összes többi kép display értékét none-ra állítja amelyik nem a position.
//új CSS osztályt ad hozzá, távolít el.
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

//ez a függvény kezeli, hogy melyik elemet kapcsolja ki (mikor legyen meghíva a hideIMG() függvény)
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

//ez a függvény a képek helyzetét kezeli, hogy látszódjon, hogy épp hol tart a slider
for (let i = 0; i < sliderDivLine.length; i++) 
{
	sliderDivLine[i].onclick = function()
	{
		position = i;
		control();
	}
}

//nextArrow-ra kattintva arráb megy egy képet
nextArrow.onclick= function()
{
	position++;
	control();
}

//prevArrow-ra kattintva visszább megy egy képet
prevArrow.onclick = function()
{
	position--;
	control();
}

//ez a függvény kezeli, hogy hány másodperc után változtatja a képet autómatikusan
function slideIMG ()
{
	setInterval (function()
	{
		position++; 
		control();
	}, 
	2000);
}	

//ez pedig meghívja az egész függvényt
slideIMG();
