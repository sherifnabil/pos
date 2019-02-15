@extends('layouts.dashboard.app')

@section('content')

    <section class="content-header">
      <h1>@lang('site.products')</h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
        <li ><a href="{{ route('dashboard.products.index') }}" > @lang('site.products')</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">


    <div class="box box-primary">
            <div class="box-header with-border">

                <h3 class="box-title" style="margin-bottom:15px">@lang('site.products') <small>{{ $products->total() }}</small> </h3>
                <form action="{{ route('dashboard.products.index') }}" method="get" >
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="search" placeholder="@lang('site.search')" value="{{ request()->search }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary" > <i class="fa fa-search"></i> @lang('site.search')</button>
                            @if(auth()->user()->hasPermission('create_products'))
                            <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary"> <i class="fa fa-plus"> @lang('site.add')</i> </a>
                            @else
                            <a href="#" class="btn btn-primary " disabled><i class="fa fa-plus"> @lang('site.add')</i> </a>
                            @endif
                        </div>

                    </div>
                </form>

            </div><!--end of box header  -->
            <table class="box-body">
                @if($products->count() > 0)
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.name')</th>
                            <th>@lang('site.description')</th>
                            <th>@lang('site.image')  </th>
                            <th>@lang('site.purchase_price')</th>
                            <th>@lang('site.sell_price')</th>
                            <th>@lang('site.stock')</th>
                            <th>@lang('site.action')</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $index => $product)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{!! $product->description !!}</td>
                            <td><img src="{{ $product->image_path }}" class="img-thumbnail" style="height:75px" alt=""></td>
                            <td>{{ $product->purchase_price }}</td>
                            <td>{{ $product->sell_price }}</td>
                            <td>{{ $product->stock }}</td>

                            @if(auth()->user()->hasPermission('update_products'))
                            <td> <a class="btn btn-info btn-sm" href="{{ route('dashboard.products.edit', $product->id) }}"><i class="fa fa-edit"></i> @lang('site.edit') </a>
                            @else
                            <td><button class="btn btn-info btn-sm" disabled> <i class="fa fa-edit"></i> @lang('site.edit')</button>
                           @endif
                            @if(auth()->user()->hasPermission('delete_products'))
                            <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post" style="display:inline-block">
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

                {{ $products->appends(request()->query())->links() }}
                @else
                <h2>@lang('site.no_data_found')</h2>

                @endif

            </div><!--end of box body -->

        </div><!--end of box-->
@endsection
