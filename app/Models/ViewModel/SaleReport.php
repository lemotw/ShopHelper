<?php

namespace App\Models\ViewModel;

class SaleReport
{
    /**
     * The attributes of billing quantities.
     * @var int
     */
    public $billing = 0;

    /**
     * The attributes of sales count. 
     * @var int
     */
    public $sales = 0;

    /**
     * Count of invoice.
     * @var int
     */
    public $invoice = 0;

    /**
     * String to show of time.
     * @var string
     */
    public $time = '';

    /**
     * Title for page.
     *
     * @var string
     */
    public $title = '';

    /**
     * Describe for page.
     *
     * @var string
     */
    public $describe = '';
}