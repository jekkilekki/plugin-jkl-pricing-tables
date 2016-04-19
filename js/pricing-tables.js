/**
 * Main jQuery function that controls all the adding of <span> tags, classes, 
 * and resizing/responsiveness for the pricing tables
 * 
 * @since   0.0.1
 * @param   jQuery  $
 */

/**
 * Function that takes care of adding additional span classes to each individual box
 * 1. Removes * and adds "Recommended" to the default boxes
 * 2. Surrounds any dollar signs ($) in the price field with <span> tags for better styling
 * 3. Surrounds any "per" units (/month) in the price field with <span> tags for better styling
 */

jQuery( document ).ready( function( $ ) {
    
    /*
     * Colors array
     */
    var colors = [
        
    ];
    
    var tables = jQuery( '.pricing-tables li' );
    for( var i = 0; i < tables.length; i++ ) {
        var list = tables[i].innerHTML.indexOf( '<ol>' );
        tables[i].innerHTML = '<span class="title">' + tables[i].innerHTML.substring( 0, list ) + '</span>' + tables[i].innerHTML.substring( list );
    }
    
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
    
    // Holds the position of the recommended table (defaults to 0 if not set)
    var recommended_position = 0;
    
    function resizeTables() {
        // Calculate the width of each Pricing Table
        var width = 100/numtables; 
        var screenWidth = jQuery('.pricing-tables').width();
        
        if ( screenWidth > 600 ) { // dunno why I have to -2 each time...
            jQuery('.pricing-table').width( width + "%" );
            jQuery('.pricing-table').css('margin-left', '0%');
            jQuery('.pricing-table').css('margin-right', '0%');
        } else if ( screenWidth > 400 ) {
            jQuery('.pricing-table').width( 33 + "%" );
            jQuery('.pricing-table').css('margin-left', '0%');
            jQuery('.pricing-table').css('margin-right', '0%');
        } else {
            jQuery('.pricing-table').width( 70 + "%" );
            jQuery('.pricing-table').css('margin-left', '15%');
            jQuery('.pricing-table').css('margin-right', '15%');
        }
    }
    
    jQuery(window).resize(function() { resizeTables(); });
    resizeTables();
    handle_price();
    
    // Make SECOND table pop-out
    // jQuery('.pricing-table:nth-child(2)').addClass('pop-out');
    
    /*
     * This code determines which table to "pop" as the recommended table
     */
    // get all the tables
    var tables = jQuery( '.pricing-table' );
    // Search every table
    var position_count = 0;
    for ( var i = 0; i < tables.length; i++ ) {
        // if you find a * - this means it's recommended
        
        if( tables[i].innerHTML.indexOf( '*' ) !== -1 ) {
            
            // FIRST, replace the star with a span class
            var to_replace = tables[i].innerHTML.substring( tables[i].innerHTML.indexOf('*'), tables[i].innerHTML.indexOf('*')+1 );
            var with_this = '<span class="recommended">Recommended</span>';
            tables[i].innerHTML = tables[i].innerHTML.replace( to_replace, with_this );
            var pos = i+1;
            var big_class = '.pricing-table:nth-child(' + pos + ')';
            jQuery( big_class ).addClass( 'big' );
            
            if( position_count == 0  ) {
                // SECOND, determine the proper position
                // only use the FIRST possible_position to set as a "pop-out"
                var pos = i+1;
                recommended_position = '.pricing-table:nth-child(' + pos + ')';

                // Here we should try to remove the * or add a <span> class with extra details
                //var str = tables[--i].innerHTML;
                //alert( str );
                //str = str.replace( '*', '<span class="recommended">Recommended</span>' );
                //alert( str );
                //jQuery( recommended_position ).html(str);
                jQuery( recommended_position ).addClass( 'pop-out' );
                ++position_count;
            }
            
        }
        
    }

    // Make a table I hover over pop-out (then the default #2 remain popped after mouseoff)
    jQuery('.pricing-table').hover(
            function() {
                if( jQuery( recommended_position ).hasClass('pop-out') ) {
                    jQuery( recommended_position ).removeClass('pop-out');
                }
                jQuery(this).addClass('pop-out');
            }, function() {
                jQuery(this).removeClass('pop-out');
                if( jQuery( recommended_position ).hasClass('pop-out') ) { /* do nothing */ }
                else { 
                    jQuery( recommended_position ).addClass('pop-out'); 
            }
    });
    
    /*
     * Function to add better styles to the pricing field
     */
    function handle_price() {
        var price_field = jQuery( '.price' );
        for( var i = 0; i < price_field.length; i++ ) {
            // Add styles to the / component
            // This MUST come first or it will detect the / in </span> for the dollar sign as well
            if( price_field[i].innerHTML.indexOf( '/' ) !== -1 ) {
                var to_replace = price_field[i].innerHTML.substring( price_field[i].innerHTML.indexOf('/') );
                var with_this = '<span class="installment">' + to_replace + '</span>';
                price_field[i].innerHTML = price_field[i].innerHTML.replace( to_replace, with_this );
            }
            // Add styles to the dollar sign
            if( price_field[i].innerHTML.indexOf( '$' ) !== -1 ) {
                price_field[i].innerHTML = price_field[i].innerHTML.replace( '$', '<span class="dollar-sign">$</span>' );
            }
        }
    }
});

