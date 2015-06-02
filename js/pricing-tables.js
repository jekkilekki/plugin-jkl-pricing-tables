jQuery(document).ready(function($) {
    jQuery('.pricing-tables li:not(li li)').addClass('pricing-table');
    jQuery('.pricing-tables ol ol li:nth-child(1)').addClass('price');
    jQuery('.pricing-tables ol ol li:nth-child(2)').addClass('description');
    jQuery('.pricing-tables ol ol li:nth-last-child(2)').addClass('deliverables');
    jQuery('.pricing-tables ol ol li:last-child').addClass('cta-button');
    jQuery('.pricing-tables ol ol li:last-child a').addClass('button');

    jQuery('.pricing-table li:not(li li):first-child').addClass('small-table');
    jQuery('.pricing-table li:not(li li):last-child').addClass('small-table');
});

