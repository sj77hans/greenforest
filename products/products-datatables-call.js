// Call the dataTables jQuery plugin

$(document).ready(function () {
  var t = $('#dataTable').DataTable({
    "columnDefs": [{
      "searchable": false,
      "orderable": false,
      "targets": [0, 5] // 0.1컬럼 정렬/검색 사용안함
    }],
    "order": [[1, 'asc']],
    "lengthMenu": [[25, 50, 100, -1], ["25개씩 보기", "50개씩 보기", "100개씩 보기", "전체보기"]],
    "language": {
      "decimal": "",
      "emptyTable": "표에서 사용할 수있는 데이터가 없습니다.",
      "info": "_TOTAL_개의 상품이 있습니다.",
      "infoEmpty": "0 개 상품이 있습니다.",
      "infoFiltered": "(전체 상품: _MAX_개)",
      "infoPostFix": "",
      "thousands": ",",
      "loadingRecords": "로드 중 ...",
      "processing": "처리 중 ...",
      "zeroRecords": "일치하는 상품이 없습니다.",
    },
    initComplete: function () {
      this.api().columns(1).every(function () {
        var column = this;
        var select = $('<select><option value="">전체</option></select>')
          .appendTo('.user-filter1')
          .on('change', function () {
            var val = $.fn.dataTable.util.escapeRegex(
              $(this).val()
            );

            column
              .search(val ? '^' + val + '$' : '', true, false)
              .draw();
          });

        column.data().unique().sort().each(function (d, j) {
          select.append('<option value="' + d + '">' + d + '</option>')
        });
      });
    }
  });
  t.on('order.dt search.dt', function () {
    t.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
      cell.innerHTML = i + 1;
    });
  }).draw();
});