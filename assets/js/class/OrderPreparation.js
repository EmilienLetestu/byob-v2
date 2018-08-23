class orderPreparation {

    detectCheck(){

        let boxes =  document.getElementsByClassName('manually-prepared');

        for(let i = 0; i < boxes.length; i++)
        {
            boxes[i].onchange = function () {

                let cell = boxes[i].parentNode;
                let row = cell.parentElement;
                let val = boxes[i].value.split("_");
                let rowClass = val[0];

                boxes[i].checked === true ?

                    row.classList.add('checked'):
                    row.classList.remove(rowClass)
                ;

                if(boxes[i].checked){

                    row.classList.add('checked');
                    row.classList.remove(rowClass);

                }else{

                    row.classList.remove('checked');
                    row.classList.add(rowClass);
                }

                let rows =document.getElementsByClassName(rowClass);

                for(let n = 0; n < rows.length; n++){

                    if(boxes[i].checked){

                        rows[n].style.display = "none";

                    } else {

                        rows[n].style.display = "table-row";
                    }
                }

            }
        }
    }


    createUrl(){

        let trigger = document.getElementById('trigger-manual-preparation');
        let boxes =  document.getElementsByClassName('manually-prepared');
        let data       = [];
        let currentUrl = window.location.href;
        let hostName   = window.location.hostname;

        trigger.onclick = function () {

            for(let i = 0; i < boxes.length; i++){


                if(boxes[i].checked){

                    let choice = boxes[i].value + '&';
                    data.push(choice.trim());

                }

                let param = data.join("").trim();

                let orderId = currentUrl.slice(-1);

                let host = hostName === 'localhost' ?
                    'localhost:8000' : hostName
                ;

                trigger.href = 'http://' + host + "/preparation-manuelle-commande/" + orderId + "/" + param.substring(0, param.length-1);

            }

            confirm('valider votre préparation de commande ?');
        }
    }

}

export {orderPreparation}