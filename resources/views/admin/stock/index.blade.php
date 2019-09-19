@extends('layouts.admin')
@section('title')In Stock @endsection
@section('content')
    <div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"></h4>

                </div>
                <div class="modal-body"> No data here </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption font-dark">
                                    <i class="icon-settings font-dark"></i>
                                    <span class="caption-subject bold uppercase"> In Stock</span>
                                </div>

                            </div>

                            <div class="portlet-body">
                                <div class="table-toolbar">
                                        @if(Session::has('success'))
                                        <div class="row">
                                            <!-- Welcome -->
                                            <div class="col-lg-12">
                                                <div class="alert alert-info">
                                                    <i class="fa fa-folder-open"></i>
                                                    <b>{{Session::get('success')}}</b>
                                                </div>
                                            </div>
                                            <!--end  Welcome -->
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="btn-group">
                                                <a href="{{ url('admin/instock/reset_create') }}" id="sample_editable_1_2_new" class="btn sbold green"> Add New
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <section class="content">
                                    <div class="row">
                                        <!-- left column -->
                                        <div class="col-md-12">
                                            <!-- general form elements -->
                                            <div class="box box-primary">

                                                <!-- /.box-header -->
                                                <!-- form start -->
                                                <form role="form">
                                                    <div class="box-body">
                                                        {{csrf_field()}}
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="date-from">From date</label>
                                                                    <input type="text" class="form-control" data-date-format="dd-mm-yyyy" id="date-from" placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="date-to">To date</label>
                                                                    <input type="text" class="form-control" data-date-format="dd-mm-yyyy" id="date-to" placeholder="">
                                                                </div>

                                                            </div>


                                                        </div>

                                                    </div>
                                                    <!-- /.box-body -->


                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </section>
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="example2">
                                    <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> User</th>
                                        <th> Invoice</th>
                                        <th> PO</th>
                                        <th> In date</th>
                                        <th> Remark</th>
                                        <th> Actions </th>
                                    </tr>
                                    <form class="form-inline" style="padding-bottom: 10px">
                                        <tr role="row" class="filter">
                                            <td> </td>
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" id="staticUser"> </td>
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" id="staticInvoice"></td>
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" id="staticPO"></td>
                                            <td> </td>
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" id="staticRemark">
                                            </td>
                                            <td>
                                                <a class="btn btn-sm red btn-outline filter-cancel"id="clear-input">
                                                    <i class="fa fa-times"></i> Reset</a>
                                            </td>
                                        </tr>
                                    </form>
                                    </thead>
                                    <tfoot>
                                    </tfoot>
                                    <tbody>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>

    

@endsection
@section('script')
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bootstrap-modalmanager.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bootstrap-modal.js')}}" type="text/javascript"></script>

    {{--button--}}
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src=" https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            $('#date-from').datepicker({
                autoclose: true,
                dateFormat: 'yy-mm-dd'
            })
        });
        $(document).ready(function () {
            $('#date-to').datepicker({
                autoclose: true,
                dateFormat: 'yy-mm-dd'
            }).datepicker("setDate", new Date())
        });

        $(document).ready(function() {
            var example = $('#example2').DataTable( {
                pagingType: "full_numbers",
                ordering:true,
                info:true,
                dom: 'Blfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o fa-lg" aria-hidden="true"></i> Export excel',
                        className:'btn btn-success',
                        title:'Statistics',
                        exportOptions: {
                            columns: [1,2,3,4,5,6,7,8,9]
                        }
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export pdf',
                        className:'btn btn-success',
                        title:'Statistics',
                        customize: function (doc) {
                            doc.defaultStyle.alignment = 'center';
                            doc.content[1].table.widths =
                                Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        }
                    } ,
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print" aria-hidden="true"></i> Print',
                    }
                ],
                language: {
                    "paginate": {
                        "first":"First",
                        "previous": "Previous",
                        "next":"Next",
                        "last":"Last"
                    },
                    "sLengthMenu": "Show _MENU_ records",
                    "sInfo":         "Showing _START_ to _END_ of _TOTAL_ records",
                    "sInfoFiltered": "(filtered1 from _MAX_ total records)",
                    "sZeroRecords":  "No matching records found",
                    'sSearchPlaceholder':'Search:',
                    //processing: "<div id='divloader'></div>",
                },
                //responsive: true,
                info:true,
                searching: false,
                lengthMenu: [[3,5,10, 20,50, 100, 200, -1], [3,5,10, 20,50, 100, 200, "ALL"]],
                serverSide: true,
                processing: true,
                select: true,
                ajax: {
                    url: '{{URL::route('datatable.listInStock')}}',
                    type: 'POST',
                    beforeSend:function(){
                    },
                    data: function ( d ) {
                        d._token = '{{csrf_token()}}';
                        d.inv_no = $('#staticInvoice').val();
                        d.name1 = $('#staticUser').val();
                        d.po = $('#staticPO').val();
                        d.remark = $('#staticRemark').val();
                        d.dateFrom = $('#date-from').val();
                       d.dateTo = $('#date-to').val();



                    },
                    complete: function (data) {

                    },
                    error: function (xhr, error, thrown) {
                        $("#divloader").hide();
                    }
                },
                "initComplete":function( settings, data){

                },
                columns: [
                    {
                        "data": "id" ,
                        "name": "id",
                        "className":"text-left"

                    },
                    {
                        "data": "name",
                        "name": "name",
                        "className":"text-center"
                    },
                    {
                        "data": "inv_no" ,
                        "name": "inv_no",
                        "className":"text-center"
                    },
                    {
                        "data": "po_no" ,
                        "name": "po_no",
                        "className":"text-left"
                    },


                    {
                        "data": "in_date" ,
                        "name": "in_date",
                        "className":"text-left"
                    },
                    {
                        "data": "remark" ,
                        "name": "remark",
                        "className":"text-center"
                    },
                    {
                        "data":{
                            'id':'id',
                            'status_key':'status_key',
                        } ,
                        "name": "action",
                        "className":"text-center",
                        "width":"105px",
                        orderable: false,
                        "render":function (data) {
                            var result=``;
                            result+=`<div class="btn-group">`;
                            result+=` <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions<i class="fa fa-angle-down"></i> </button>`;
                            result+=` <ul class="dropdown-menu pull-left" role="menu">`;
                            result+=` <li> <a data-toggle="modal" data-target="#large" href="/fmv/public/admin/stock-modal/detail/`+data.id+`"><i class="fa fa-file-pdf-o"></i> Show </a> </li>`;
                            result+=` @if (Auth::user()->group_id==1)`;
                            result+=`<li> <a href="/fmv/public/getinstock/`+data.id+`"> <i class="fa fa-file-pdf-o"></i> Edit Instock </a></li>`;
                            result+=` <li> <a  href="/fmv/public/admin/instock/delete/`+data.id+`" onclick="return confirm('Are you sure to delete totally this instock ?')"><i  class="fa fa-file-pdf-o"></i> Delete Instock </a></li>`;
                            result+=`@endif`;
                            result+=`<li><a href="/fmv/public/admin/barcode/`+data.id+`"> <i class="fa fa-file-pdf-o"></i> Print QRcode1</a></li>`;
                            result+=`</ul>`;
                            result+=`</div>`;
                            return result;
                        }
                    }


                ],
                drawCallback : function() {
                    if($('#phone-list tbody .dataTables_empty').length){
                        $('#phone-list tbody tr').hide()
                    }
                    var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
                    pagination.toggle(this.api().page.info().pages > 1);
                },
                deferRender: true,
            } );

            $(document).on('keyup',function () {
                example.ajax.reload();
            })
            $(document).on('click','#clear-input',function () {
                $("#staticUser").val("");
                $("#staticInvoice").val("");
                $("#staticPO").val("");
                $("#staticRemark").val("");

            })
           


        } );
    </script>

@endsection