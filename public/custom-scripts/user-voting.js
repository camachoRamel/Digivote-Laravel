$(document).ready(function() {
    let dataset = [];
    let positions = {
        1: {name: '', id: '', position: ''},
        2: {name: '', id: '', position: ''},
        3: {name: '', id: '', position: ''},
        4: {name: '', id: '', position: ''},
        5: {name: '', id: '', position: ''},
        6: {name: '', id: '', position: ''},
        7: {name: '', id: '', position: ''}
    };

    let clickedPosi;

    function determinePosition() {
        console.log("determinePosition function called");
        $('.vote-btn').on('click', function(event) {
            var clickedButton = $(this);
            var clickedPosi = clickedButton.attr('id');
            var container = $(this).closest("#button-group")

            if($(this).hasClass("btn-dark")){
                console.log(1)
                $(this).removeClass('btn-dark').addClass('btn-outline-dark')

                positions[clickedPosi].position = "";
                positions[clickedPosi].id = "";
                positions[clickedPosi].name = "";
            }else{

                container.find('.vote-btn').removeClass('btn-dark').addClass('btn-outline-dark');

                // Add btn-dark class to the clicked button
                clickedButton.removeClass('btn-outline-dark').addClass('btn-dark');

                var getCandidateID = clickedButton.val();
                var getCandidateName = clickedButton.html();

                positions[clickedPosi].position = clickedPosi;
                positions[clickedPosi].id = getCandidateID;
                positions[clickedPosi].name = getCandidateName;
            }
            console.log(positions)
        });
    }


    $('#modal-trigger-btn').on('click', function() {
        outputVal(getSelectedRowsVal());
    });

    function getSelectedRowsVal(){
        let finalData = [];

        // get all the values from position then pass it to an array for easier constraint handling
        Object.keys(positions).forEach(key => {
            if (positions[key].name !== '') {
                let initializeData = {
                    name: positions[key]['name'],
                    id: positions[key]['id'],
                    position: positions[key]['position'],
                }
                finalData.push(initializeData);
            }
        });
        // get the number of candidates, party name and party img values
        let constraintCount = finalData.length;
        // party constraint: party name and party img is not null and candidate count is greater than 4
        if(constraintCount > 0){
            $('#reviewModal').modal('show');
        }else {
            alert("Please vote atleast 1 candidate");
        }
        return finalData;
    }

    function outputVal(getSelectedRowsVal){
        $('#modal-table-body tr').html(" ");
        getSelectedRowsVal.forEach(obj => {
            // Extract position name and capitalize it

            let positionTd;

            switch (obj.position) {
                case '1':
                    positionTd = $(`<td>President</td>`);
                    console.log('test')
                    break;
                case "2":
                    positionTd = $(`<td>Vice President</td>`);
                    break;
                case '3':
                    positionTd = $(`<td>Secretary</td>`);
                    break;
                case '4':
                    positionTd = $(`<td>Treasurer</td>`);
                    break;
                case '5':
                    positionTd = $(`<td>Auditor</td>`);
                    break;
                case '6':
                    positionTd = $(`<td>Business Manager</td>`);
                    break;
                case '7':
                    positionTd = $(`<td>Business Manager</td>`);
                    break;
            }

            console.log(obj.position)

            // Create table row and data cells
            let tr = $('<tr></tr>');

            let nameTd = $(`<td>${obj['name']}</td>`);
            // let idTd = $(`<td>${obj['id']}</td>`);

            // Append data cells to table row
            tr.append(positionTd, nameTd);

            // Append table row to table body
            $('#modal-table-body').append(tr);
        });
    }

    $('form').submit(function(event) {
        event.preventDefault();
        let candidatesData = [];

        Object.keys(positions).forEach(key => {
            let candidate = positions[key];
            if (candidate.id !== '') {
                candidatesData.push({
                    candidate_id: candidate.id,
                    position_id: candidate.position
                });
            }
        });

        let formData = {
            candidates: candidatesData,
        };

        formData['_token'] =  `${csrfToken}`;
        formData['user_id'] = `${userID}`;

        // Send the data to the Laravel controller using AJAX
        $.ajax({
            url: `/user/submit-vote`,
            method: 'POST',
            data: formData,
            success: function(response) {
                alert(response.message)
                window.location.href = response.redirect_url;
            },
            error: function(xhr, status, error) {
                console.error(xhr);
                console.log(error);
            }
        });
    });
    determinePosition();
});
