<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cart;
use App\Fuji_service;
use App\Head_type;
use App\Customer;
use App\In_stock;
use App\In_stock_detail;
use App\Out_stock;
use App\Out_stock_detail;
use App\Part_price_list;
use App\Fuji_service_detail;
use App\Repositories\Phone\PhoneRepositoryInterface;

use Auth;
use Session;
use PDF;

class OutStockController extends Controller
{

    private $_cust=[];

    public function __construct(PhoneRepositoryInterface $phone)
    {

        $customers=Customer::all();
        foreach ($customers as $customer){
            $this->_cust[$customer->id]=$customer->name;
        }
        $this->phone = $phone;

    }
    public function  change_status1( Request $request)
    {
        $response = [];
        if (Auth::check()) {
            $id = $request->get('id', 0);
            $data['status'] = (int)$request->get('param');
            $out_stocks = Out_stock::find($id);
            $status_old = $out_stocks->status;
            $out_stock_details = Out_stock_detail::where('out_stock_id', $id)->get();
            $is_ok=0;
            foreach ($out_stock_details as $item){
                $temp_ = In_stock_detail::where('barcode', $item->barcode)->first();
                if ($temp_->balance< $item->out_quantity){
                    $is_ok=1;
                }
            }

            if ($data['status']==4 && $is_ok==0&& ($data['status'] - $status_old) == 1) {
                foreach ($out_stock_details as $item) {
                    $product = In_stock_detail::where('barcode', $item->barcode)->first();
                    $out_stock_details1 = Out_stock_detail::where('barcode', $item->barcode)->where('out_stock_id', $out_stocks->id)->first();
                    $product->balance = $product->balance - $item->out_quantity;
                    $out_stock_details1->status = $data['status'];
                    $product->save();
                    $out_stock_details1->save();
                }

                $out_stocks->status = $data['status'];
                $out_stocks->user_id = Auth::user()->id;
                $out_stocks->save();
                $response['status'] = 1;
                $response['message'] = 'Changed to take out successfull!';

            }elseif($data['status']==5 && ($data['status'] - $status_old) == 1 ){
                foreach ($out_stock_details as $item) {
                $product = In_stock_detail::where('barcode', $item->barcode)->first();
                $out_stock_details = Out_stock_detail::where('barcode', $item->barcode)->where('out_stock_id',$out_stocks->id)->first();
                $product->balance = $product->balance + $item->out_quantity;
                $out_stock_details->status =5;
                $product->save();
                $out_stock_details->save();
                }
                $out_stocks->status = $data['status'];
                $out_stocks->return_date = date('Y-m-d');
                $out_stocks->return_user_id = Auth::user()->id;
                $out_stocks->save();
                $response['status'] = 1;
                $response['message'] = 'Changed to returned successfull!';

            } else {
                $response['status'] = -1;
                $response['message'] = 'Error change status';
            }
        } else {
            $response['status'] = -1;
            $response['message'] = 'Please Log In';
        }

        return response()->json($response);

    }
   /*public function change_status($id, Request $request)
    {

        $out_stocks = Out_stock::findOrFail($id);
        $status_old = $out_stocks->status;
        $out_stocks->status = $request->status;
        $out_stock_details = Out_stock_detail::where('out_stock_id', $id)->get();
        $is_ok=0;
        foreach ($out_stock_details as $item){
            $temp_ = In_stock_detail::where('barcode', $item->barcode)->first();
            if ($temp_->balance< $item->out_quantity){
                $is_ok=1;
            }
        }



        foreach ($out_stock_details as $item) {
            if ($out_stocks->status == 4 && $out_stocks->status != $status_old && $status_old!=5&&$is_ok==0) {

                $product = In_stock_detail::where('barcode', $item->barcode)->first();
                $out_stock_details = Out_stock_detail::where('barcode', $item->barcode)->where('out_stock_id',$out_stocks->id)->first();
                $product->balance = $product->balance - $item->out_quantity;
                $out_stock_details->status =$request->status;
                $out_stocks = Out_stock::findOrFail($id);
                if (Auth::check()) {
                    $out_stocks->user_id = Auth::user()->id;
                } else {
                    $out_stocks->user_id = null;
                }
                $out_stocks->status = $request->status;
                Session::flash('success', 'Changed to take out successfull!');
                $out_stocks->save();
                $product->save();
                $out_stock_details->save();

            }elseif($out_stocks->status == 5 && $status_old  ==4 && Auth::user()->group_id==1 &&$out_stocks->type_form!='PR' ){
                $product = In_stock_detail::where('barcode', $item->barcode)->first();
                $out_stock_details = Out_stock_detail::where('barcode', $item->barcode)->where('out_stock_id',$out_stocks->id)->first();
                $product->balance = $product->balance + $item->out_quantity;
                $out_stock_details->status =5;
                $out_stocks = Out_stock::findOrFail($id);
                if (Auth::check()) {
                    $out_stocks->return_user_id = Auth::user()->id;
                } else {
                    $out_stocks->return_user_id = null;
                }

                $out_stocks->status = $request->status;
                $out_stocks->return_date = date('Y-m-d');
                $out_stocks->save();
                $product->save();
                $out_stock_details->save();
                Session::flash('success', 'Changed to returned successfull!');
            }else{
                Session::flash('fail', 'You can not change status. Please check quantity or status or access permission or type form PR!');
            }
        }
        return redirect('admin/outstock');
    }*/

    public function index1(Request $request){
        return view('admin.out_stock.show1');
    }
    public function  getOutStockList(Request $request)
    {
        $param = [];
        $param['status'] = ($request->has('status')) ? $request->get('status') : '';
        $param['userOut'] = ($request->has('userOut')) ? $request->get('userOut') : '';
        $param['userReturn'] = ($request->has('userReturn')) ? $request->get('userReturn') : '';
        $param['partOutNo'] = ($request->has('partOutNo')) ? $request->get('partOutNo') : '';
        $param['customer'] = ($request->has('customer')) ? $request->get('customer') : '';
        $param['typeForm'] = ($request->has('typeForm')) ? $request->get('typeForm') : '';
        $param['dateFrom'] = ($request->has('dateFrom')) ? date('Y-m-d', strtotime($request->get('dateFrom'))) : date('Y-m-d');
        $param['dateTo'] = ($request->has('dateTo')) ? date('Y-m-d', strtotime($request->get('dateTo'))) : date('Y-m-d');

        $column = $request->get("columns");
        $order = $request->get('order');
        $index=$order[0]["column"];
        $sort = $order[0]["dir"];
        $start = $request->get('start');
        $length = $request->get('length');
        $columnNameSort = $column[(int)$index]["name"];
        $data = [];
        $data['draw'] = (int)$request->get("draw", "int");
        $dataReport = Out_stock::searchAndList($param['status'],$param['userOut'],$param['userReturn'],$param['partOutNo'],$param['customer'],$param['typeForm'],$param['dateFrom'],$param['dateTo'],$start, $length, $columnNameSort, $sort);
        $data['recordsTotal'] = (int)$dataReport['count_record'];
        $data['recordsFiltered'] = (int)$dataReport['count_record'];
        $data['data'] = $dataReport['record']->toArray();
        return response()->json($data);
    }

        
    public function index(Request $request)
    {
        $limit = 10;
        $page = $request->get('page',1);
        $stt = ((int)$page-1)*$limit;
        $out_stocks=Out_stock::select('out_stocks.*')->join('users','out_stocks.user_id','=','users.id');
        $out_stocks->where('users.name','like','%'.$request->keyword.'%')
            ->orwhere('out_stocks.remark','like','%'.$request->keyword.'%');
                        
        $out_stocks=$out_stocks->orderBy('id', 'DESC')->paginate(10);
        
       
        return view('admin.out_stock.show',
            ['out_stocks'=>$out_stocks,
                'stt'=>$stt
                ]);
    }


    public function detail($id ,Request $request)
    {   
        $out_stock_details=Out_stock_detail::select('out_stock_details.*')
                                ->join('out_stocks','out_stock_details.out_stock_id','=','out_stocks.id');
                                $out_stock_details->where('out_stock_details.barcode',$id);
                                $out_stock_details->where('out_stock_details.status',4);
        $out_stock_details=$out_stock_details->orderBy('id', 'DESC')->paginate(10);
        return view('admin.out_stock.detail',
            ['out_stock_details'=>$out_stock_details]);
    }
    public function detailAll($id ,Request $request)
    {
        $out_stock_details=Out_stock_detail::select('out_stock_details.*')
            ->join('out_stocks','out_stock_details.out_stock_id','=','out_stocks.id')
            ->where('out_stock_details.barcode',$id)->where('out_stock_details.status','!=',3)->get();



        return view('admin.stock.detail_all',
            ['out_stock_details'=>$out_stock_details,]);
    }
    public function outAndReturnStockDetail($id ,Request $request)
    {
        $out_stocks=Out_stock::where('id', $id)->first();

        $out_stocks->save();

        $out_stock_details = Out_stock_detail::where('out_stock_id', $id)->get();




        return view('admin.out_stock.outAndReturnStockDetail',
            ['out_stock_details'=>$out_stock_details,
                'out_stocks'=>$out_stocks

            ]);
    }
    public function create(Request $request)
    {
        $limit = 5;
        $page = $request->get('page',1);
        $stt = ((int)$page-1)*$limit;

        $in_stock_details=In_stock_detail::select('in_stock_details.*')
                         ->join('in_stocks','in_stock_details.in_stock_id','=','in_stocks.id')
                         ->join('part_price_lists','in_stock_details.part_id','=','part_price_lists.id')
                          ->where('in_stock_details.is_deleted',0);
        if ($request->has('whetherBalance')){
            if(($request->whetherBalance)=='noBalance') {
                $in_stock_details->whereColumn('in_stock_details.qty', '!=', 'in_stock_details.balance');
            }elseif(($request->whetherBalance)=='balance'){
                $in_stock_details->whereColumn('in_stock_details.qty', '=', 'in_stock_details.balance');
            }else{

            }
        }


        if (($request->has('belongto'))){
            if(($request->belongto)=='FOC') {
                $in_stock_details->where('in_stock_details.belongto','=','WRR');
                $in_stock_details->orwhere('in_stock_details.belongto','=','FOC');
                $in_stock_details->orwhere('in_stock_details.belongto','=','ORD');
            }elseif (($request->belongto)=='LOAN'){
                $in_stock_details->where('in_stock_details.belongto','=','1FMV');
                $in_stock_details->orwhere('in_stock_details.belongto','=','1FMA');
                $in_stock_details->orwhere('in_stock_details.belongto','=','1FMMC');
                $in_stock_details->orwhere('in_stock_details.belongto','=','1HCM');
                $in_stock_details->orwhere('in_stock_details.belongto','=','2FMV');
                $in_stock_details->orwhere('in_stock_details.belongto','=','2FMA');
                $in_stock_details->orwhere('in_stock_details.belongto','=','2FMMC');
                $in_stock_details->orwhere('in_stock_details.belongto','=','2HCM');

            }
            else{
                $in_stock_details->where('in_stock_details.belongto','=',$request->belongto);
            }
        }

        if ($request->fieldChoose=='part_id'){
            $in_stock_details->where('part_price_lists.id','like','%'.$request->keyword1.'%')
            ;}
        if ($request->fieldChoose=='name'){
            $in_stock_details->where('part_price_lists.name','like','%'.$request->keyword1.'%')
            ;}
        if ($request->fieldChoose=='location'){
            $in_stock_details->where('in_stock_details.location','like','%'.$request->keyword2.'%')
            ;}
        if ($request->fieldChoose=='barcode'){
            $in_stock_details->where('in_stock_details.barcode','like','%'.$request->keyword1.'%')
            ;}
        if ($request->fieldChoose=='inv_no'){
            $in_stock_details->where('in_stocks.inv_no','like','%'.$request->keyword2.'%')
            ;}
        if ($request->fieldChoose=='po_no'){
            $in_stock_details->where('in_stocks.po_no','like','%'.$request->keyword2.'%')
            ;}

        $in_stock_details=$in_stock_details->orderBy('id', 'DESC')->paginate(5);
        return view('admin.out_stock.create',
            ['in_stock_details'=>$in_stock_details,
                'customers'=>$this->_cust,
                'stt'=>$stt
                ]);
    }
    public function outstock($id)
    {
        $array_tmp=array();
        $buy = In_stock_detail::where('barcode', $id)->first();
        foreach(Cart::instance('createOutstock')->content() as $item){
            array_push($array_tmp,$item->id);
        }
            $temp=$buy->barcode;
        if ($buy->balance <= 0) {
            Session::flash('out_of_stock', 'Part: "' . $buy->barcode. '"  only have remainning stock is: ' . $buy->balance . ' pcs!');
        
        }elseif(in_array( $temp,$array_tmp,true)) {
            Session::flash('out_of_stock', 'You clicked over 1 time for one part. Please choose other part!');
        }else {
            Cart::instance('createOutstock')->add(array('id' => $buy->barcode,
            'name' => $buy->part_name,
            'qty' => 1,
            'price' => 1,
    'options' => array(  'part_no'=>$buy->part_id,
            'rep_new'=>$buy->rep_new,
            'belongto'=>$buy->belongto,
            'location'=>$buy->location)));
        }          
        return redirect()->back();
    }
    public function editOutstock($id)
    {
        $array_tmp=array();
        $buy = In_stock_detail::where('barcode', $id)->first();
        foreach(Cart::instance('editOutstock')->content() as $item){
            array_push($array_tmp,$item->id);
        }
        $temp=$buy->barcode;
        if ($buy->balance <= 0) {
            Session::flash('out_of_stock', 'Part: "' . $buy->barcode. '"  only have remainning stock is: ' . $buy->balance . ' pcs!');

        }elseif(in_array( $temp,$array_tmp,true)) {
            Session::flash('out_of_stock', 'You clicked over 1 time for one part. Please choose other part!');
        }else {
            Cart::instance('editOutstock')->add(array('id' => $buy->barcode,
                'name' => $buy->part_name,
                'qty' => 1,
                'price' => 1,
                'options' => array(  'part_no'=>$buy->part_id,
                    'rep_new'=>$buy->rep_new,
                    'belongto'=>$buy->belongto,
                    'location'=>$buy->location)));
        }
        return redirect()->back();
    }

    public function getOutstock($id)
    {
        Cart::instance('editOutstock')->destroy();
        $out_stocks = Out_stock::where('id', $id)->first();  
        $list = Out_stock_detail::where('out_stock_id', $id)->get();
        foreach ($list as $buy){
            Cart::instance('editOutstock')->add(array('id' => $buy->barcode, 'name' => $buy->in_stock_detail->part_name, 'qty' =>$buy->out_quantity, 'price' => 1,
                'options' => array('part_no'=>$buy->in_stock_detail->part_id,
            'rep_new'=>$buy->rep_new,
            'belongto'=>$buy->belongto,
            'location'=>$buy->location)));
        }
        return redirect('admin/outstock/edit/'.$id);
    }
    public function resetCart()
    {
        Cart::instance('createOutstock')->destroy();

        return redirect('admin/outstock/create');
    }

    public function deleteoutstock($id)
    {
        $content = Cart::instance('createOutstock')->content();
        foreach ($content as $item) {
            if ($id == $item->id) {
                $rowId = $item->rowId;
                Cart::instance('createOutstock')->remove($rowId);
                break;
            }
        }

        return redirect('admin/outstock/create');
    }

    public function delete($id)
    {
        $out_stocks=Out_stock::findOrFail($id);
        $out_stocks->delete();
        $list1 = Out_stock_detail::where('out_stock_id', $id)->get();
        foreach ($list1 as $data){
            $data->delete();
        }
        return redirect('admin/outstock');
    }

    public function deleteoutstockEdit($id)
    {
        $content = Cart::instance('editOutstock')->content();
        foreach ($content as $item) {
            if ($id == $item->id) {
                $rowId = $item->rowId;
                Cart::instance('editOutstock')->remove($rowId);
                break;
            }
        }
        return redirect()->back();
    }
    public function deleteoutstockDetailEdit($id)
    {

        $list1 = Out_stock_detail::where('out_stock_id', $id)->get();
        foreach ($list1 as $data){
            $data->delete();
        }
        Cart::instance('editOutstock')->destroy();
        return redirect()->back();
    }

    public function updateCart(Request $request, $id)
    {
        //lấy về số lượng còn lại trong kho của sản phẩm này
       
         
        $prd = In_stock_detail::where('barcode', $id)->first();
        if ($prd->balance > 0 && $prd->balance >= $request->qty) {
            $content = Cart::instance('createOutstock')->content();
            foreach ($content as $item) {
                if ($id == $item->id) {
                    $rowId = $item->rowId;
                     Cart::instance('createOutstock')->update($rowId, ['qty' => $request->qty]);
                    break;
                }
            }
        } else {
            Session::flash('out_of_stock', 'Part: "' . $prd->barcode. '"  only have remainning stock is: ' . $prd->balance . ' pcs!');
        }
    

        return redirect()->back();
    }
    public function updateEditOutstock(Request $request, $id)
    {
        //lấy về số lượng còn lại trong kho của sản phẩm này
        $prd = In_stock_detail::where('barcode', $id)->first();
        if ($prd->balance > 0 && $prd->balance >= $request->qty) {
            $content = Cart::instance('editOutstock')->content();
            foreach ($content as $item) {
                if ($id == $item->id) {
                    $rowId = $item->rowId;
                     Cart::instance('editOutstock')->update($rowId, ['qty' => $request->qty]);
                    break;
                }
            }
        } else {
            Session::flash('out_of_stock', 'Part: "' . $prd->barcode . '"  only have remainning stock is: ' . $prd->balance . ' pcs!');
        }
            return redirect()->back();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'loan_date_no' => 'required|integer'
        ],
            [
                'required' => ':attribute  is not blank',
                'integer' => ':attribute must be integer number',
                'numeric' => ':attribute phải là số',
            ],

            [
                'loan_date_no' => 'Loan date amount ',
            ]);


            if (count(Cart::instance('createOutstock')->content()) > 0) {
                $ord = new Out_stock();
                if (Auth::check()) {
                    $ord->user_id = Auth::user()->id;
                    $ord->return_user_id = Auth::user()->id;
                } else {
                    $ord->user_id = null;
                }
                $ord->status=3;

                $ord->remark =$request->remark;
                $ord->out_date =  date('Y-m-d');
                $ord->return_date =  date('Y-m-d');
                $ord->customer_id =$request->customer_id;
                $ord->type_form =$request->type_form;
                $ord->loan_date_no =$request->loan_date_no;
                $ord->save();
                foreach (Cart::instance('createOutstock')->content() as $sp) {
                    $ordDetail = new Out_stock_detail();
                    $ordDetail->out_stock_id = $ord->id;
                    if (Auth::check()) {
                        $ordDetail->user_id = Auth::user()->id;
                    } else {
                        $ordDetail->user_id = null;
                    }
                    $ordDetail->barcode = $sp->id;
                    $ordDetail->out_quantity = $sp->qty;
                    $ordDetail->location = $sp->options->location;
                    $ordDetail->status =3;
                    $ordDetail->save();
                }
                $ord->save();
                Cart::instance('createOutstock')->destroy();
                Session::flash('success', 'Add new successfull!');
                return redirect('/admin/outstock');
            }else{
                Session::flash('fail', 'You can\'t create new part out because part out don\'t have part!');
                return redirect()->back();

            }



    }

    public function edit($id ,Request $request)
        {
        $limit = 5;
        $page = $request->get('page',1);
        $stt = ((int)$page-1)*$limit;

        $in_stock_details=In_stock_detail::select('in_stock_details.*')
                         ->join('in_stocks','in_stock_details.in_stock_id','=','in_stocks.id')
                         ->join('part_price_lists','in_stock_details.part_id','=','part_price_lists.id')
                         ->where('in_stock_details.is_deleted',0);
            if ($request->has('whetherBalance')){
                if(($request->whetherBalance)=='noBalance') {
                    $in_stock_details->whereColumn('in_stock_details.quantity', '!=', 'in_stock_details.balance');
                }elseif(($request->whetherBalance)=='balance'){
                    $in_stock_details->whereColumn('in_stock_details.quantity', '=', 'in_stock_details.balance');
                }else{

                }
            }


            if ($request->has('belongto')){
                if(($request->belongto)=='FOC') {

                    $in_stock_details->where('in_stock_details.belongto','=','WRR');
                    $in_stock_details->orwhere('in_stock_details.belongto','=','FOC');
                    $in_stock_details->orwhere('in_stock_details.belongto','=','ORD');
                }elseif (($request->belongto)=='LOAN'){
                    $in_stock_details->where('in_stock_details.belongto','=','1FMV');
                    $in_stock_details->orwhere('in_stock_details.belongto','=','1FMA');
                    $in_stock_details->orwhere('in_stock_details.belongto','=','1FMMC');
                    $in_stock_details->orwhere('in_stock_details.belongto','=','1HCM');
                    $in_stock_details->orwhere('in_stock_details.belongto','=','2FMV');
                    $in_stock_details->orwhere('in_stock_details.belongto','=','2FMA');
                    $in_stock_details->orwhere('in_stock_details.belongto','=','2FMMC');
                    $in_stock_details->orwhere('in_stock_details.belongto','=','2HCM');

                }
                else{
                    $in_stock_details->where('in_stock_details.belongto','=',$request->belongto);
                }
            }

            if ($request->fieldChoose=='part_id'){
                $in_stock_details->where('part_price_lists.id','like','%'.$request->keyword1.'%')
                ;}
            if ($request->fieldChoose=='name'){
                $in_stock_details->where('part_price_lists.name','like','%'.$request->keyword1.'%')
                ;}
            if ($request->fieldChoose=='location'){
                $in_stock_details->where('in_stock_details.location','like','%'.$request->keyword2.'%')
                ;}
            if ($request->fieldChoose=='barcode'){
                $in_stock_details->where('in_stock_details.barcode','like','%'.$request->keyword1.'%')
                ;}
            if ($request->fieldChoose=='inv_no'){
                $in_stock_details->where('in_stocks.inv_no','like','%'.$request->keyword2.'%')
                ;}
            if ($request->fieldChoose=='po_no'){
                $in_stock_details->where('in_stocks.po_no','like','%'.$request->keyword2.'%')
                ;}

            $in_stock_details=$in_stock_details->orderBy('id', 'DESC')->paginate(5);

        $out_stocks = Out_stock::where('id', $id)->first();
        $out_stocks->save();
        return view('admin.out_stock.edit',
            ['in_stock_details'=>$in_stock_details,
            'out_stocks' => $out_stocks,
                'customers'=>$this->_cust,
                'stt'=>$stt
                ]);
    }

    public function update(Request $request, $id){

        /*$this->validate($request, [
            'inv_no' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'short_description' => 'required',
            'description' => 'required',
            'discount' => 'numeric'
        ],
            [
                'required' => ':attribute  is not blank',
                'integer' => ':attribute phải là số nguyên',
                'numeric' => ':attribute phải là số',
            ],

            [
                'sr_no' => 'Service Report No ',
                'price' => 'Giá ',
                'thumbnail' => 'Ảnh đại diện ',
                'quantity' => 'Số lượng ',
                'short_description' => 'Mô tả ngắn ',
                'description' => 'Mô tả chi tiết',
                'discount' => 'Giảm giá'
            ]);*/

        $out_stocks = Out_stock::findOrFail($id);   
        if (Auth::check()) {
            $out_stocks->user_id = Auth::user()->id;
        } else {
            $out_stocks->user_id = null;
        }

        $out_stocks->customer_id =$request->customer_id;
        $out_stocks->type_form =$request->type_form;
      
        $out_stocks->remark =$request->remark;
        $out_stocks->loan_date_no =$request->loan_date_no;
        $out_stocks->save(); 
        $list1 = Out_stock_detail::where('out_stock_id', $id)->first();
        if (!$list1 ){
            foreach (Cart::instance('editOutstock')->content() as $sp) {
                $ordDetail = new Out_stock_detail();
                $ordDetail->out_stock_id = $out_stocks->id;
                if (Auth::check()) {
                    $ordDetail->user_id = Auth::user()->id;
                } else {
                    $ordDetail->user_id = null;
                }
                $ordDetail->barcode = $sp->id;
                $ordDetail->out_quantity = $sp->qty;
                $ordDetail->location = $sp->options->location;
                $ordDetail->status =3;
                $ordDetail->save();
            }
            Session::flash('success', 'Edit successfull111!');
            return redirect('/admin/outstock');
            $out_stocks->save();

        }else{
            $list1 = Out_stock_detail::where('out_stock_id', $id)->get();
        $array_tmp = array();
        foreach($list1 as $data1){
            $list1 = Out_stock_detail::where('out_stock_id', $id)->get();
            // sau khi lưu new part thì lay lại part tu  database de tranh save lap lại 2 barcode
            foreach ($list1 as $data){
                array_push($array_tmp,$data->barcode);
            }

          foreach (Cart::instance('editOutstock')->content() as $sp)
            {
                $value_data = $sp->id;
                if(in_array($value_data,$array_tmp,true)){ 
                    if(($data1->barcode)==($sp->id)){
                        if (Auth::check()) {
                            $data1->user_id = Auth::user()->id;
                        } else {
                            $data1->user_id = null;
                        }
                    $data1->barcode = $sp->id;
                    $data1->out_quantity = $sp->qty;
                    $data1->location = $sp->options->location;
                    $data1->update();    
                   }        
                }else{
                    $list = new Out_stock_detail();
                    $list->out_stock_id = $out_stocks->id;
                    if (Auth::check()) {
                        $list->user_id = Auth::user()->id;
                    } else {
                        $list->user_id = null;
                    }
                    $list->barcode = $sp->id;
                    $list->out_quantity = $sp->qty;
                    $list->location = $sp->options->location;
                    if(in_array($value_data,$array_tmp,true)){
                        Break;
                    }else{
                        $list->save();
                    }
                }
            }
         }

        Cart::instance('editOutstock')->destroy();
        Session::flash('success', 'Edit successfull!');
        return redirect('/admin/outstock');
        }
    }

    public function outStockPDF($id) 
    {
        $out_stock = Out_stock::where('id', $id)->first();
        $out_stock->save();
        $list=Out_stock_detail::where('out_stock_id', $id)->get();

        $pdf=PDF::loadView('admin.out_stock.out_stock_pdf',
                          ['out_stock'=>$out_stock,
                                  'list' => $list]);
        return $pdf->download('outStockPDF.pdf');
    
    }
    /*public function outStockPDF($id) 
    {
        $out_stock = Out_stock::where('id', $id)->first();
        $out_stock->save();
        $list = Out_stock_detail::where('out_stock_id', $id)->get();
          
        return view('admin.out_stock.out_stock_pdf',
            ['out_stock'=>$out_stock,'list' => $list
            
                ]);
    
    
    }*/


  



}
