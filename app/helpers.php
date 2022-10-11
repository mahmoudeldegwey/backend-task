<?php 

use App\Models\MenuItem;

function get_all_menu_items($select = []){
	return MenuItem::select($select)->get();
}

function calculate_total_price_menu_items($ids){
	return MenuItem::whereIn('id',$ids)->sum('price');
}

function generate_order_number(){
	//y => A two digit representation of a year - d => The day of the month (from 01 to 31) 
	//h => hour - m => month number - s => Seconds, with leading zeros
	return 'ORD-'.date("yd-hms"); 
}