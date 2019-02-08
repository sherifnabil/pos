@extends('layouts.dashboard.app')
@section('content')
    <section class="content-header">
      <h1>@lang('site.dashboard')</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
        <li ><a href="{{ route('dashboard.users.index') }}"> @lang('site.users')</a></li>
        <li ><a href="{{ route('dashboard.users.create') }}"> @lang('site.add')</a></li>

      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
  <h1>this is dashboard</h1>

@endsection
