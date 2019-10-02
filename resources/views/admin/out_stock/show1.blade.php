@extends('layouts.admin')
@section('title') Out and Return Stock @endsection
@section('content')
    <div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

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
                                    <span class="caption-subject bold uppercase"> Out and Return stock</span>
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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="btn-group">
                                                <a href="{{ url('admin/outstock/reset_create') }}" id="sample_editable_1_2_new" class="btn sbold green"> Add New
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                       <!-- <div class="col-md-6">
                                            {!! Form::open(['method'=>'GET','url'=>'admin/outstock']) !!}
                                                {!!Form::label('sample_file','Typing :',['class'=>'col-md-3'])!!}
                                                {!! Form::text('keyword',null,["id"=>"input-text1"]) !!}
                                               {!! Form::submit('Search',["id"=>"input-bt",'class'=>'btn sbold green']) !!}
                                            {!! Form::close() !!}
                                        </div>    -->
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
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="example3">
                                    <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> User Out</th>
                                        <th> User Return</th>
                                        <th> Part Out No</th>  
                                        <th> Date Out</th>
                                        <th> Remain Date</th>
                                        <th> Customer</th>
                                        <th> Type Form</th>
                                        <th> Status</th>
                                        <th > Change status</th>
                                        <th> Actions </th>
                                    </tr>
                                    <form class="form-inline" style="padding-bottom: 10px">
                                        <tr role="row" class="filter">
                                            <td> </td>
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" id="staticUserOut">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" id="staticUserReturn">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" id="staticPartOutNo">
                                            </td>
                                            <td> </td>


                                            <td> </td>
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" id="staticCustomer">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" id="staticTypeForm">
                                            </td>

                                             <td>
                                                 <select name="order_status" id="staticStatus" class="form-control form-filter input-sm">
                                                     @foreach(config('constant.status') as $k=>$v)';
                                                     <option value="{{$k}}">{{$v}} </option>
                                                     @endforeach
                                                     <option value="" selected>Alll </option>
                                                 </select>

                                             </td>
                                            <td></td>
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
            var example = $('#example3').DataTable( {
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
                lengthMenu: [[10, 20,50, 100, 200, -1], [10, 20,50, 100, 200, "ALL"]],
                serverSide: true,
                processing: true,
                select: true,
                ajax: {
                    url: '{{URL::route('datatable.listOutStock')}}',
                    type: 'POST',
                    deferRender: true,
                    beforeSend:function(){
                    },
                    data: function ( d ) {
                        d._token = '{{csrf_token()}}';
                        d.userOut = $('#staticUserOut').val();
                        d.userReturn = $('#staticUserReturn').val();
                        d.partOutNo = $('#staticPartOutNo').val();
                        d.customer = $('#staticCustomer').val();
                        d.typeForm = $('#staticTypeForm').val();
                        d.status = $('#staticStatus option:selected').val();
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
                        orderable: false,
                        "className":"text-center"

                    },
                    {
                        "data": "user_name",
                        "name": "user_name",
                        "className":"text-center"
                    },
                    {
                        "data": "return_user_name",
                        "name": "return_user_name",
                        "className":"text-center"
                    },
                    {
                        "data":"id",
                        "name": "id",
                        "className":"text-center",
                        "width":"105px",
                        "render":function (data) {
                            var str = '' + data + '';
                            var pad = 'PR0000';
                            return pad.substring(0, pad.length - str.length) + str;
                        }
                    },
                    {
                        "data": "out_date" ,
                        "name": "out_date",
                        "className":"text-center",
                        "width":"90px",
                        "render":function (data) {
                            d=new Date(''+data+'');
                            formatted_date = d.getDate() + "-" + (d.getMonth() + 1) + "-" +d.getFullYear() ;
                            return formatted_date;
                        }

                    },
                    {
                        "data":{
                            'id':'id',
                            'status_key':'status_key',
                        } ,
                        "name": "remain_date",
                        "className":"text-center",
                        "width":"105px",
                        "render":function (data) {
                            if (data.status==5) {
                                result='<span class="btn btn-success btn-xs">N/A</span>';
                                return result;
                            }else {
                                a= new Date();
                                n = a.getTime();
                                d=new Date(''+data.out_date+'');
                                m=d.getTime();
                                x=(n-m)/(24*60*60*1000);
                                y=data.loan_date_no-Math.round(x);
                                return y;
                            }
                        }
                    },
                    {
                        "data": "customer_name" ,
                        "name": "customer_name",
                        "className":"text-center"
                    },
                    {
                        "data": "type_form" ,
                        "name": "type_form",
                        "className":"text-center"
                    },
                    {
                        "data": "status" ,
                        "name": "status",
                        "className":"text-center",
                        orderable: false,
                        "render":function (data) {
                            var result='';
                            if (data==3) {
                                result='<span class="btn btn-danger btn-xs">Processing</span>';
                            } else if(data==4) {
                                result='<span class="btn btn-warning btn-xs">Take out</span>';
                            }else {
                                result='<span class="btn btn-success btn-xs">Returned</span>';
                            }
                            return result;

                        }
                    },

                    {
                        "data":{
                            'id':'id',
                            'status':'status',

                        } ,
                        "name": "change_status",
                        "className":"text-left",
                        "width":"105px",
                        orderable: false,
                        "render":function (data) {
                            var result='';
                            result+='<select name="status" id="status-'+data.id+'" class="form-control">';
                            result+='@foreach(config('constant.status') as $k=>$v)';
                            if(data.status=="{{$k}}"){
                                result+='<option value="{{$k}}" selected>{{$v}}</option>';
                            }
                            else{
                                result+='<option value="{{$k}}">{{$v}} </option>';
                            }
                            result+='@endforeach';
                            result+='</select>';
                            result+='<button class="btn btn-success btn-sm change-status" data-id=' + data.id + '>Apply</button>';

                            return result;


                        }
                    },
                    {
                        "data":{
                            'id':'id',
                            'status_key':'status_key',
                            'phone':'phone'
                        } ,
                        "name": "action",
                        "className":"text-center",
                        "width":"105px",
                        orderable: false,
                        "render":function (data) {
                            var result='';
                            result+='<div class="btn-group">';
                            result+=' <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions<i class="fa fa-angle-down"></i></button>';
                            result+=' <ul class="dropdown-menu pull-left" role="menu">';
                            result+='  <li><a data-toggle="modal" data-target="#large" href="/fmv/public/admin/out-and-return-stock-detail/detail/'+data.id+'"><i class="fa fa-file-pdf-o"></i> Show </a></li>';
                            if(data.status == 3){
                                result+='  <li><a href="/fmv/public/getoutstock/'+data.id+'"><i class="fa fa-file-pdf-o"></i> Edit Outstock </a></li>';
                            }
                            result+=' <li><a href="/fmv/public/admin/outstock/delete/'+data.id+'"><i class="fa fa-file-pdf-o"></i> Delete Outstock </a></li>';
                            result+=' <li><a href="/fmv/public/admin/outstock/out_stock_pdf/'+data.id+'"><i class="fa fa-file-pdf-o"></i> Print Out Stock  </a></li>';
                            result+='</ul>';
                            result+='</div>';
                            return result;

                        }
                    },


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
                $("#staticUserOut").val("");
                $("#staticUserReturn").val("");
                $("#staticPartOutNo").val("");
                $("#staticCustomer").val("");

                $("#staticTypeForm").val("");


            })
               $(document).on('click', '.change-status', function () {
                     var id = $(this).data('id');
                     var status = $('#status-'+id+' option:selected').val();
//                    var param = $('#status option:selected').map(function() {return this.value;
//                    }).get().join(",");
//                    console.log(this.value);
//                    if (param=='') {
//                        alert(' you can not change status!');
//                        return;
//                    }

                    var check = confirm("Are you sure to change status?");
                    if (check == true) {
                        $.ajax({
                            url: '{{URL::route('outstock.change_status')}}',
                            type: 'post',
                            data: {
                                id: id,
                                param: status
                            },
                            success: function (result) {
                                alert(result.message);
                                example.ajax.reload();
                            },
                            error: function (error) {
                                console.log("error", error);
                                alert('Change status fail!');
                            }
                        })
                    }



                });





        } );
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


    </script>

@endsection