@extends('layouts.admin_app')

@section('page_title', '店家權限增加頁面')
@section('content')
<div class="container-fluid">
    <div class="row heading-row-up">
        <div class="col-lg-12 heading-row-title">
            <h1>加入店家</h1>
            <h5>加入使用者管理。</h5>
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

                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="User" value="{{ $UserId }}">
                    <div class="data-display">
                            <p class="data-title">Add</p>

                            <div class="table-frame">
                                <table class="table table-striped table-hover table-fullcol">
                                    <tbody>
                                        <tr>
                                            <td>店家</td>
                                            <td></td>
                                            <td>
                                                <select name="Shop">
                                                    @foreach($ShopList as $shop)
                                                        <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>                                    
                        
                            <input class="btn btn-blue" type="submit" value="加入店家">
                    </div>            
                </form>
            </div>
        </div>

    </div>
</div>
@endsection