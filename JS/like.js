$(document).ready(function(){
    let likes = $("button[id^='IMG']");
    for(let i = 0; i < likes.length; ++i){
        likes[i].onclick = function(){
            likes[i].classList.toggle("btn-primary");
            likes[i].classList.toggle("btn-outline-secondary");
            location = 'DOMAINLOGIC/imageLike.dom.php';
        }
    }
});
