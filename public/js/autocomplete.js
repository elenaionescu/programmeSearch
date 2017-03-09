(function($){
    'use strict';

    // The JSON list url
    var programmes = "programmes.json";

    /**
     * Create the options from the programmes array
     * @param {Array} programmes
     */
    function createList(programmes) {
        // get the datalist element
        var datalist = $("#programmeslist");

        // Fill it with the programmes array
        for(var i=0; i<programmes.length; i++){
            $('<option>'+programmes[i]+'</option>').appendTo(datalist);
        }
    }


    /**
     * Load data and call callback function
     * @param {Function} callback
     */
    function loadDatas( callback ){

        // Make the ajax call
        $.getJSON(programmes, function(list){
            // create the programmes array
            var programmes =[];
            for(var i=0; i<list.length; i++){
                programmes.push(list[i].title);
            }
            // Call the function that will create the options
            // But sort the array first (for better user experience)
            callback(programmes.sort());
        });
    }

    // jQuery OnLoad ...
    $(function(){
        loadDatas( createList );
    });

})(jQuery);
