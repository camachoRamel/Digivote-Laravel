$(document).ready(function() {

    var groupColumn = 2;
    let candidateTable = $('#candidate-table').DataTable({
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
