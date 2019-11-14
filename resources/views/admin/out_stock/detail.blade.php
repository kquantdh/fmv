
<div class="portlet-body">
        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="">
            <thead>
            <tr>
                <th> No</th>
                <th> Part out No</th>
                <th> User out</th>
                <th > Part No </th>
                <th > Barcode </th>
                <th > Out Qty </th>
            </tr>
            </thead>
           
            <tbody>
                @if(isset($out_stock_details))
                @foreach($out_stock_details as $key=> $item)
                    <tr class="odd gradeX">
                        <td>{{$key+1}}</td>
                        <td>PR{{str_pad($item->out_stock_id, 4, '0',STR_PAD_LEFT)}}</td>
                        <td>{{$item->user->name}}</td>
                        <td>{{$item->in_stock_detail->part_id}}</td>
                        <td>{{$item->in_stock_detail->barcode}}</td>
                        <td>{{$item->out_quantity}}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
       
    </div>