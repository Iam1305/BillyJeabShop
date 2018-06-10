var myImge=document.getElementById("myPhoto");
var imageArray=["bannerupdate.jpg"];
var imageIndex=0;
function changeImage(){
	myPhoto.setAttribute("src", imageArray[imageIndex]);
	imageIndex++;
	if (imageIndex >= imageArray.length){
		imageIndex=0;
	}
}

var intervalHandle = setInterval(changeImage,10);
myPhoto.onclick=function(){
	clearInterval(intervalHandle);
}