@extends('layouts.dashboard.app')

@section('content')

<section class="content-header">
      <h1>@lang('site.users')</h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
        <li ><a href="{{ route('dashboard.users.index') }}" > @lang('site.users')</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">


    <div class="box box-primary">
            <div class="box-header with-border">

                <h3 class="box-title" style="margin-bottom:15px">@lang('site.users') <small>{{ $users->total() }}</small> </h3>
                <form action="{{ route('dashboard.users.index') }}" method="get" >
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="search" placeholder="@lang('site.search')" value="{{ request()->search }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary" > <i class="fa fa-search"></i> @lang('site.search')</button>
                            @if(auth()->user()->hasPermission('create_users'))
                            <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary"> <i class="fa fa-plus"> @lang('site.add')</i> </a>
                            @else
                            <a href="#" class="btn btn-primary " disabled><i class="fa fa-plus"> @lang('site.add')</i> </a>
                            @endif
                        </div>

                    </div>
                </form>

            </div><!--end of box header  -->
            <table class="box-body">
                @if($users->count() > 0)
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.first_name')</th>
                            <th>@lang('site.last_name')</th>
                            <th>@lang('site.email')</th>
                            <th>@lang('site.image')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td> <img class="img-thumbnail" src="{{ $user->image_path }}" style="width:100px; height:100px" alt=""></td>
                            @if(auth()->user()->hasPermission('update_users'))
                            <td> <a class="btn btn-info btn-sm" href="{{ route('dashboard.users.edit', $user->id) }}"><i class="fa fa-edit"></i> @lang('site.edit') </a>
                            @else
                            <td><button class="btn btn-info btn-sm" disabled> <i class="fa fa-edit"></i> @lang('site.edit')</button>
                           @endif
                            @if(auth()->user()->hasPermission('delete_users'))
                            <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="post" style="display:inline-block">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button type="submit" class="btn btn-danger btn-sm delete"> <i class="fa fa-trash"></i> @lang('site.delete')</button>
                            </form>
                            @else
                            <button class="btn btn-danger btn-sm" disabled> <i class="fa fa-trash"></i> @lang('site.delete')</button></td>
                           @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table><!--end of table -->

                {{ $users->appends(request()->query())->links() }}
                @else
                <h2>@lang('site.no_data_found')</h2>

                @endif

            </div><!--end of box body -->

        </div><!--end of box-->

@endsection
