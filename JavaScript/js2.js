let ac = document.querySelectorAll('.activeOrNot2');
let pet = document.querySelectorAll('.pet');
let starimg = document.querySelectorAll('.star-img');
let petCap = document.querySelectorAll('.pet-advertisement-caption');
let img1 = document.querySelectorAll('.img1');
console.log(ac[0]);

for(let i = 0; i<ac.length; i++)
{
	if(ac[i].innerHTML == 'Örökbefogadott')
	{
		ac[i].style.color='#f05';
		pet[i].style.backgroundColor='#54626F';
		starimg[i].style.display='none';
		petCap[i].style.marginTop='30px';
		petCap[i].style.boxShadow='0 0 10px #54626F';
		img1[i].style.filter='grayscale(100%)';
	}
	else if(ac[i].innerHTML == 'Elérhető')
	{
		ac[i].style.color='#cf0';
	}
}
