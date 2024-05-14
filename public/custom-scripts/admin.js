$(document).ready(function() {

    //render list of candidates
        var groupColumn = 2;
        let candidateTable = $('#candidate-table').DataTable({
            scrollY: 500,
            paging: false,
            info: false,
            columns: [
                { sortable: false },
                {},
                { visible: false },
                {},
                { sortable: false },

            ],
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


        $('#tally-table').DataTable({
            scrollY: 300,
            paging: false,
            info: false,
            columns: [
                { },
                { sortable: false  },
                {}
            ]
        });


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
