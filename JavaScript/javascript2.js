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

for(let k = 0; k<star.length; k++)
{
	star[k].addEventListener("click",function()
	{
		if(star[k].getAttribute('src') == "images/star2.png")
		{
				star[k].src="images/star.png";
		}
		else if(star[k].getAttribute('src') == "images/star.png")
		{
				star[k].src="images/star2.png";
		}
	})
}

//f=mp4 vcodec=nvenc_h264 acodec=aac  vb=%quality+'k' ab=%audiobitrate+'k' level=4.2 threads=4 progressive=1 r=60



