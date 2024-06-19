@extends('layouts.admin')

@section('content')
    <main class="mt-lg-5 mt-3"> 
        <div class="container pos-re">      

            <form action="{{route('admin.shipping.update', $shipping->id)}}" method="POST">
                @csrf
                @method('PUT')
              <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>{{ __('Title (RU)') }}</label>
                                <input type="text" name="name_ru" class="form-control" value="{{ $shipping->name_ru  }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{ __('Title (TM)') }}</label>
                                <input type="text" name="name_tk" class="form-control"  value="{{ $shipping->name_tk  }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{ __('Title (EN)') }}</label>
                                <input type="text" name="name_en" class="form-control"  value="{{ $shipping->name_en  }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit"  class="btn btn-primary" style="float: right;">{{ __('Edit') }}</button>
                            </div>
                            <!-- /.form-group -->
                        </div>

                        <div class="col-sm-6">
                        <!-- text input -->

                    </div>
                    <!-- /.row -->
                 </div>
                <!-- /.card-body -->
              </div>
              </div>
            </form>


        </div>        
      </main>
@endsection
