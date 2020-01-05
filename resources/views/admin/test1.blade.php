@extends('layouts.app_')

@section('content')
<div class="container-fluid">
    <div class="row heading-row-up">
        <div class="col-lg-12 heading-row-title">
            <h1>使用者維護</h1>
            <h5>維護所有使用者</h5>
        </div>
    </div>
    <div class="row heading-row-down">
        <div class="col-md-8"></div>
        <div class="col-md-4">
        </div>                    
    </div>

    <div class="container-fluid">
        <!-- 
        <div class="row">
            <div class="col-md-12">
            <ul class="nav nav-pills admin-area-nav">
                <li><a href="">廠區</a></li>
            </ul>
            </div>
        </div> -->

        <div class="row chart-rowstyle">
            <div class="col-lg-12">

                    <div class="data-display">
                        <div class="table-frame">

                            <table class="table table-striped table-hover table-fullcol">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>使用者名稱</th>
                                        <th>重設密碼</th>
                                        <th>店家維護</th>
                                        <th>最近修改</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>lemotw1024@gmail.com</td>
                                        <td>董冠彰</td>
                                        <td><a href="" class="btn btn-primary">重設密碼</a></td>
                                        <td><a href="" class="btn btn-primary">店家維護</a></td>
                                        <td>2019-10-27</td>
                                    </tr>
                                    <tr>
                                        <td>lemotw1024@gmail.com</td>
                                        <td>董冠彰</td>
                                        <td><a href="" class="btn btn-primary">店家維護</a></td>
                                        <td><a href="" class="btn btn-primary">重設密碼</a></td>
                                        <td>2019-10-27</td>
                                    </tr>
                                    <tr>
                                        <td>lemotw1024@gmail.com</td>
                                        <td>董冠彰</td>
                                        <td><a href="" class="btn btn-primary">重設密碼</a></td>
                                        <td><a href="" class="btn btn-primary">店家維護</a></td>
                                        <td>2019-10-27</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
            </div>
        </div>

    </div>
</div>
@endsection