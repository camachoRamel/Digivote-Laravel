$(document).ready(function() {
    let dataset = [];
    let positions = {
        president: {name: '', id: '', position: ''},
        vice_president: {name: '', id: '', position: ''},
        secretary: {name: '', id: '', position: ''},
        treasurer: {name: '', id: '', positon: ''},
        auditor: {name: '', id: '', position: ''},
        business_manager_1: {name: '', id: '', position: ''},
        business_manager_2: {name: '', id: '', position: ''}
    };

    let selectBtnGen = '<button type="button" class="btn btn-dark" id="select-btn">select</button>';
    let clickedPosi;
    let icon;

    $.ajax({
        url: '../tools/retrieve-db-data.php',
        dataType: 'json',
        // If ajax success pass the response into an array, as the array will serve as the dataset for the data table
        success: function(response){
            response.forEach(element => {
                let initialize = {name: `${element['name']}`, id: `${element['id']}`, selectBtn: `${selectBtnGen}`};
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
                    //condition to add the previous student selected to the table
                    if(positions[`${clickedPosi}`]['id'] != rowNode['id']){
                        reAdd();
                    }

                    positions[`${clickedPosi}`] = rowNode;
                    positions[`${clickedPosi}`]['position'] = `${clickedPosi}`;
                    selectionTable.row(rowIndex).remove().draw();
                    //set the content for the position ex: 'president: Student Name'
                    $(`input#${clickedPosi}`).val(rowNode['name']);
                    //remove the highlight of the btn
                    if (event.originalEvent != undefined) {
                        highlightBtn();
                    }
                    $('#selectionTable').off('click', 'button#select-btn');

                    determinePosition();

                });
            };

            function highlightBtn(){
                $(`button#${clickedPosi}`).removeClass('btn-dark').addClass('btn-outline-dark');
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
                    $(`.position-btn#${clickedPosi}`).removeClass('btn-outline-dark').addClass('btn-dark')
                    //remove event listener to prevent clicking other select btn
                    $('.position-btn').off('click');
                    selectionTableEvent();
                });
            }

            function removeCandidate(){
                $('.remove-btn').on('click', function(){
                    clickedPosi = $(this).attr('id');
                    var getInputVal = $(`input#${clickedPosi}`).val();

                    if (getInputVal !== '') {
                        $(`input#${clickedPosi}`).val("");
                        let temporaryData = positions[`${clickedPosi}`];
                        selectionTable.row.add(temporaryData).draw();
                        positions[`${clickedPosi}`] = {name: '', id: '', position: ''};
                    }
                });
            }

            $('#modal-trigger-btn').on('click', function() {
                outputVal(getSelectedRowsVal());
            });

            function getSelectedRowsVal(){
                let finalData = [];
                let partyName = $('#party_name').val();
                let partyImg =  $('#party_icon').val().split('\\').pop();

                // get all the values from position then pass it to an array for easier constraint handling
                Object.keys(positions).forEach(key => {
                    if (positions[key].name !== '') {
                        let initializeData = {
                            name: positions[key]['name'],
                            id: positions[key]['id'],
                            position: positions[key]['position'],
                            party_name: partyName,
                            party_img: partyImg
                        }
                        finalData.push(initializeData);
                    }
                });
                // get the number of candidates, party name and party img values
                let constraintName = finalData[0].party_name;
                let constraintImg =  finalData[0].party_img;
                let constraintCount = finalData.length;
                // party constraint: party name and party img is not null and candidate count is greater than 4
                if(constraintName !== "" && constraintImg !== "" && constraintCount > 4){
                    $('#reviewModal').modal('show');
                }else {
                    let message = [
                        "Minumum of 5 candidates is required.",
                        "Party info is incomplete."
                    ];
                    // prompt the error/s
                    if( constraintName === "" && constraintImg === "" && constraintCount < 5){
                        alert(message[0] + "\n" + message[1]);
                    }else if(constraintCount < 5){
                        alert(message[0]);
                    }else if(constraintName === "" || constraintImg === ""){
                        alert(message[1]);
                    }
                }
                return finalData;
            }

            function outputVal(getSelectedRowsVal){
                $('#modal-table-body tr').html(" ");
                getSelectedRowsVal.forEach(obj => {
                    // Extract position name and capitalize it
                    let str = obj.position;
                    let words = str.split('_');
                    for (let i = 0; i < words.length; i++) {
                        words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
                    }
                    let result = words.join(' ');

                    // Create table row and data cells
                    let tr = $('<tr></tr>');
                    let positionTd = $(`<td>${result}</td>`);
                    let nameTd = $(`<td>${obj['name']}</td>`);
                    let idTd = $(`<td>${obj['id']}</td>`);

                    // Append data cells to table row
                    tr.append(positionTd, nameTd, idTd);

                    // Append table row to table body
                    $('#modal-table-body').append(tr);
                });
            }

            $('form').submit(function(event) {
                event.preventDefault();
                let partyName = $('#party_name').val();
                let partyImg =  $('#party_icon').val().split('\\').pop();
                let candidatesData = [];

                Object.keys(positions).forEach(key => {
                    let candidate = positions[key];
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
                            party_name: partyName,
                            party_img: partyImg,
                            stud_id: candidate.id,
                            position_id: positionId
                        });
                    }
                });

                let formData = {
                    candidates: candidatesData,
                };

                formData['_token'] =  `${csrfToken}`;

                // Send the data to the Laravel controller using AJAX
                $.ajax({
                    url: `/admin/candidate-save`,
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        window.location.href = response.redirect_url;
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                        console.log(error);
                    }
                });
            });
            determinePosition();
            removeCandidate();
        }
    });
});
