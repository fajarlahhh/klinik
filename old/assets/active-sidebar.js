
function setActive(){
    var pathArray = window.location.pathname.split( '/' );

    if(pathArray.length > 1){
        if(pathArray[1] == 'dashboard.html' || pathArray[1] == ''){
            $('#dashboard').addClass('active');
        }else{
            var child = document.getElementById(pathArray[1].replace(".html", ""));
            var parent = child.className;
            $('#' + pathArray[1].replace(".html", "")).addClass('active');
            if (parent) {
                $('#' + parent).addClass('active menu-open');
            }
        }
    }else{
        $('#dashboard').addClass('active');
    }
}