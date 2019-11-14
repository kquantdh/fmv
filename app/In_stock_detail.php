<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class In_stock_detail extends Model
{
    protected $table='in_stock_details';
    public function in_stock(){
    	return $this->belongsTo('App\In_stock', 'in_stock_id', 'id');
    }

    public function part_price_list(){
    	return $this->belongsTo('App\Part_price_list', 'part_id', 'id');
    }
    public static function searchAndList($partNo,$part_name,$belongto,$barcode,$location,$balance,$inv_no,$po_no,$detail_stk,$compare,$start, $length,$column, $sort)
    {

        $query = In_stock_detail::select('*')
            ->join('in_stocks','in_stock_details.in_stock_id','=','in_stocks.id')
            ->where('in_stock_details.is_deleted', '=',0);

        if(!empty($partNo)) {
            $query->where('part_id', 'like', '%' . $partNo . '%');
        }
        if(!empty($part_name)) {
            $query->where('part_name', 'like', '%' . $part_name . '%');
        }
        if(!empty($belongto)) {
            $query->where('belongto', 'like', '%' . $belongto . '%');
        }
        if(!empty($barcode)) {
            $query->where('barcode', 'like', '%' . $barcode . '%');
        }
        if(!empty($location)) {
            $query->where('location', 'like', '%' . $location . '%');
        }
        if($balance=="zero") {
            $query->where('balance', '=', 0);
        }
        if($compare=='diff') {
            $query->whereColumn('in_stock_details.qty', '!=', 'in_stock_details.balance');
        }
        if(!empty($inv_no)) {
            $query->where('inv_no', 'like', '%' . $inv_no . '%');
        }
        if(!empty($po_no)) {
            $query->where('po_no', 'like', '%' . $po_no . '%');
        }
        if(!empty($detail_stk)) {
            $query->where('detail_stk', 'like', '%' . $detail_stk . '%');
        }
        return [
            'count_record' => $query->count(),
            'record' => $query->take(1000)->orderBy($column, $sort)->skip($start)->take($length)->get()
        ];
    }
    
}
