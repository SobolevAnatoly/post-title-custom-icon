jQuery(function ($) {

    //OR Statement for post type selection
    $('select').on('change', function () {
        console.log('Change');
        $('select').not(this).filter(function () {
            //loop through all the select elements
            $(this).prop('selectedIndex',0);
            $(this).prop("selected", false);
        });
    }).change();
    $('select').click(function () {
        console.log('Click');
    });

});