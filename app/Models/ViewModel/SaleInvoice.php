<?php

namespace App\Models\ViewModel;

class SaleInvoice
{
    /**
     * The attributes of sales quantities.
     * @var int
     */
    public $count= 0;

    /**
     * The attributes of invoice date. 
     * @var string
     */
    public $date = '';

    /**
     * Sales.
     * @var int
     */
    public $sales = 0;

    /**
     * Invoice str
     * @var string
     */
    public $invoice = '';

}