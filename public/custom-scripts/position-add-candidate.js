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

                let words = selectVal.split('_');

                for (let i = 0; i < words.length; i++) {
                    words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
                }

                let result = words.join(' ');

                $('.modal-title').html(`${result}`);
                selectedRows.forEach( element => {
                    $div = `<div> ${element['name']} </div>`;
                    $('#modal-body').append(`${$div}`);
                });
            }

            $('#modal-trigger-btn').on('click', () => {
                outputVal(getSelectedRowsVal());
            });

            $('form').submit(function(event) {
                event.preventDefault();

                let candidatesData = [];

                let reValue = getSelectedRowsVal();

                reValue.forEach( candidate => {
                    if (candidate.id !== '') {
                        // Convert position name to position_id
                        let positionId;
                        switch (candidate['position']) {
                            case 'president':
                                positionId = 1;
                                break;
                            case 'vice_president':
                                positionId = 2;
                                break;
                            case 'secretary':
                                positionId = 3;
                                break;
                            case 'treasurer':
                                positionId = 4;
                                break;
                            case 'auditor':
                                positionId = 5;
                                break;
                            case 'business_manager_1':
                                positionId = 6;
                                break;
                            case 'business_manager_2':
                                positionId = 7;
                                break;
                            default:
                                positionId = null;
                        }
                        candidatesData.push({
                            stud_id: candidate.id,
                            position_id: positionId,
                            party_name: null,
                            party_img: null
                        });
                    }
                });


                let formData = {
                    candidates: candidatesData,
                };

                formData['_token'] =  `${csrfToken}`;

                // Send the data to the Laravel controller using AJAX
                $.ajax({
                    url: '/candidate-save',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        window.location.href = response.redirect_url;
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });

        }
    });
});
