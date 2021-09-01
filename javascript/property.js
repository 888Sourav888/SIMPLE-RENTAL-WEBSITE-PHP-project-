previous = document.getElementById('previous') ; 
next = document.getElementById('next') ; 
slider = document.getElementById('slider') ; 

var index = 0 ; 

function slideleft(){
    index-=1 ; 
    const img =document.querySelectorAll('.image img') ; 
    for(var i = 0 ; i<img.length ; i++){
        img[i].style.display = 'none' ; 
    }
    if(index<0) index = img.length  - 1  ; 
    img[index].style.display = 'block' ; 
}

function slideright(){
    index+=1 ; 
    const img =document.querySelectorAll('.image img') ; 
    for(var i = 0 ; i<img.length ; i++){
        img[i].style.display = 'none' ; 
    }
    if(index>=img.length) index = 0 ; 
    img[index].style.display = 'block' ; 
}

function con(){
    return confirm('Are you sure  ,you want to request ?') ; 
}