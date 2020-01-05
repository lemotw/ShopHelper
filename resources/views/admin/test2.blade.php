@extends('layouts.app_')

@section('content')
<div class="container-fluid">
    <div class="row heading-row-up">
        <div class="col-lg-12 heading-row-title">
            <h1>店家維護</h1>
            <h5>維護店家，並維護店家資料。</h5>
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
                            <h1>店家操作</h1>
                            <div>
                                <a href="" class="btn btn-primary">加入已存在店家</a>
                                <a href="" class="btn btn-primary">新增店家</a>
                            </div>
                        </div>

                    <div class="data-display" style="padding:20px;">
                        <div class="table-frame">

                            <table class="table table-striped table-hover table-fullcol">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>店家名稱</th>
                                        <th>資料維護</th>
                                        <th>最近修改</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>董冠彰</td>
                                        <td><a href="" class="btn btn-primary">重設密碼</a></td>
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