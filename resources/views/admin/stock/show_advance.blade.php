@extends('layouts.admin')
@section('title')All stock @endsection
@section('content')
<div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Detail:</h4>
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
                        <span class="caption-subject bold uppercase"> All stock </span>
                    </div>
                </div>
                <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Alert when success or fail -->
                                    @if(Session::has('success'))
                                        <div class="alert alert-info">
                                            <i class="fa fa-folder-open"></i>
                                            <b>{{Session::get('success')}}</b>
                                        </div>
                                    @elseif(Session::has('fail'))
                                        <div class="alert alert-warning red">
                                            <b>{{ Session::get('fail') }}</b>
                                        </div>
                                @else
                                @endif
                                <!--Alert when success or fail-->
                                </div>
                            </div>


                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="example1">
                        <thead>
                        <tr>
                            <th> No </th>
                            <th > Part No </th>
                            <th > Part Name </th>
                            <th > Belong to </th>
                            <th > Barcode </th>
                            <th > Location </th>
                            <th> Balance </th>
                            <th >Quantity </th>
                            <th> Invoice</th>
                            <th> PO</th>
                            <th> Detail</th>
                            <th> Thumbnail</th>
                            <th> Action</th>
                        </tr>
                        <form class="form-inline" style="padding-bottom: 10px">
                            <tr role="row" class="filter">
                                <td> </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" id="staticPartNo"> </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" id="staticPartName"></td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" id="staticBelongto"></td>
                               <!-- <td>
                                    <select name="order_status" id="staticBelongto" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="1FMV">1FMV</option>
                                        <option value="1FMA">1FMA</option>
                                        <option value="1FMMC">1FMMC</option>
                                        <option value="1HCM">1HCM</option>
                                        <option value="1LOAN">1LOAN</option>
                                        <option value="1FOC">1FOC</option>
                                        <option value="2FMV">2FMV</option>
                                        <option value="2FMA">2FMA</option>
                                        <option value="2FMMC">2FMMC</option>
                                        <option value="2HCM">2HCM</option>
                                        <option value="2LOAN">2LOAN</option>
                                        <option value="2FOC">2FOC</option>
                                        <option value="OTHER">OTHER</option>
                                    </select>
                                </td>-->
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" id="staticBarcode">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" id="staticLocation">
                                </td>
                                <td>
                                    <input type="checkbox" class="form-control form-filter input-sm"  value="zero" id="staticBalance">
                                </td>
                                <td>
                                    <input type="checkbox" class="form-control form-filter input-sm" value="diff" id="staticCompare">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm"  id="staticInvoice">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" id="staticPO">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" id="staticDetailSTK">
                                </td>
                                <td></td>
                                <td>

                                    <a class="btn btn-sm red btn-outline filter-cancel"id="clear-input">
                                        <i class="fa fa-times"></i> Reset</a>
                                </td>


                            </tr>
                        </form>
                        </thead>

                        <tbody>

                        </tbody>
                                <tfoot>

                                </tfoot>
                    </table>

                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
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
        $(document).ready(function() {
            var example = $('#example1').DataTable( {
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
                responsive: true,
                info:true,
                searching: false,
                lengthMenu: [[3,5,10, 20,50, 100, 200, -1], [3,5,10, 20,50, 100, 200, "ALL"]],
                serverSide: true,
                processing: true,
                select: true,
                ajax: {
                    url: '{{URL::route('datatable.listStock')}}',
                    type: 'POST',
                    beforeSend:function(){
                    },
                    data: function ( d ) {
                        d._token = '{{csrf_token()}}';
                        d.partNo = $('#staticPartNo').val();
                        d.part_name = $('#staticPartName').val();
                       // d.belongto = $('#staticBelongto option:selected').val();
                        d.belongto = $('#staticBelongto').val();
                        d.barcode = $('#staticBarcode').val();
                        d.location = $('#staticLocation').val();
                        d.balance = $('#staticBalance:checked').val();
                        d.compare = $('#staticCompare:checked').val();
                        d.inv_no = $('#staticInvoice').val();
                        d.po_no = $('#staticPO').val();
                        d.detail_stk = $('#staticDetailSTK').val();


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
                        "data": "number" ,
                        "name": "number",
                        "className":"text-center"
                    },
                    {
                        "data": "part_id" ,
                        "name": "part_id",
                        "className":"text-center"
                    },
                    {
                        "data": "part_name" ,
                        "name": "part_name",
                        "className":"text-center"
                    },
                    {
                        "data": "belongto" ,
                        "name": "belongto",
                        "className":"text-left"
                    },
                    {
                        "data": "barcode" ,
                        "name": "barcode",
                        "className":"text-center"
                    },

                    {
                        "data": "location" ,
                        "name": "location",
                        "className":"text-left"
                    },
                    {
                        "data": "balance" ,
                        "name": "balance",
                        "className":"text-center",
                        "render":function (data) {
                            var result='';
                            if (data==0) {
                                      result='<span class="btn btn-danger btn-xs">'+data+'</span>';
                            } else if(data==1){
                                result='<span class="btn btn-warning btn-xs">'+data+'</span>';
                            }else{
                                result='<span class="btn btn-success btn-xs">'+data+'</span>';
                            }
                            return result;
                        }
                    },
                    {
                        "data": "qty" ,
                        "name": "qty",
                        "className":"text-left"
                    },
                    {
                        "data": "inv_no" ,
                        "name": "inv_no",
                        "className":"text-left"
                    },
                    {
                        "data": "po_no" ,
                        "name": "po_no",
                        "className":"text-left"
                    },
                    {
                        "data": "detail_stk" ,
                        "name": "detail_stk",
                        "className":"text-left"
                    },
                    {
                        "data": "thumbnail" ,
                        "name": "thumbnail",
                        "className":"text-center",
                        orderable: false,
                        "render":function (data) {
                            return '<img width="80px"  height="80px" alt="No Image" src="../uploads/product/'+data+'"/>';
                        }
                    },
                    {
                        "data":{
                            'id':'id',
                            'status_key':'status_key',
                            'barcode':'barcode'
                        } ,
                        "name": "action",
                        "className":"text-center",
                        "width":"105px",
                        orderable: false,
                        "render":function (data) {
                            var result='';
                            result+='<button style="width: 70px" class="btn btn-xs green dropdown-toggle" data-toggle="modal" data-target="#large" class="btn btn-primary" href="/fmv/public/admin/stock/detail/'+data.barcode+'">Show</button>';
                            result+='<a style="width: 70px" class="btn btn-xs green dropdown-toggle" href="one-barcode/'+data.barcode+'">QRcode</a>';
                            result+='<a style="width: 70px"  class="btn btn-xs green dropdown-toggle"class="btn btn-xs green dropdown-toggle"  data-target="#large" href="/fmv/public/admin/stock/detail_all/'+data.barcode+'">Show All</a>';
                            result+='<a style="width: 70px"  class="btn btn-xs green dropdown-toggle"class="btn btn-xs green dropdown-toggle"  data-target="#large" href="/fmv/public/admin/stock/thumbnail/'+data.barcode+'">Thumbnail</a>';
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

                $('#staticBalance').attr('checked', false);
                $('#staticCompare').attr('checked', false);
                $("#staticPartNo").val("");
                $("#staticPartName").val("");
                $("#staticBelongto").val("");
                $("#staticBarcode").val("");
                $("#staticLocation").val("");
                $("#staticInvoice").val("");
                $("#staticPO").val("");
                $("#staticDetailSTK").val("");





            })





        } );
    </script>

@endsection