@extends('layouts.admin_app')

@section('page_title', '使用者列表')
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

    <script>
    
        function delete_check(url)
        {
            var confirmFlag = confirm('是否要停用該使用者？'); 
            if(confirmFlag)
                window.location.replace(url);
        }
    
    </script>

    <div class="container-fluid">
        <div class="row chart-rowstyle">
            <div class="col-lg-12">

                    <div class="data-display" style="padding: 10px;">

                        <div style="margin: 40px 0;">
                            <h1>使用者操作</h1>
                            <div>
                                <a href="{{ route('UserAdd') }}" class="btn btn-primary">新增使用者</a>
                            </div>
                        </div>


                        <div class="table-frame">

                            <table class="table table-striped table-hover table-fullcol">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>使用者名稱</th>
                                        <th>重設密碼</th>
                                        <th>店家維護</th>
                                        <th>最近修改</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($UserList as $user)
                                    <tr>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td><a href="" class="btn btn-primary">重設密碼</a></td>
                                        <td><a href="{{ route('ShopMaintain', ['User'=>$user->id]) }}" class="btn btn-primary">店家維護</a></td>
                                        <td>{{ $user->updated_at }}</td>
                                        <td><a onclick="delete_check('{{ route('UserDelete', ['User'=>$user->id]) }}');" class="btn btn-danger">停用</a></td>
                                    </tr>
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