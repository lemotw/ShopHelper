@extends('layouts.admin_app')

@section('page_title', '店家維護')
@section('content')
<script>

    function delete_check(url)
    {
        var confirm_f = confirm('你真的要刪除這個店家管理權嗎？');
        if(confirm_f)
            window.location.replace(url);
    }

</script>

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
                                <a href="{{ route('ShopShopAddOwn', ['User'=>$User->id]) }}" class="btn btn-primary">加入已存在店家</a>
                                <a href="{{ route('ShowShopAdd', ['User'=>$User->id]) }}" class="btn btn-primary">新增店家</a>
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
                                        <th>刪除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ShopList as $shop)
                                    @if($shop->Shop != NULL)
                                    <tr>
                                        <td>{{ $shop->Shop->id }}</td>
                                        <td>{{ $shop->Shop->name }}</td>
                                        <td><a href="{{ route('ShowShopEdit', ['Shop'=>$shop->Shop->id,'User'=>$User->id]) }}" class="btn btn-primary">店家資料維護</a></td>
                                        <td>{{ $shop->updated_at }}</td>
                                        <td><a onclick="delete_check('{{ route('ShopDeleteOwn', ['Shop'=>$shop->Shop->id,'User'=>$User->id]) }}')" class="btn btn-danger">刪除</a></td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
            </div>
        </div>

    </div>
</div>
@endsection