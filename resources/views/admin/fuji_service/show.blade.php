@extends('layouts.admin')
@section('title') FMV JOB MANAGEMENT @endsection
@section('content')
  
       

                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption font-dark">
                                    <i class="icon-settings font-dark"></i>
                                    <span class="caption-subject bold uppercase"> FMV Head Repair History</span>
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
                                                <a href="{{ url('admin/fujiservice/create') }}" id="sample_editable_1_2_new" class="btn sbold green"> Add New
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <div class="btn-group pull-right">
                                                <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-print"></i> Print </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('admin/fujiservice/report/') }}">
                                                            <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
                                    <thead>
                                    <tr>
                                        <th>
                                           
                                        </th>
                                        <th> HRR No </th>
                                        <th> Cust. </th>
                                        <th> Quotion</th>
                                        <th> PO</th>
                                        <th> SR No </th>
                                        <th> Invoice</th>                                          
                                        <th> Machine </th> 
                                        <th> Serial</th>
                                        <th> Type SR </th>
                                        <th> Status </th>                   
                                        <th> Actions </th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th> </th>
                                        <th> </th>
                                        <th> </th>
                                        <th> </th>
                                        <th> </th>
                                        <th> </th>
                                        <th> </th>
                                        <th> </th>
                                        <th> </th>
                                        <th> </th>
                                        <th> </th>
                                        <th> </th>
                                        
                                    </tr>
                                    </tfoot>
                                    <tbody>

                                    @if(isset($fuji_services))
                                        @foreach($fuji_services as $item)
                                    <tr class="odd gradeX">
                                        <td>
                                            
                                        </td>
                                        <td> HRR18{{$item->id}} </td>
                                        <td class="center"> {{$item->customer->name}}  </td>
                                        <td>{{$item->quotation}}</td>
                                        <td>{{$item->po}}</td>
                                        <td>{{$item->sr_no}}</td>
                                        <td>{{$item->invoice}}</td>                                        
                                        <td class="center"> {{$item->head_type->name}} </td>                                        
                                        <td class="center"> {{$item->head_serial}}</td>
                                        <td class="center"> {{$item->nature_service}} </td>
                                        @switch($item->status)
                                        @case('Stock Recieve')
                                        <td>
                                            <span class="label label-sm label-danger">{{$item->status}} </span>
                                        </td>
                                        @break
                                           @case('Start Inspection')
                                            <td>
                                                <span class="label label-sm label-warning">{{$item->status}} </span>
                                            </td>
                                        @break
                                        @default('Start Inspection')
                                            <td>
                                                <span class="label label-sm label-success">{{$item->status}} </span>
                                            </td>
                                        @break
                                        @case('Repair Done')
                                        <td>
                                            <span class="label label-sm label-info">{{$item->status}} </span>
                                        </td>
                                        @break
                                        @case('Delivery')
                                        <td>
                                            <span class="label label-sm label-info">{{$item->status}} </span>
                                        </td>
                                        @break
                                        @endswitch

                                        
                                        <td>

                                            <div class="btn-group">
                                                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu pull-left" role="menu">
                                                    <li>
                                                        <a href="{{url('admin/fujiservice/create/edit/'.$item->id)}}">
                                                            <i class="fa fa-file-pdf-o"></i> Edit </a>

                                                    </li>
                                                    <li>
                                                        <a href="{{url('admin/fujiservice/delete/'.$item->id)}}">
                                                            <i class="fa fa-file-pdf-o"></i> Delete </a>
                                                    </li>
                                                    <li>
                                                        
                                                        <a href="{{ url('admin/fujiservice/service-report/'.$item->id) }}">
                                                            <i class="fa fa-file-pdf-o"></i> SR Report</a>
                                                    </li>
                                                    
                                                    <li>
                                                        <a href="{{ url('admin/fujiservice/head-repair-report/'.$item->id) }}">
                                                            <i class="fa fa-file-pdf-o"></i> HR Report</a>
                                                    </li>
                                                   
                                                  
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                        @endforeach

                                    @endif


                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>

         
  

@endsection