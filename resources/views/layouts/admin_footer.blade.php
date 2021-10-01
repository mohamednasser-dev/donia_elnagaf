                </div>
                <footer class="footer"> © 2021 mo nasser </footer>
            </div>
        </div>
        <script src="{{ asset('/assets/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('/assets/plugins/bootstrap/js/popper.min.js') }}"></script>
        <script src="{{ asset('/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/js/perfect-scrollbar.jquery.min.js') }}"></script>
        <script src="{{ asset('/js/waves.js') }}"></script>
        <script src="{{ asset('/js/sidebarmenu.js') }}"></script>
        <script src="{{ asset('/js/custom.min.js') }}"></script>
        <script src="{{ asset('/assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
        <script src="{{ asset('/assets/plugins/d3/d3.min.js') }}"></script>
        <script src="{{ asset('/assets/plugins/c3-master/c3.min.js') }}"></script>
        <script src="{{ asset('/assets/plugins/toast-master/js/jquery.toast.js') }}"></script>
        <script src="{{ asset('/js/dashboard1.js') }}"></script>
        <script src="{{ asset('/assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
        <script src="{{ asset('/assets/plugins/sweetalert/jquery.sweet-alert.custom.js') }}"></script>
        <script src="{{ asset('/assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>
        <script src="{{ asset('/assets/plugins/toastr/toastr.js') }}"></script>
        <script src="{{ asset('/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
        <script src="{{ asset('/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
        @yield('scripts')
        <script>
        $(document).ready(function() {
            $(document).ready(function() {
                var table = $('#example').DataTable({
                    "columnDefs": [{
                        "visible": false,
                        "targets": 2
                    }],
                    "order": [
                        [2, 'asc']
                    ],
                    "displayLength": 25,
                    "drawCallback": function(settings) {
                        var api = this.api();
                        var rows = api.rows({
                            page: 'current'
                        }).nodes();
                        var last = null;
                        api.column(2, {
                            page: 'current'
                        }).data().each(function(group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                                last = group;
                            }
                        });
                    }
                });
                // Order by the grouping
                $('#example tbody').on('click', 'tr.group', function() {
                    var currentOrder = table.order()[0];
                    if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                        table.order([2, 'desc']).draw();
                    } else {
                        table.order([2, 'asc']).draw();
                    }
                });
            });
        });
        $('#example23').DataTable({
            dom: 'Bfrtip',
            buttons: [],
             "language": {
                "paginate": {
                    "next": "{{trans('admin.next')}}",
                    "previous" : "{{trans('admin.befor')}}"
                },
                "search":"{{trans('admin.search')}}:",
                "lengthMenu":     " ",
            },
        });
    </script>
    </body>
</html>
