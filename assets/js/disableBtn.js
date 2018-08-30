
const boxes   = document.querySelectorAll('input[type=checkbox]');

function  enableIfAllChecked(){

    let boxesChecked = [];

    let btn = document.getElementById('prepare_for_delivery_submit');

    for(let i = 0; i < boxes.length; i++){
        boxes[i].addEventListener('change', function(){

            boxes[i].checked ?
                boxesChecked.push(boxes[i].value) :
                boxesChecked = []
            ;

            if(boxesChecked.length === boxes.length && boxesChecked.length !== 0)
            {
                btn.classList.remove('disable');

            } else if(boxesChecked.length === 0 && !btn.classList.contains('disable'))
            {
                btn.classList.add('disable');
            }
        })
    }


}

enableIfAllChecked();