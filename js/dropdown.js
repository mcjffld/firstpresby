// jDiv - a jQuery plugin
// (c) Skyrocket Labs
// http://www.skyrocketlabs.com
// fred@skyrocketlabs.com
// Created: 10.24.2009.
// Last updated: 23.05.2011. by roXon 

$(document).ready(function() {

    var countNavs = 0; $('#menu-item').attr('class', function() {countNavs++;return 'connected' + countNavs;}); 
    var countDrops = 0; $('.dropdown').attr('class', function() {countDrops++;return 'dropdown connected' + countDrops;}); 

    var hide1 = false;            
    $("menu-item").hover(function(){    
        var equal = $(this).attr('class'); 
        
        $('.active').removeClass();
    if (hide1) clearTimeout(hide1);
        $('.dropdown').hide();
        $('.'+equal).not('li').show();
        $(this).children('a').toggleClass('active');                
    }, function() {
        hide1 = setTimeout(function() {$('.'+equal).not('li').hide();});
    });
    
    $('.dropdown').hover(function(){        
        if (hide1) clearTimeout(hide1);            
    }, function() {            
        hide1 = setTimeout(function() {$('.dropdown').hide();});
        $('.active').removeClass();        
        $('.dropdown').stop().show();
    });

});
​