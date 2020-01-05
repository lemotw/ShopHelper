@extends('layouts.app_menu')

@section('content')

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<div class="container-fluid">
    <div class="row heading-row-up">
        <div class="col-lg-12 heading-row-title">
            <h1>發票清單</h1>
            <h5>店家時段內的發票清單。</h5>
        </div>
    </div>
    <div class="row heading-row-down">
        <div class="col-md-8"></div>
        <div class="col-md-4">
        </div>                    
    </div>

    <div class="container-fluid">

        <div class="row chart-rowstyle">
            <div class="col-lg-12">

                    <div class="data-display" style="padding: 10px;">

                        <div style="margin: 40px 0;">
                            <h1>區間查詢</h1>
                            <div>
                                <form action="{{ route('sale.BetweenSaleInvoice') }}" method="POST">
                                    @csrf
                                    <label>開始：</label>
                                    <div style="display:inline-block;">
                                        <input style="display:inline-block;" type="text" name="Start_Time" id="start" autocomplete="off" required>
                                    </div>

                                    <label>～</label>

                                    <label>結束：</label>
                                    <div style="display:inline-block;">
                                        <input style="display:inline-block;" type="text" name="End_Time" id="end" autocomplete="off" required>
                                    </div> 
                                    <input type="hidden" name="Shop" value="{{ $Shop }}">
                                    
                                    <input class="btn" style="margin-left:10px;" type="submit" value="送出">
                                </form>
                            </div>
                        </div>

                        <div class="table-frame">

                            <table class="table table-striped table-hover table-fullcol">
                                <thead>
                                    <tr>
                                        <th>日期</th>
                                        <th>商品數量</th>
                                        <th>金額</th>
                                        <th>發票編號</th>
                                    </tr>
                                </thead>
    
                                <tbody>
                                @foreach($SaleInvoice as $invoice)
                                    <tr>
                                        <td>{{ $invoice->date }}</td>
                                        <td>{{ $invoice->count}}</td>
                                        <td>{{ $invoice->sales}}</td>
                                        <td>{{ $invoice->invoice}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
            </div>
        </div>

    </div>
</div>

<script>
    $('#start').datetimepicker({
        width: 200,
        footer: true,
        format: 'yyyy/mm/dd HH:MM:ss',
    });

    $('#end').datetimepicker({
        width: 200,
        footer: true,
        format: 'yyyy/mm/dd HH:MM:ss',
    });
</script>

@endsection