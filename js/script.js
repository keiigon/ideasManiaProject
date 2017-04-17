$(document).ready(function(){
     var pageName = location.pathname.split('/')[2];
     $('a[href="' + pageName + '"]').parent().addClass("active");
});