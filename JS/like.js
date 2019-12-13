

function checkLike(id, type) {
    let element = $('button[id='+ id +']');
    let action;
    if(element.hasClass('btn-primary')){
        action = 'remove';
    }else{
        action = 'add';
    }
    element.toggleClass("btn-primary");
    element.toggleClass("btn-outline-secondary");   

    let temporaire = id.substring(3);
    $(`#${temporaire}`).load('DOMAINLOGIC/like.dom.php' ,{
        objectID : temporaire,
        objectType : type,
        action: action
    });
}
