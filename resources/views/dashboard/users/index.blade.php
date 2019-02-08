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

                <h3 class="box-title" style="margin-bottom:15px">@lang('site.users')</h3>
                <form action="">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="search" placeholder="@lang('site.search')">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary" > <i class="fa fa-search"></i> @lang('site.search')</button>
                            <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary"> <i class="fa fa-plus"> @lang('site.add')</i> </a>
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
                            <td> <a class="btn btn-info btn-sm" href="{{ route('dashboard.users.edit', $user->id) }}">@lang('site.edit') <i class="fa fa-edit"></i></a>
                            <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="post" style="display:inline-block">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button type="submit" class="btn btn-danger btn-sm">@lang('site.delete')</button>
                            </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table><!--end of table -->
                @else
                <h2>@lang('site.no_data_found')</h2>

                @endif

            </div><!--end of box body -->

        </div><!--end of box-->

@endsection
