@extends('layouts.dashboard.app')

@section('content')

<section class="content-header">
      <h1>@lang('site.categories')</h1>
      <ol class="breadcrumb">
      <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
      <li ><a href="{{ route('dashboard.categories.index') }}"> @lang('site.categories')</a></li>
      <li class="active">@lang('site.edit')</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box box-primary">
            <div class="box-header">

                <h3 class="box-title">@lang('site.edit')</h3>

            </div><!--end of box header  -->
            <div class="box-body">

            @include('partials._errors')
            <form action="{{ route('dashboard.categories.update', $category->id) }}" method="post" >
                {{ csrf_field() }}
                {{ method_field('put') }}
                @foreach(config('translatable.locales') as $locale)
                    <div class="form-group">
                        <label for="name">@lang('site.' . $locale . '.name')</label>

                        <input type="text" class="form-control" name="{{ $locale }}[name]"
                        value="{{ $category->translate($locale)->name }}" required>
                    </div>
                @endforeach

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" > <i class="fa fa-edit"></i> @lang('site.edit')</button>
                </div>


            </form>
            </div><!--end of box body -->

        </div><!--end of box-->
@endsection
