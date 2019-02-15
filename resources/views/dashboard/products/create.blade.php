@extends('layouts.dashboard.app')

@section('content')

<section class="content-header">
      <h1>@lang('site.products')</h1>
      <ol class="breadcrumb">
      <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
      <li ><a href="{{ route('dashboard.products.index') }}"> @lang('site.products')</a></li>
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
                <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>@lang('site.categories')</label>
                        <select name="category_id" class="form-control">
                            <option value="">@lang('site.all_categories')</option>

                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '1' }} >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @foreach(config('translatable.locales') as $locale)

                        <div class="form-group">
                            <label for="name">@lang('site.' . $locale . '.name')</label>
                            <input type="text" class="form-control" name="{{ $locale }}[name]" value="{{ old($locale . '.name') }}" >
                        </div>

                        <div class="form-group">
                            <label for="description">@lang('site.' . $locale . '.description')</label>
                            <textarea name="{{ $locale }}[description]" class="form-control ckeditor" >{{ old($locale . '.description') }}</textarea>

                        </div>
                    @endforeach


                    <div class="form-group">
                        <label for="image">@lang('site.image')</label>
                        <input type="file" class="form-control image" name="image" >
                    </div>


                    <div class="form-group">
                        <img src="{{ url('uploads/product_images/4.png')}}" class="img-thumbnail image-preview" alt="" style="width:150px; height:100px">
                    </div>



                    <div class="form-group">
                        <label for="purchase_price">@lang('site.purchase_price')</label>
                        <input type="number" class="form-control " name="purchase_price" value="{{ old('purchase_price') }}" >
                    </div>

                    <div class="form-group">
                        <label for="sell_price">@lang('site.sell_price')</label>
                        <input type="number" class="form-control " name="sell_price" value="{{ old('sell_price') }}">
                    </div>

                    <div class="form-group">
                        <label for="stock">@lang('site.stock')</label>
                        <input type="number" class="form-control " name="stock" value="{{ old('stock') }}" >
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" > <i class="fa fa-plus"></i> @lang('site.add')</button>
                    </div>


                </form>
            </div><!--end of box body -->

        </div><!--end of box-->
@endsection
