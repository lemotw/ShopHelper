@extends('layouts.admin_app')

@section('page_title', '使用者新增頁面')
@section('content')
<div class="container-fluid">
    <div class="row heading-row-up">
        <div class="col-lg-12 heading-row-title">
            <h1>新增使用者</h1>
            <h5>新增使用者，並設定密碼及email。</h5>
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

                <form action="{{ route('UserAdd') }}" method="POST">
                    @csrf
                    <div class="data-display">
                            <p class="data-title">new</p>

                            <div class="table-frame">
                                <table class="table table-striped table-hover table-fullcol">
                                    <tbody>
                                        <tr>
                                            <td>Name：</td>
                                            <td></td>
                                            <td><input type="text" name="name" required></td>
                                        </tr>

                                        <tr>
                                            <td>Email：</td>
                                            <td></td>
                                            <td><input type="email" name="email" required></td>
                                        </tr>

                                        <tr>
                                            <td>Password：</td>
                                            <td></td>
                                            <td><input type="password" name="password" required></td>
                                        </tr>

                                        <tr>
                                            <td>Password確認：</td>
                                            <td></td>
                                            <td><input type="password" name="password-confirm" required></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>                                    
                        
                            <input class="btn btn-blue" type="submit" value="新增使用者">
                    </div>            
                </form>
            </div>
        </div>

    </div>
</div>
@endsection