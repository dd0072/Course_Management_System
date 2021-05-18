@extends('admin.layouts.app')

@section('title')
    管理员管理
@endsection

@section('sidebar')
    @include('admin.adminuser.menu')
@endsection

@section('content')
    <x-page-title>
        <x-slot name="title">
            管理员
        </x-slot>

        <x-slot name="comment">
            管理员管理
        </x-slot>
    </x-page-title>

    <table class="table table-sm">
        <thead class="thead-light">
            <tr>
                <th scope="col">序号</th>
                <th scope="col">用户名</th>
                <th scope="col">状态</th>
                <th scope="col">创建时间</th>
                <th scope="col">管理</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($adminusers as $adminuser)
                <tr>
                    <th scope="row">{{ $adminuser->id }}</th>
                    <td>{{ $adminuser->username }}</td>
                    <td>
                        <a onclick='return confirm("确认要切换状态吗？")'
                            href="{{ route('admin.adminuser.state', [$adminuser->id]) }}">{!! $adminuser->stateText !!}</a>
                    </td>
                    <td>{{ $adminuser->created_at }}</td>
                    <td>
                        <a href='{{ route('admin.adminuser.add', [$adminuser->id]) }}'
                            class='btn btn-sm btn-secondary'>修改</a>
                        <a onclick='return confirm("确认删除吗？")'
                            href='{{ route('admin.adminuser.remove', [$adminuser->id]) }}'
                            class='btn btn-sm btn-danger'>删除</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
