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

( function( $ ) {
    
    /*
     * Colors array
     */
    var colors = [
        
    ];
    
    
    var tables = $( '.pricing-tables li' );
    for( var i = 0; i < tables.length; i++ ) {
        var list = tables[i].innerHTML.indexOf( '<ol>' );
        tables[i].innerHTML = '<span class="title">' + tables[i].innerHTML.substring( 0, list ) + '</span>' + tables[i].innerHTML.substring( list );
    }
    
    var tableset = $( '.pricing-tables' );
    for( var i = 1; i < tableset.length; i++ ) {
        $('.pricing-tables li:not(li li)').addClass('pricing-table pricing-table-' + i);
        $('.pricing-tables ol ol li:nth-child(1)').addClass('price');
        $('.pricing-tables ol ol li:nth-child(2)').addClass('description');
        $('.pricing-tables ol ol li:nth-last-child(2)').addClass('deliverables');
        $('.pricing-tables ol ol li:last-child').addClass('cta-button');
        $('.pricing-tables ol ol li:last-child a').addClass('button');
    }
    
    // Holds the position of the recommended table (defaults to 0 if not set)
    var recommended_position = 0;

    // Make a table I hover over pop-out (then the default #2 remain popped after mouseoff)
    $('.pricing-table').hover(
            function() {
                if( $( recommended_position ).hasClass('pop-out') ) {
                    $( recommended_position ).removeClass('pop-out');
                }
                $(this).addClass('pop-out');
            }, function() {
                $(this).removeClass('pop-out');
                if( $( recommended_position ).hasClass('pop-out') ) { /* do nothing */ }
                else { 
                    $( recommended_position ).addClass('pop-out'); 
            }
    });
    
    /**
     * Function to resize the tables - called on page load and window resize
     * @since   0.0.1
     */
    function resizeTables() {

        // Calculate the width of each Pricing Table
        $.each( $( '.pricing-tables' ), function() {
            
            // get all the tables
            var tables = $(this).find( '.pricing-table' );
            
            // Count number of Pricing Tables
            var numtables = tables.filter( function() {
                return( $(this).css( "display" ) != "none" );
            }).length;
            
            // Get the total width available to use
            var screenWidth = $( this ).width();
            // Calculate the width for each column
            var width = 100/numtables; 
            
            // If on a mobile screen (less than 400px available space), stack the table columns
            if ( screenWidth < 400 ) {
                tables.width( 70 + "%" ).css( { 'margin-left' : '15%', 'margin-right' : '15%' } );
            } else if ( screenWidth < 600 && numtables > 2 ) { // If 3 or more tables on a mid-size screen, set width to 33%
                tables.width( 33 + "%" ).css( { 'margin-left' : '0%', 'margin-right' : '0%' } );
            } else { // Else, use calculated width
                tables.width( width + "%" ).css( { 'margin-left' : '0%', 'margin-right' : '0%' } );    
            }
            
            
            var position_count = 0;
            // Iterate through every table
            for ( var i = 0; i < tables.length; i++ ) {
                
                // if you find a * - this means it's recommended
                if( tables[i].innerHTML.indexOf( '*' ) === -1 ) {
                    $( '.pricing-table:nth-child(' + (i+1) + ')' ).removeClass( 'big' );
                } else {

                    // FIRST, replace the star with a span class
                    var to_replace = tables[i].innerHTML.substring( tables[i].innerHTML.indexOf('*'), tables[i].innerHTML.indexOf('*')+1 );
                    var with_this = '<span class="recommended">Recommended</span>';
                    tables[i].innerHTML = tables[i].innerHTML.replace( to_replace, with_this );
                    
                    $( '.pricing-table:nth-child(' + (i+1) + ')' ).addClass( 'big' );

                    //if( position_count == 0  ) {
                        // SECOND, determine the proper position
                        // only use the FIRST possible_position to set as a "pop-out"
                        recommended_position = '.pricing-table:nth-child(' + (i+1) + ')';

                        // Here we should try to remove the * or add a <span> class with extra details
                        //var str = tables[--i].innerHTML;
                        //alert( str );
                        //str = str.replace( '*', '<span class="recommended">Recommended</span>' );
                        //alert( str );
                        //$( recommended_position ).html(str);
                        $( recommended_position ).addClass( 'pop-out' );
                        ++position_count;
                    //}

                //} else {
                //    $( '.pricing-table:nth-child(' + (i+1) + ')' ).removeClass( 'big pop-out' );
                }

            }
            
        });
        
    }
    
    /**
     * Function to add better styles to the pricing field
     * @since   1.3.0
     */
    function handle_price() {
        var price_field = $( '.price' );
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
 
    
    $( window ).resize( function() { resizeTables(); } );
    resizeTables();
    handle_price(); 
    
} ) ( jQuery );

