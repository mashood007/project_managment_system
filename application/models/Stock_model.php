<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model {

	public function __construct()
 	{
 		parent::__construct();
  		$this->load->model(array(
 			'invoice/temp_purchase_model',
 			'invoice/purchase_return_model',
 			'invoice/tempsales_model',
 			'invoice/tempsalesreturn_model'
 		)); 		
 	}


 	public function stock($product)
 	{

 		$purchase = $this->purchase($product);
 		$sales = $this->sales($product);
 		return $purchase + $sales;
 	}

 	public function purchase($product, $period='')
 	{
  		$purchase_stock = $this->purchaseStock($product, $period);
 		$purchase_return_stock = $this->purchaseReturnStock($product, $period);

 		$purchased_stock = $purchase_stock['purchase_count'] - $purchase_return_stock['purchase_return_count'];
 		$purchased_amount = $purchase_stock['purchase_amount'] - $purchase_return_stock['purchase_return_amount'];
 		return array('purchase_count' => $purchased_stock,  'purchase_amount' => $purchased_amount);		
 	}

 	public function sales($product, $period= '')
 	{
  		$sale_stock = $this->saleStock($product, $period);
 		$sale_return_stock = $this->saleReturnStock($product, $period);

 		$saled_stock = $sale_stock['sale_count'] - $sale_return_stock['sale_return_count'];
 		$saled_amount = $sale_stock['sale_amount'] - $sale_return_stock['sale_return_amount'];		
 		return array('saled_stock' => $saled_stock, 'saled_amount' => $saled_amount );
 	}



 	public function purchaseStock($product, $period)
 	{
 		if ($period == '')
 		{
 			$purchase_in_base =  $this->temp_purchase_model->itemCount($product['id'], $product['base_unit_id']);
			$purchase_in_secondary =  $this->temp_purchase_model->itemCount($product['id'], $product['secondary_unit_id']);
		}
		elseif ($period == 'yearly') {
 			$purchase_in_base =  $this->temp_purchase_model->itemYearlyCount($product['id'], $product['base_unit_id']);
			$purchase_in_secondary =  $this->temp_purchase_model->itemYearlyCount($product['id'], $product['secondary_unit_id']);
		}
		elseif ($period == 'monthly') {
 			$purchase_in_base =  $this->temp_purchase_model->itemMonthlyCount($product['id'], $product['base_unit_id']);
			$purchase_in_secondary =  $this->temp_purchase_model->itemMonthlyCount($product['id'], $product['secondary_unit_id']);
		}
		$item_purchase_count = ($purchase_in_base->stock_in_qty) + ($purchase_in_secondary->stock_in_qty / $product['convertional_rate']);
		$item_purchase_amount = $purchase_in_base->stock_in_price + $purchase_in_secondary->stock_in_price;

		 return array('purchase_count' => $item_purchase_count , 'purchase_amount' => $item_purchase_amount);		
 	}


 	public function purchaseReturnStock($product, $period )
 	{
 		if ($period == '')
 		{
 			$purchase_in_base =  $this->purchase_return_model->itemCount($product['id'], $product['base_unit_id']);
			$purchase_in_secondary =  $this->purchase_return_model->itemCount($product['id'], $product['secondary_unit_id']);
		}
		elseif ($period == 'yearly') {
 			$purchase_in_base =  $this->purchase_return_model->itemYearlyCount($product['id'], $product['base_unit_id']);
			$purchase_in_secondary =  $this->purchase_return_model->itemYearlyCount($product['id'], $product['secondary_unit_id']);			
		}
		elseif ($period == 'monthly') {
 			$purchase_in_base =  $this->purchase_return_model->itemMonthlyCount($product['id'], $product['base_unit_id']);
			$purchase_in_secondary =  $this->purchase_return_model->itemMonthlyCount($product['id'], $product['secondary_unit_id']);
		}

		$item_purchase_count = ($purchase_in_base->stock_in_qty) + ($purchase_in_secondary->stock_in_qty / $product['convertional_rate']);
		$item_purchase_amount = $purchase_in_base->stock_in_price + $purchase_in_secondary->stock_in_price;

		 return array('purchase_return_count' => $item_purchase_count , 'purchase_return_amount' => $item_purchase_amount);
 	}


 	public function saleStock($product, $period = '')
 	{
 		if ($period = '')
 		{
 			$purchase_in_base =  $this->tempsales_model->itemCount($product['id'], $product['base_unit_id']);
			$purchase_in_secondary =  $this->tempsales_model->itemCount($product['id'], $product['secondary_unit_id']);
		}
		elseif ($period = 'yearly') {
 			$purchase_in_base =  $this->tempsales_model->itemYearlyCount($product['id'], $product['base_unit_id']);
			$purchase_in_secondary =  $this->tempsales_model->itemYearlyCount($product['id'], $product['secondary_unit_id']);
		}
		elseif ($period = 'monthly') {
 			$purchase_in_base =  $this->tempsales_model->itemMonthlyCount($product['id'], $product['base_unit_id']);
			$purchase_in_secondary =  $this->tempsales_model->itemMonthlyCount($product['id'], $product['secondary_unit_id']);
		}
		$item_purchase_count = ($purchase_in_base->stock_in_qty) + ($purchase_in_secondary->stock_in_qty / $product['convertional_rate']);
		$item_purchase_amount = $purchase_in_base->stock_in_price + $purchase_in_secondary->stock_in_price;

		 return array('sale_count' => $item_purchase_count , 'sale_amount' => $item_purchase_amount);		
 	}

 	public function saleReturnStock($product, $period = '')
 	{


 		if ($period = '')
 		{
 		$purchase_in_base =  $this->tempsalesreturn_model->itemCount($product['id'], $product['base_unit_id']);
		$purchase_in_secondary =  $this->tempsalesreturn_model->itemCount($product['id'], $product['secondary_unit_id']);
		}
		elseif ($period = 'yearly') {
 		$purchase_in_base =  $this->tempsalesreturn_model->itemCount($product['id'], $product['base_unit_id']);
		$purchase_in_secondary =  $this->tempsalesreturn_model->itemCount($product['id'], $product['secondary_unit_id']);
		}
		elseif ($period = 'monthly') {
 		$purchase_in_base =  $this->tempsalesreturn_model->itemCount($product['id'], $product['base_unit_id']);
		$purchase_in_secondary =  $this->tempsalesreturn_model->itemCount($product['id'], $product['secondary_unit_id']);
		}


		$item_purchase_count = ($purchase_in_base->stock_in_qty) + ($purchase_in_secondary->stock_in_qty / $product['convertional_rate']);
		$item_purchase_amount = $purchase_in_base->stock_in_price + $purchase_in_secondary->stock_in_price;

		 return array('sale_return_count' => $item_purchase_count , 'sale_return_amount' => $item_purchase_amount);		
 	}

 }
 ?>