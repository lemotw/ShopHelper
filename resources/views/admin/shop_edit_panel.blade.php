@extends('layouts.admin_app')

@section('page_title', '店家編輯頁面')
@section('content')
<div class="container-fluid">
    <div class="row heading-row-up">
        <div class="col-lg-12 heading-row-title">
            <h1>修改店家</h1>
            <h5>修改店家名稱。</h5>
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

                <form action="{{ route('ShopEdit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="User" value="{{ $User->id }}">
                    <input type="hidden" name="id" value="{{ $Shop->id }}">
                    <div class="data-display">
                            <p class="data-title">edit</p>

                            <div class="table-frame">
                                <table class="table table-striped table-hover table-fullcol">
                                    <tbody>
                                        <tr>
                                            <td>店家名稱</td>
                                            <td></td>
                                            <td><input required type="text" class="form-control form-input" name="name" value="{{ $Shop->name }}"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>                                    
                        
                            <input class="btn btn-blue" type="submit" value="修改資料">
                    </div>            
                </form>
            </div>
        </div>

    </div>
</div>
@endsection