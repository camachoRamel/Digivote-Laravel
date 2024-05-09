$(document).ready(function() {
    // Render Tally
    function renderTally(){
        //main container
        let tallyRowContainer = $('<div class="row align-items-center" id="tally-main-row-container"></div>');

    // Three main container children
        let nameContainer = $('<div class="col-4 col-lg-2"></div>');
        let progressBarContainer = $('<div class="col-6 col-lg-9"></div>');
        let voteNumberContainer = $('<div class="col-2 col-lg-1"></div>');

        // child container of nameContainer and progressBarContainer
        let childNameContainer = $(`<div class="container"></div>`);
        let childprogressBarContainer = $(`<div class="progress rounded-0 me-auto">`);

        // contents of each main container child

        // two contents of nameContainer
        // let imgContent = $(`<div class="rounded-circle border border-dark text-center position-relative" id="candidate-profile-container">
        // IMG
        // </div>`);
        let nameContent = $(`<h5 id="tally-candidate-name">01-Jo-Avila</h5>`);

        // progressbar content
        let progressBarContent = $(`<div class="progress-bar" id="progress" role="progressbar">
        </div>`);

        // Number of Votes Content
        let voteNumberContent = $(`<div class="d-flex justify-content-end align-items-center fs-5 fw-bold">100</div>`);


        $('#main-tally-container').append(tallyRowContainer);

            tallyRowContainer.append(
            nameContainer,
            progressBarContainer,
            voteNumberContainer
        );

        nameContainer.append(childNameContainer);
        progressBarContainer.append(childprogressBarContainer);
        voteNumberContainer.append(voteNumberContent);

        childNameContainer.append(nameContent);
        childprogressBarContainer.append(progressBarContent);

    }

    for(let i = 0; i < 10; i++){
        renderTally();
    }

    //render list of candidates
        var groupColumn = 2;
        let candidateTable = $('#candidate-table').DataTable({
            scrollY: 500,
            paging: false,
            info: false,
            order: [[groupColumn, 'asc']],

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
            },
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

});
