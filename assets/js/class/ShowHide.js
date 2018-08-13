class ShowHide {

    constructor(
        trigger,
        event
    )
    {
        this.trigger = trigger;
        this.event   = event;
        this.id      = this.trigger.replace(/trigger-/g,'');
    }

    visibilityOnClick() {

        let elem   = document.getElementById(this.id);

        document.getElementById(this.trigger).onclick = function(){

            elem.style.display === 'none' ?
                elem.style.display = 'flex' : elem.style.display = 'none'
            ;
        };

    }

    visibilityOnMouse(){

        let elem   = document.getElementById(this.id);

        document.getElementById(this.trigger).onmouseenter = function(){

                elem.style.display = 'flex';
        };

        elem.onmouseleave = function(){

            elem.style.display = 'none';
        };
    }

    showHide() {
        this.event === 'onclick' ?
            this.visibilityOnClick() : this.visibilityOnMouse()
        ;
    }
}

export {ShowHide}