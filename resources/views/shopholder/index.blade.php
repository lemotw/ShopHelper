@extends('layouts.app_empty')

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


    <!-- SERER維護 -->
    @foreach($Owners as $owner)
    @if($owner->Shop != NULL)
    <div class="col-md-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fas fa-server iconfont-size"></i>
                    </div>
                </div>
            </div>
            <a href="{{ route('sale.ShopIndex', ['Shop'=>$owner->Shop->id]) }}">
                <div class="panel-footer">
                    <span class="pull-left">{{ $owner->Shop->name }}</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    @endif
    @endforeach

</div>

@endsection