let ac = document.querySelectorAll(".activeOrNot");
console.log(ac[0]);

for(let i = 0; i<ac.length; i++)
{
	if(ac[i].innerHTML == "Örökbefogadott")
	{
		ac[i].style.color="#f00";
	}
	else if(ac[i].innerHTML == "Elérhető")
	{
		ac[i].style.color="#0f0";
	}
}

//ez a függvény legkérdezi, hogy az activeOrNot elemnek az innerHTML értékét, és az alapján eldönti, hogy a színe milyen legyen.
