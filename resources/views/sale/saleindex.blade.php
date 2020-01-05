@extends('layouts.app_menu')

@section('content')

<div class="container-fluid">
    <div class="row heading-row-up">
        <div class="col-lg-12 heading-row-title">
            <h1>{{ env('APP_NAME') }}</h1>
            <h5>POS機資料系統</h5>
        </div>
    </div>
    <div class="row heading-row-down">
        <div class="col-md-8"></div>
        <div class="col-md-4"></div>
    </div>

    <div class="col-md-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fas fa-file-invoice-dollar iconfont-size"></i>
                    </div>
                </div>
            </div>
            <a href="{{ route('sale.TodaySaleReport', ['Shop'=>$ShopId]) }}">
                <div class="panel-footer">
                    <span class="pull-left">營業簡報</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <!-- <div class="col-md-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fas fa-chart-line iconfont-size"></i>
                    </div>
                </div>
            </div>
            <a href="{{route('sale.TodaySaleStatistic', ['Shop'=>$ShopId])}}">
                <div class="panel-footer">
                    <span class="pull-left">當日商品統計</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div> -->

    <div class="col-md-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fas fa-chart-pie iconfont-size"></i>
                    </div>
                </div>
            </div>
            <a href="{{ route('sale.TodaySale', ['Shop'=>$ShopId]) }}">
                <div class="panel-footer">
                    <span class="pull-left">商品銷售統計</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-md-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fas fa-book iconfont-size"></i>
                    </div>
                </div>
            </div>
            <a href="{{route('sale.TodaySaleStatistic', ['Shop'=>$ShopId])}}">
                <div class="panel-footer">
                    <span class="pull-left">銷售明細查詢</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-md-3 col-md-6">
        <div class="panel panel-blue">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fas fa-file-invoice iconfont-size"></i>
                    </div>
                </div>
            </div>
            <a href="{{ route('sale.TodaySaleInvoice', ['Shop'=>$ShopId]) }}">
                <div class="panel-footer">
                    <span class="pull-left">發票明細查詢</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-md-3 col-md-6">
        <div class="panel panel-indigo">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fas fa-id-badge iconfont-size"></i>
                    </div>
                </div>
            </div>
            <a href="">
                <div class="panel-footer">
                    <span class="pull-left">員工出勤查詢</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-md-3 col-md-6">
        <div class="panel panel-purpleblue">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fas fa-stopwatch iconfont-size"></i>
                    </div>
                </div>
            </div>
            <a href="">
                <div class="panel-footer">
                    <span class="pull-left">時段分析</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-md-3 col-md-6">
        <div class="panel panel-purple">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fas fa-paper-plane iconfont-size"></i>
                    </div>
                </div>
            </div>
            <a href="{{ route('ShopHolderIndex') }}">
                <div class="panel-footer">
                    <span class="pull-left">離開</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

</div>

@endsection