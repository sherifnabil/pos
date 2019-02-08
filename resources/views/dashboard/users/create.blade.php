@extends('layouts.dashboard.app')

@section('content')

<section class="content-header">
      <h1>@lang('site.users')</h1>
      <ol class="breadcrumb">
      <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
      <li ><a href="{{ route('dashboard.users.index') }}"> @lang('site.users')</a></li>
      <li class="active">@lang('site.add')</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box box-primary">
            <div class="box-header">

                <h3 class="box-title">@lang('site.add')</h3>

            </div><!--end of box header  -->
            <div class="box-body">

            @include('partials._errors')
            <form action="{{ route('dashboard.users.store') }}" method="post">
                {{ csrf_field() }}
                {{ method_field('post') }}
                <div class="form-group">
                    <label for="first_name">@lang('site.first_name')</label>
                    <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
                </div>

                <div class="form-group">
                    <label for="last_name">@lang('site.last_name')</label>
                    <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
                </div>

                <div class="form-group">
                    <label for="email">@lang('site.email')</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                </div>


                <div class="form-group">
                    <label for="password">@lang('site.password')</label>
                    <input type="password" class="form-control" name="password">
                </div>


                <div class="form-group">
                    <label for="password_confirmation">@lang('site.password_confirmation')</label>
                    <input type="password" class="form-control" name="password_confirmation">

                <div class="form-group">
                    <label for="">@lang('site.permissions')</label>
                    <div class="nav-tabs-custom">

                    @php
                        $models = ['users', 'categories', 'products']

                    @endphp

                    <ul class="nav nav-tabs {{ app()->getLocale() == 'ar' ? 'pull-right' : '' }}">
                        @foreach($models as $index=> $model)

                            <li class="{{ $index == 0 ? 'active' : '' }}"><a href="#{{  $model}}" data-toggle="tab">@lang('site.' . $model)</a></li>

                        @endforeach
                    </ul>
                      <div class="tab-content">

                          @foreach($models as $index => $model)

                        <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{ $model }}">

                            <label for=""><input type="checkbox" name="permissions[]" value="create_{{ $model }}"> @lang('site.create')</label>
                            <label for=""><input type="checkbox" name="permissions[]" value="read_{{ $model }}"> @lang('site.read')</label>
                            <label for=""><input type="checkbox" name="permissions[]" value="update_{{ $model }}"> @lang('site.update')</label>
                            <label for=""><input type="checkbox" name="permissions[]" value="delete_{{ $model }}"> @lang('site.delete')</label>

                        </div>
                        @endforeach

                      </div>
                    </div>
                </div>

                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" > <i class="fa fa-plus"></i> @lang('site.add')</button>
                </div>


            </form>
            </div><!--end of box body -->

        </div><!--end of box-->
@endsection
