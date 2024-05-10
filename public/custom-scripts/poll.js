$(document).ready(function() {

    let progressCounter = 0;

    $.ajax({
        url: '../tools/retrieve-votes.php',
        dataType: 'json',
        // If ajax success pass the response into an array, as the array will serve as the dataset for the data table
        success: function(response){
            response.forEach(element => {
                ++progressCounter;
                $(`.progress > .${progressCounter}`).width(element.votes);
            });
        }
    });

    $('.progress > .1').width(200);

    $('#tally-table').DataTable({
        paging: false,
        info: false,
        columns: [
            { },
            { sortable: false  },
            {}
        ]
    });

});
