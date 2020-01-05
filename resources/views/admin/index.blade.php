@extends('layouts.admin_app')

@section('page_title', '管理者頁面')
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
    </div>

    <!-- 使用者維護 -->
    <div class="col-md-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fas fa-user-cog iconfont-size"></i>
                    </div>
                </div>
            </div>
            <a href="{{ route('UserMaintain') }}">
                <div class="panel-footer">
                    <span class="pull-left">使用者維護</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <!-- 店家維護按鈕 -->
    <div class="col-md-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fas fa-store-alt iconfont-size"></i>
                    </div>
                </div>
            </div>
            <a href="{{ route('ShopAllMaintain') }}">
                <div class="panel-footer">
                    <span class="pull-left">店家維護</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

</div>

@endsection