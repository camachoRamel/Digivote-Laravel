$(document).ready(function() {
    let selectBtn = '<button type="button" class="btn btn-dark" id="select-btn">Select</button>';
    let removeBtn = '<button type="button" class="btn btn-danger" id="remove-btn">Remove</button>';
    let dataset = [];

    $.ajax({
        url: '../tools/retrieve-db-data.php',
        dataType: 'json',
        // If ajax success pass the response into an array, as the array will serve as the dataset for the data table
        success: function(response){
            response.forEach(element => {
                let initialize = {name: `${element['name']}`, id: `${element['id']}`, selectBtn: `${selectBtn}`, removeBtn: `${removeBtn}`};
                dataset.push(initialize);
            });

            let selectionTable = $('#selectionTable').DataTable({
                paging: false,
                scrollY: 200,   
                data: dataset,
                columns: [
                    { title: "Name", data: 'name' },
                    { title: "Student-ID", data: 'id' },
                    { data: 'selectBtn' }
                ]
            });

            let deselectionTable = $('#selectedTable').DataTable({
                paging: false,
                ordering: false,
                dom: "t",
                columns: [
                    { title: 'Name', data: "name" },
                    { title: 'Student-id', data: 'id' },
                    { data: 'removeBtn'}
                ]
            });

            $('#selectionTable').on('click', 'button#select-btn', function() {
                let row = $(this).closest('tr');
                let rowIndex = selectionTable.row(row).index(); // Use DataTables API to get row index
            
                var rowNode = selectionTable.row(rowIndex).data();
            
                // Remove row from selectionTable and add to deselectionTable
                selectionTable.row(rowIndex).remove().draw();
                deselectionTable.row.add(rowNode).draw();
            });
            
            $('#selectedTable').on('click', 'button#remove-btn', function() {
                let row = $(this).closest('tr');
                let rowIndex = deselectionTable.row(row).index(); // Use DataTables API to get row index
            
                var rowNode = deselectionTable.row(rowIndex).data();
            
                // Remove row from deselectionTable and add to selectionTable
                deselectionTable.row(rowIndex).remove().draw();
                selectionTable.row.add(rowNode).draw();
            });

            function getSelectedRowsVal(){
                let counter = 0;
                let rows = [];
                let initialize = {};
                let positionVal = $('select').val();
                let rowCount = $('#selectedTable td:not(.dt-empty)').length;
                if(rowCount === 0){
                    alert("You have not selected any candidate");
                }else{
                    $(`#selectedTable > tbody > tr`).each(() => {
                        let rowData = deselectionTable.row(counter).data();
                        initialize = {name: `${rowData['name']}`, id: `${rowData['id']}`, position: `${positionVal}`}
                        rows.push(initialize);
                        counter++;
                    })
                    $('#reviewModal').modal('show');
                }
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
        
        }
    });
});
