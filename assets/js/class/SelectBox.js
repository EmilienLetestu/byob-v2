class SelectBox {

    constructor()
    {
       this.hiddenInput =  document.getElementsByClassName('selected-default-value');
    }

     selectDefaultAndSubmitOnChange(){


         for(let i = 0; i < this.hiddenInput.length; i++)
         {
             let value = this.hiddenInput[i].value;

             let form = this.hiddenInput[i].parentNode.childNodes;

             for(let n = 0; n <form.length; n++)
             {
                 if(form[n].tagName === 'SELECT')
                 {
                     let id = form[n].id;
                     document.getElementById(id).value = value;

                    this.submitOnChange(id);
                 }
             }
         }
     }

     submitOnChange(id){

         let select =  document.getElementById(id);

         select.onchange = function () {
             select.parentElement.submit();

         };
     }
}

export {SelectBox}