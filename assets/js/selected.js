function selectDefault(){
    let hiddenInput = document.getElementsByClassName('selected-default-value');

    for(let i = 0; i < hiddenInput.length; i++)
    {
        let value = hiddenInput[i].value;

        let form = hiddenInput[i].parentNode.childNodes;

        for(let n = 0; n <form.length; n++)
        {
            if(form[n].tagName === 'SELECT')
            {
               let id = form[n].id;
               document.getElementById(id).value = value;

               submitOnChange(id);


            }
        }
    }
}

function submitOnChange(id){
    let select =  document.getElementById(id);

    select.addEventListener('change', function () {
        select.parentElement.submit();

    })
}

selectDefault();
