$(document).ready(function() {
    let candidateImg = '<div class="rounded-circle border border-dark" id="candidate-profile-container"></div>';
    let editBtn = '<button type="button" class="btn btn-outline-success" id="edit-btn"><i class="bi bi-pencil-square"></i></button>';
    let removeBtn = '<button type="button" class="btn btn-outline-danger" id="remove-btn"><i class="bi bi-trash"></i></button>';
    let tempRow;
    
    let test = [
        {name: 'Lasttest, Test, T', position: 'president', id: '1', img: `${candidateImg}`, number: '1', icon: 'icon', btns: `${editBtn} ${removeBtn}`},
        {name: 'Lasttest, Test, T', position: 'president', id: '2', img: `${candidateImg}`, number: '2', icon: 'icon', btns: `${editBtn} ${removeBtn}`},
        {name: 'Lasttest, Test, T', position: 'president', id: '3', img: `${candidateImg}`, number: '3', icon: 'icon', btns: `${editBtn} ${removeBtn}`},
        {name: 'Lasttest, Test, T', position: 'vice-president', id: '4', img: `${candidateImg}`, number: '4', icon: 'icon', btns: `${editBtn} ${removeBtn}`},
        {name: 'Lasttest, Test, T', position: 'vice-president', id: '5', img: `${candidateImg}`, number: '5', icon: 'icon', btns: `${editBtn} ${removeBtn}`},
        {name: 'Lasttest, Test, T', position: 'vice-president', id: '6', img: `${candidateImg}`, number: '6', icon: 'icon', btns: `${editBtn} ${removeBtn}`}
    ]

   
    // receive the candidates list file that was retrieved via php
    // $.ajax({
    //     url: '../tools/retrieve-db-data.php',
    //     dataType: 'json',
    //     // If ajax success pass the response into an array, as the array will serve as the dataset for the data table
    //     success: function(response){
    //             response.forEach(element => {
    //                 let initialize = {name: `${element['name']}`, id: `${element['id']}`, selectBtn: `${selectBtnGen}`, removeBtn: `${removeBtnGen}`};
    //                 dataset.push(initialize);
    //             // dataset.push()
    //             });
    //     }
    // });


    // Render Tally
    function renderTally(){
        //main container
        let tallyRowContainer = $('<div class="row align-items-center" id="tally-main-row-container"></div>');

    // Three main container children
        let imgNameContainer = $('<div class="col-2 col-lg-3"></div>');
        let progressBarContainer = $('<div class="col-8"></div>');
        let voteNumberContainer = $('<div class="col-2 col-lg-1"></div>');

        // child container of imgNameContainer and progressBarContainer 
        let childImgNameContainer = $(`<div class="d-flex ms-2 gap-3 align-items-center"></div>`);
        let childprogressBarContainer = $(`<div class="progress rounded-0 me-auto">`);

        // contents of each main container child
        
        // two contents of imgNameContainer
        let imgContent = $(`<div class="rounded-circle border border-dark text-center position-relative" id="candidate-profile-container">
        IMG    
        </div>`); 
        let nameContent = $(`<h5 class="d-none d-lg-flex" id="tally-candidate-name">01-Jo-Avila</h5>`);
    
        // progressbar content
        let progressBarContent = $(`<div class="progress-bar" id="progress" role="progressbar">
        </div>`);

        // Number of Votes Content
        let voteNumberContent = $(`<div class="d-flex justify-content-end align-items-center fs-5 fw-bold">100</div>`);


        $('#main-tally-container').append(tallyRowContainer);
        
        tallyRowContainer.append(
            imgNameContainer, 
            progressBarContainer,
            voteNumberContainer
        );
        
        imgNameContainer.append(childImgNameContainer);
        progressBarContainer.append(childprogressBarContainer);
        voteNumberContainer.append(voteNumberContent);

        childImgNameContainer.append(
            imgContent,
            nameContent
        );

        childprogressBarContainer.append(progressBarContent);

    }

    for(let i = 0; i < 10; i++){
        renderTally();
    }


    //render list of candidates 
    setTimeout(() => {
        var groupColumn = 2;
        let candidateTable = $('#candidate-table').DataTable({
            scrollY: 400,
            // scrollY: '100px',
            // scrollCollapse: false,  
            paging: false,
            info: false,
            data: test,
            columns: [
                { data: 'img' },
                { title: 'Candidate Name', data: 'name'},
                // position is row is hidden but is responsible for row grouping
                { data: 'position', visible: false},

                { title: 'Party Icon', data: 'icon'},
                { title: 'Ballot Number', data: 'number'},
                { data: 'btns'},
                
            ],
            order: [[groupColumn, 'asc']],
            // ordering: false, 
            drawCallback: function (settings) {
                var api = this.api();
                var rows = api.rows({ page: 'current' }).nodes();
                var last = null;
        
                api.column(groupColumn, { page: 'current' })
                    .data()
                    .each(function (group, i) {
                        if (last !== group) {
                            $(rows)
                                .eq(i)
                                .before(
                                    '<tr class="group table-dark"><td colspan="5">' +
                                    group +
                                    '</td></tr>'
                                );
    
                            last = group;
                        }
                    });
            }
        });

        candidateTable.columns.adjust().draw();
 
        // Order by the grouping
        $('#candidate-table tbody').on('click', 'tr.group', function () {
            var currentOrder = table.order()[0];
            if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
                table.order([groupColumn, 'desc']).draw();
            }
            else {
                table.order([groupColumn, 'asc']).draw();
            }
        });

        $('#candidate-table button#edit-btn').on('click', function () {
            let row = $(this).closest('tr');
            
            let rowIndex = row.index();

            let groupCounter = 0;

            row.prevAll('tr').each( function () {
                if($(this).hasClass('group')){
                    ++groupCounter;
                }
            });

            var rowNode = candidateTable.row(rowIndex - groupCounter).data();
            console.log(rowNode);

            groupCounter = 0;
            row.html('');

            // column containers
            let rowImgContainer = '<td> <div class="rounded-circle border border-dark" id="candidate-profile-container"></div> </td>';
            let rowCandidateNameInput = `<td> <input type="text" class="form-control" value="${rowNode['name']}"></td>`;
            let rowPartyIcon = `<td> <input type="text" class="form-control" value="${rowNode['icon']}"> </td>`;
            let rowBallotNumber = `<td> <input type="number" class="form-control" value="${rowNode['number']}"> </td>`;
            let rowBtns = `<td> <button type="button" class="btn btn-dark" id="edit-btn"> <i class="bi bi-check2-square"></i> </button> </td>`;

            row.append(rowImgContainer, rowCandidateNameInput, rowPartyIcon, rowBallotNumber, rowBtns)

            // console.log(rowNode)
        });

        $('#candidate-table button#remove-btn').on('click', function () {
            console.log('r')
        });

        function changeAsInput(){
            $('#candidate-table tbody').on('click', 'tr', function () {
            var rowNode = candidateTable.row(this).data();
    
            candidateTable.row(this).remove().draw();


            deselectionTable.row.add(rowNode).draw();
                checkRowVal();
            });      
        };
    }, 1000);
    
    
    
    

});