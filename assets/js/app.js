require('../css/app.css');

document.addEventListener('DOMContentLoaded', function() {
    let nav = document.querySelectorAll('.sidenav');
    let initNav = M.Sidenav.init(nav);

    let toolTip = document.querySelectorAll('.tooltipped');
    let initTip = M.Tooltip.init(toolTip,{
        margin: 15
    });
});