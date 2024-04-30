$(document).ready(function() {
    let dataset = [];
    let positions = {
        president: {name: '', id: ''},
        vice_president: {name: '', id: ''},
        secretary: {name: '', id: ''},
        treasurer: {name: '', id: ''},
        auditor: {name: '', id: ''},
        business_manager_1: {name: '', id: ''},
        business_manager_2: {name: '', id: ''}
    };

    let selectBtnGen = '<button type="button" class="btn btn-dark" id="select-btn">select</button>';
    let removeBtnGen = '<button type="button" class="btn btn-dark" id="remove-btn">remove</button>';
    let clickedPosi;
    let icon;

    $.ajax({
        url: '../tools/retrieve-db-data.php',
        dataType: 'json',
        // If ajax success pass the response into an array, as the array will serve as the dataset for the data table
        success: function(response){
            response.forEach(element => {
                let initialize = {name: `${element['name']}`, id: `${element['id']}`, selectBtn: `${selectBtnGen}`, removeBtn: `${removeBtnGen}`};
                dataset.push(initialize);
            });

            let selectionTable = $('#selectionTable').DataTable( {
                paging: false,
                scrollY: 400,
                data: dataset,
                columns: [
                    {   title: "Name", data: 'name' },
                    {   title: "Student-ID", data: 'id' },
                    {   data: 'selectBtn' }
                ]
            } );

            function selectionTableEvent(){
                //return the data from the previous selected candidate to the student list table
                $('#selectionTable').on('click', 'button#select-btn', function (event) {
                    let row = $(this).closest('tr');
                    let rowIndex = selectionTable.row(row).index(); // Use DataTables API to get row index

                    var rowNode = selectionTable.row(rowIndex).data();
                    console.log(rowNode)
                    //condition to add the previous student selected to the table
                    if(positions[`${clickedPosi}`]['id'] != rowNode['id']){
                        reAdd();
                    }
                    positions[`${clickedPosi}`] = rowNode;
                    selectionTable.row(rowIndex).remove().draw();
                    //set the content for the position ex: 'president: Student Name'
                    $(`#${clickedPosi}-candidate`).html(rowNode['name'] + ", " + rowNode['id']);
                    //remove the highlight of the btn
                    if (event.originalEvent != undefined) {
                        highlightBtn();
                    }
                    $('#selectionTable').off('click', 'button#select-btn');
                    determinePosition();
                });
            };

            function highlightBtn(){
                $(`#${clickedPosi}`).removeClass('btn-dark').addClass('btn-outline-dark');
                clickedPosi = '';
            }

            function reAdd(){
                if(positions[`${clickedPosi}`]['name'] != ''){
                    let temporaryData = positions[`${clickedPosi}`];
                    selectionTable.row.add(temporaryData).draw();
                }
            }

            function determinePosition(){
                //get the current position clicked
                $('.position-btn').click(function(){
                    clickedPosi = $(this).attr('id');
                    $(`#${clickedPosi}`).removeClass('btn-outline-dark').addClass('btn-dark')
                    //remove event listener to prevent clicking other select btn
                    $('.position-btn').off('click');
                    selectionTableEvent();
                });
            }

            // Get the filename
            $('#party-icon-file').change(function() {
                icon = `${$(this).val().split('\\').pop()}`;
            });

            function sendData(rowsData){
                $.ajax({
                    url: '../tools/receive-ajax-data.php',
                    method: 'POST',
                    data: {partyData: rowsData},
                    success: function(response, status){
                        console.log(status);
                        console.log(response);

                    }
                })
            }

            $('#submit-btn').on('click', function() {
                let partyNameVal = $('#party-name-input').val();
                let finalData = {
                    partyName: `${partyNameVal}`,
                    partyIcon: `${icon}`,
                    partyContent: {

                }}
                finalData['partyContent'] = Object.assign({}, positions);
                sendData(finalData);
            });

            determinePosition();
        }
    });
});
