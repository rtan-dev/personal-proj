/**
 * Created with JetBrains PhpStorm.
 * User: Ralph
 * Date: 11/2/13
 * Time: 2:14 PM
 * To change this template use File | Settings | File Templates.
 */
// List image names without extension
var myImg= new Array(3)
myImg[0]= "avatar1";
myImg[1]= "avatar2";
myImg[2]= "avatar3";
myImg[3]= "avatar4";

// Tell browser where to find the image
myImgSrc = "/bootstrap/img/avatar/";

// Tell browser the type of file
myImgEnd = ".jpg"

var i = 0;

// Create function to load image
function loadImg(){
    document.imgSrc.src = myImgSrc + myImg[i] + myImgEnd;
}

// Create link function to switch image backward
function prev(id){
    var l = (i < 1) ? i : i -= 1;
    document.imgSrc.src = myImgSrc + myImg[l] + myImgEnd;
    document.getElementById(id).value = l + 1;
}

// Create link function to switch image forward
function next(id){
    var l = (i > 2) ? i : i += 1;
    document.imgSrc.src = myImgSrc + myImg[l] + myImgEnd;
    document.getElementById(id).value = l + 1;
}

// Load function after page loads
window.onload=loadImg;