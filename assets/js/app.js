require('../css/app.css');

    document.addEventListener('DOMContentLoaded', function() {
        let nav = document.querySelectorAll('.sidenav');
        let initNav = M.Sidenav.init(nav);

        let toolTip = document.querySelectorAll('.tooltipped');
        let initTip = M.Tooltip.init(toolTip,{
        margin: 15
        });

        let elems = document.querySelectorAll('.fixed-action-btn');
        let instances = M.FloatingActionButton.init(elems);

        let collapsibleList = document.querySelectorAll('.collapsible');
        let initCollapsible = M.Collapsible.init(collapsibleList);

});