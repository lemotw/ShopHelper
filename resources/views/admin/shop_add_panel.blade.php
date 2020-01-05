@extends('layouts.admin_app')

@section('page_title', '店家新增頁面')
@section('content')
<div class="container-fluid">
    <div class="row heading-row-up">
        <div class="col-lg-12 heading-row-title">
            <h1>新增店家</h1>
            <h5>新增店家並加入使用者管理。</h5>
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

                <form action="{{ route('ShopAdd') }}" method="POST">
                    @csrf
                    <input type="hidden" name="User" value="{{ $UserId }}">
                    <div class="data-display">
                            <p class="data-title">new</p>

                            <div class="table-frame">
                                <table class="table table-striped table-hover table-fullcol">
                                    <tbody>
                                        <tr>
                                            <td>店家名稱</td>
                                            <td></td>
                                            <td><input required="" type="text" class="form-control form-input" name="name" value=""></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>                                    
                        
                            <input class="btn btn-blue" type="submit" value="新增資料">
                    </div>            
                </form>
            </div>
        </div>

    </div>
</div>
@endsection