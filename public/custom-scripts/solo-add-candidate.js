$(document).ready(function() {
    let dataset = [];
    $.ajax({
        url: '../tools/retrieve-db-data.php',
        dataType: 'json',
        // If ajax success pass the response into an array, as the array will serve as the dataset for the data table
        success: function(response){
                response.forEach(element => {
                dataset.push(element);
                });
        }
    });
 
    setTimeout(() => {
        let selectionTable = $('#selectionTable').DataTable( {
        // ajax: {
        //     url: 'retrieve_data.php',
        //     dataSrc: '',
        // },
        paging: false,
        // dom: "t",
        scrollY: 200,
        data: dataset,
        columns: [
            {   title: "Name", data: 'name' },
            {   title: "Student-ID", data: 'id' }
        ]
        } );


    let deselectionTable = $('#selectedTable').DataTable( {
        paging: false,
        ordering: false,
        dom: "t",
        columns: [
            { title: 'Name', data: "name" },
            { title: 'Student-id', data: 'id' }
        ],
    } );
    
    function checkRowVal(){
        let arr = ["#selectionTable", "#selectedTable"];

        for(let i = 0; i < 2; i++){
            if($(`${arr[i]} > tbody > tr > td`).hasClass("dt-empty")){
                $(`${arr[i]} > tbody > tr`).html(" ");
            }
        }
    }

    function selectionTableEvent(){
        $('#selectionTable tbody').on('click', 'tr', function () {
        var rowNode = selectionTable.row(this).data();

        selectionTable.row(this).remove().draw();
        deselectionTable.row.add(rowNode).draw();
            checkRowVal();
        });      
    };

    function deselectionTableEvent(){
        $('#selectedTable tbody').on('click', 'tr', function () {
        var rowNode = deselectionTable.row(this).data();

        deselectionTable.row(this).remove().draw();
        selectionTable.row.add(rowNode).draw();

        checkRowVal();
        });
    };
   
    selectionTableEvent();
    deselectionTableEvent();

    checkRowVal();
    
    function getSelectedRowsVal(){
        let counter = 0;
        let rows = [];
        let initialize = {};
        let test = $('select').val();
        $(`#selectedTable > tbody > tr`).each(() => {
            let rowData = deselectionTable.row(counter).data();
            initialize = {name: `${rowData['name']}`, id: `${rowData['id']}`, position: `${test}`}
            rows.push(initialize);
            counter++;
        })
        console.log(rows)
        return rows;
    }

    function outputVal(selectedRows){
        $('#modal-body').html(" ");

        let selectVal = $('select').val();
        $('.modal-title').html(`${selectVal}`);
        selectedRows.forEach( element => {
            $div = `<div> ${element['name']} </div>`;
            $('#modal-body').append(`${$div}`);
        });
    }

    function sendData(rowsData){
        $.ajax({
            url: '../tools/receive-ajax-data.php',
            method: 'POST',   
            data: {myData: rowsData},
            success: function(response, status){
                console.log(status);
                console.log(response);

            }
        })
    }

    $('#submitBtn').on('click', () => {
        sendData(getSelectedRowsVal());
    });

    $('#modal-trigger-btn').on('click', () => {
        outputVal(getSelectedRowsVal());
    });

    }, 1000);

});