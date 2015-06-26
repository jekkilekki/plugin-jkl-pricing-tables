jQuery(document).ready(function($) {
    jQuery('.pricing-tables li:not(li li)').addClass('pricing-table');
    jQuery('.pricing-tables ol ol li:nth-child(1)').addClass('price');
    jQuery('.pricing-tables ol ol li:nth-child(2)').addClass('description');
    jQuery('.pricing-tables ol ol li:nth-last-child(2)').addClass('deliverables');
    jQuery('.pricing-tables ol ol li:last-child').addClass('cta-button');
    jQuery('.pricing-tables ol ol li:last-child a').addClass('button');
    
    // Count number of Pricing Tables
    var numtables = jQuery('.pricing-table').filter( function() {
        return( jQuery(this).css("display") != "none" );
    }).length;
    
    
    function resizeTables() {
        // Calculate the width of each Pricing Table
        var width = 100/numtables; 
        var screenWidth = jQuery('.pricing-tables').width();
        
        if ( screenWidth > 600 ) { // dunno why I have to -2 each time...
            jQuery('.pricing-table').width( width-2 + "%" );
            jQuery('.pricing-table').css('margin-left', 'auto');
        } else if ( screenWidth > 400 ) {
            jQuery('.pricing-table').width( 31 + "%" );
            jQuery('.pricing-table').css('margin-left', 'auto');
        } else {
            jQuery('.pricing-table').width( 68 + "%" );
            jQuery('.pricing-table').css('margin-left', '15%');
        }
    }
    
    jQuery(window).resize(function() { resizeTables(); });
    resizeTables();
    
    // Make SECOND table pop-out
    jQuery('.pricing-table:nth-child(2)').addClass('pop-out');

    // Make a table I hover over pop-out (then the default #2 remain popped after mouseoff)
    jQuery('.pricing-table').hover(
            function() {
                if( jQuery('.pricing-table:nth-child(2)').hasClass('pop-out') ) {
                    jQuery('.pricing-table:nth-child(2)').removeClass('pop-out');
                }
                jQuery(this).addClass('pop-out');
            }, function() {
                jQuery(this).removeClass('pop-out');
                if( jQuery('.pricing-table:nth-child(2)').hasClass('pop-out') ) { /* do nothing */ }
                else { 
                    jQuery('.pricing-table:nth-child(2)').addClass('pop-out'); 
            }
    });
});

