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
                    $(`button#${clickedPosi}`).removeClass('btn-outline-dark').addClass('btn-dark')
                    //remove event listener to prevent clicking other select btn
                    $('.position-btn').off('click');
                    selectionTableEvent();
                });
            }

            $('#modal-trigger-btn').on('click', function() {
                let finalData = finalizeData(); // Call finalizeData with the extracted values

                let test = finalData['partyContent']['position'];
                console.log(finalData)

                $('#modal-table-body tr').html(" ");

                Object.keys(finalData.partyContent).forEach(key => {
                    let str = finalData.partyContent[key].position;

                    let words = str.split('_');

                    for (let i = 0; i < words.length; i++) {
                        words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
                    }

                    let result = words.join(' ');

                    let tr = $('<tr></tr>');
                    let positionTd = $(`<td>${result}</td>`);
                    let nameTd = $(`<td>${finalData.partyContent[key].name}</td>`);
                    let idTd = $(`<td>${finalData.partyContent[key].id}</td>`);

                    tr.append(positionTd, nameTd, idTd);
                    $('#modal-table-body').append(tr);
                });
            });

            function finalizeData() {
                let disposableData = {};
                Object.keys(positions).forEach(key => {
                    if (positions[key].name !== '') {
                        delete positions[key]['selectBtn'];
                        delete positions[key]['removeBtn'];
                        disposableData[key] = positions[key];
                    }
                });

                let finalData = {
                    partyContent: disposableData
                };

                return finalData;
            }

            $('form').submit(function(event) {
                event.preventDefault();

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
                            stud_id: candidate.id,
                            position_id: positionId,
                            party_name: $('#party_name').val(),
                            party_img: $('#party_icon').val().split('\\').pop()
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
            determinePosition();
        }
    });
});
