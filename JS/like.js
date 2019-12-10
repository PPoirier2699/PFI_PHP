$(document).ready(function(){
    let likes = $("button[id^='IMG']");
    for(let i = 0; i < likes.length; ++i){
        likes[i].onclick = function(){
            let action;
            if(likes[i].classList.contains('btn-primary')){
                action = 'remove';
            }
            else{
                action = 'add';
            }
            likes[i].classList.toggle("btn-primary");
            likes[i].classList.toggle("btn-outline-secondary");   
            let imgID = likes[i].id.substring(3);
            $(`#${imgID}`).load('DOMAINLOGIC/imageLike.dom.php' ,{
                imgID: imgID,
                action: action
            });
        }
    }
});
