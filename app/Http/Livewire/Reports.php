<?php

namespace App\Http\Livewire;
use Carbon\Carbon;
use Livewire\Component;

use App\Models\Inmate;
use App\Models\Transaction;
use App\Models\Invoice;
use App\Models\Inovicedetail;
use App\Models\Block;
use App\Models\Product;
use App\Models\Supplier;

class Reports extends Component
{
    public $reportDate;

    public $reportFrom;
    public $reportTo;

    public $fromFlag;
    public $toFlag;

    public $supplierViewFlag;
    public $productViewFlag;
    public $blockViewFlag;
    public $creditViewFlag;
    public $debitViewFlag;


    public $supplierWiseProducts;

    public $tempData;

    public $supplierSum;

    public $productSum;
    public $profitSum;
    public $productWise;

    public $blockWiseInmates;
    public $blockSum;

    public $blockCredits;
    public $creditSum;

    public $blockDebits;
    public $debitSum;

    public function render()
    {
        return view('livewire.reports');
    }

    public function supplierReport(){
        $this->supplierViewFlag = 1;
        $this->productViewFlag = 0;
        $this->blockViewFlag = 0;
        $this->creditViewFlag = 0;
        $this->debitViewFlag = 0;

        $this->getSupplierReportToday();

    }

    public function getSupplierReportToday(){
        $this->supplierSum = 0;
        $this->reportDate = Carbon::now();


        $suppliers = Supplier::get();
        $j=0;

        foreach ($suppliers as $supplier ) {
            $products  = Product::where('product_supplier_id',$supplier->id)->get();
            $salesAmount = 0;
            $i = 0;
            foreach ($products as $product ) {
               $invoiceDetails = Inovicedetail::where('invoicedetail_product_id',$product->id)
                                                ->whereDate('created_at',$this->reportDate)
                                                ->get();
                foreach ($invoiceDetails as $invoice ) {
                    $salesAmount += ((double)$invoice->invoicedetails_product_qty * (double)$product->product_price);
                }
            }
            $this->supplierWiseProducts[$j]["sales_amount"] = $salesAmount;
            $this->supplierWiseProducts[$j]["supplier_name"] = $supplier->supplier_name;
            $j++;

            $this->supplierSum += (double)$salesAmount;

        }

    }

    public function getSupplierReportDay(){

        $this->supplierSum = 0;
        $suppliers = Supplier::get();
        $j=0;

        foreach ($suppliers as $supplier ) {
            $products  = Product::where('product_supplier_id',$supplier->id)->get();
            $salesAmount = 0;

            foreach ($products as $product ) {
               $invoiceDetails = Inovicedetail::where('invoicedetail_product_id',$product->id)
                                                ->whereDate('created_at',$this->reportDate)
                                                ->get();

                foreach ($invoiceDetails as $invoice ) {
                    $salesAmount += ((double)$invoice->invoicedetails_product_qty * (double)$product->product_price);

                }
            }
            $this->supplierWiseProducts[$j]["sales_amount"] = $salesAmount;
            $this->supplierWiseProducts[$j]["supplier_name"] = $supplier->supplier_name;
            $j++;

            $this->supplierSum += (double)$salesAmount;

        }

    }



    public function setSupplierToday(){
        $this->fromFlag = 0;
        $this->toFlag = 0;
        $this->getSupplierReportToday();
    }

    public function setSupplierDayWise(){
        $this->fromFlag = 1;
        $this->toFlag = 0;
        $this->getSupplierReportDay();
    }

    public function getProductReportToday(){
        $this->productSum = 0;
        $this->profitSum = 0;
        $this->reportDate = Carbon::now();
        $j= 0;
        $products = Product::all();
        foreach ($products as $product ) {
            $invoiceDetails = Inovicedetail::where('invoicedetail_product_id',$product->id)
                                             ->whereDate('created_at',$this->reportDate)
                                             ->get();
            $salesAmount = 0;
            $profit = 0;
            $qty = 0;
            foreach ($invoiceDetails as $invoice ) {
                 $salesAmount += ((double)$invoice->invoicedetails_product_qty * (double)$product->product_price);
                 $profit = ((double)$invoice->invoicedetails_product_qty * (double)$product->product_sell_price) - ((double)$invoice->invoicedetails_product_qty * (double)$product->product_price) ;
                 $qty += (double)$invoice->invoicedetails_product_qty;
                }

            $this->productWise[$j]["sales_amount"] = $salesAmount;
            $this->productWise[$j]["product_price"] = $product->product_price;
            $this->productWise[$j]["qty"] = $qty;
            $this->productWise[$j]["product_name"] = $product->product_name;
            $this->productWise[$j]["profit"] = $profit;
            $j++;
            $this->profitSum +=  $profit;
            $this->productSum += $salesAmount;
         }
        //dd($this->productWise);
    }

    public function getProductReportDay(){
        $this->productSum = 0;
        $this->profitSum = 0;

        $j= 0;
        $products = Product::all();
        foreach ($products as $product ) {
            $invoiceDetails = Inovicedetail::where('invoicedetail_product_id',$product->id)
                                             ->whereDate('created_at',$this->reportDate)
                                             ->get();
            $salesAmount = 0;
            $profit = 0;
            $qty = 0;
            foreach ($invoiceDetails as $invoice ) {
                 $salesAmount += ((double)$invoice->invoicedetails_product_qty * (double)$product->product_price);
                 $profit = ((double)$invoice->invoicedetails_product_qty * (double)$product->product_sell_price) - ((double)$invoice->invoicedetails_product_qty * (double)$product->product_price) ;
                 $qty += (double)$invoice->invoicedetails_product_qty;
                }

            $this->productWise[$j]["sales_amount"] = $salesAmount;
            $this->productWise[$j]["product_price"] = $product->product_price;
            $this->productWise[$j]["qty"] = $qty;
            $this->productWise[$j]["product_name"] = $product->product_name;
            $this->productWise[$j]["profit"] = $profit;
            $j++;
            $this->profitSum +=  $profit;
            $this->productSum += $salesAmount;
         }

        //dd($this->productWise);

    }

    public function setProductToday(){
        $this->fromFlag = 0;
        $this->toFlag = 0;
        $this->getProductReportToday();
    }

    public function setProductDay(){
        $this->fromFlag = 1;
        $this->toFlag = 0;
        $this->getProductReportDay();
    }


    public function productReport(){
        $this->supplierViewFlag = 0;
        $this->productViewFlag = 1;
        $this->blockViewFlag = 0;
        $this->creditViewFlag = 0;
        $this->debitViewFlag = 0;
        $this->getProductReportToday();
    }


    public function blockReport(){
        $this->blockSum = 0;
        $this->supplierViewFlag = 0;
        $this->productViewFlag = 0;
        $this->blockViewFlag = 1;
        $this->creditViewFlag = 0;
        $this->debitViewFlag = 0;

        $this->reportDate = Carbon::now();

        $blocks = Block::select('id','block_name')->get();

        $x = 0;
        foreach ($blocks as $block ) {
            $this->blockWiseInmates[$x]["block_name"] = $block->block_name;
            $this->blockWiseInmates[$x]["count"] = Inmate::where('inmate_block_id','=', $block->id)->count();

            $inmates = Inmate::where('inmate_block_id',$block->id)->select('inmate_rpno')->get();
            $temp_single_amt = 0;
            foreach ($inmates as $inmate) {

                $temp_single_amt += Invoice::where('invoice_cus_id', $inmate->inmate_rpno)
                                            ->whereDate('created_at',$this->reportDate)
                                            ->sum('invoice_amount');

            }

            $this->blockWiseInmates[$x]["sales"] = $temp_single_amt;
            $x++;
            $this->blockSum += (double)$temp_single_amt;
        }
    }


    public function creditReport(){
        $this->creditSum = 0;
        $this->supplierViewFlag = 0;
        $this->productViewFlag = 0;
        $this->blockViewFlag = 0;
        $this->creditViewFlag = 1;
        $this->debitViewFlag = 0;

        $this->reportDate = Carbon::now();
        $x = 0;
        $blocks = Block::all();
        foreach ($blocks as $block ) {

            $this->blockCredits[$x]["block_name"] = $block->block_name;
            $credits = ['WAGE','INTERVIEW-ADVOCATE','INTERVIEW-FAMILY','INTERVIEW','MONEY ORDER','ADMISSION','LEAVE-PAROLE'];

            foreach ($credits as $credit ) {
                //wage
                $inmates = Inmate::where('inmate_block_id',$block->id)->select('id')->get();
                $temp_credit = 0;
                foreach ($inmates as $inmate ) {
                    $temp_credit += Transaction::where('transaction_inmate_id',$inmate->id)
                                                ->where('transaction_mode',$credit)
                                                ->whereDate('created_at',$this->reportDate)
                                                ->sum('transaction_amt');
                }
                $this->blockCredits[$x][$credit] = $temp_credit;
                $this->creditSum += (double)$temp_credit;
            }
            $x++;

        }
    }

    public function debitReport(){
        $this->supplierViewFlag = 0;
        $this->productViewFlag = 0;
        $this->blockViewFlag = 0;
        $this->creditViewFlag = 0;
        $this->debitViewFlag = 1;
        $this->debitSum = 0;
        $this->reportDate = Carbon::now();

        $blocks = Block::all();
        $x=0;
        foreach ($blocks as $block ) {

            $this->blockDebits[$x]["block_name"] = $block->block_name;

            $debits = ['PHONE-RECHARGE','MO-ADVOCATE','MO-FAMILY','MO-PAROLE','MEDICAL','STAMPS','LEAVE-BAIL'];

            foreach ($debits as $debit ) {
                //wage
                $inmates = Inmate::where('inmate_block_id',$block->id)->select('id')->get();
                $temp_debit = 0;
                foreach ($inmates as $inmate ) {
                    $temp_debit += Transaction::where('transaction_inmate_id',$inmate->id)
                                                ->where('transaction_mode',$debit)
                                                ->whereDate('created_at',$this->reportDate)
                                                ->sum('transaction_amt');
                }
                $this->blockDebits[$x][$debit] = $temp_debit;
                $this->debitSum += (double)$temp_debit;
            }

            $x++;

        }
        $x =0;
    }

}
