@extends('layouts.admin')

@section('content')
    <main class="mt-lg-5 mt-3">
        <div class="container pos-re">

            <form action="{{route('admin.cargo.update', $cargo->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>{{ __('Brief description of the cargo in Russian') }}</label>
                                    <input type="text" name="title_ru" class="form-control" placeholder="{{ __('Brief description') }}" value="{{ $cargo->title_ru }}" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('Brief information about the cargo in Turkmen') }}</label>
                                    <input type="text" name="title_tk" class="form-control" placeholder="{{ __('Brief information about the cargo in Turkmen') }}" value="{{ $cargo->title_tk }}" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('Track number') }}</label>
                                    <input type="number" name="track_number" class="form-control" placeholder="{{ __('Track number') }}" value="{{ $cargo->track_number }}" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('Barcode') }}</label>
                                    <input oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" type="text" class="form-control" value="{{ $cargo->barcode }}" placeholder="{{ __('Barcode') }}" name="barcode" required />
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('Weight') }}</label>
                                    <input type="number" step="any" class="form-control"  placeholder="{{ __('Weight') }}" name="weight" value="{{ $cargo->weight }}" required />
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('Places') }}</label>
                                    <input type="number" step="any" class="form-control"  placeholder="{{ __('Places') }}" name="place" value="{{ $cargo->place }}" required />
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{ __('Volume') }}</label>
                                    <input type="number" step="any" class="form-control"  placeholder="{{ __('Volume') }}" name="capacity" value="{{ $cargo->capacity }}" required />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" style="float: right;">{{ __('Change') }}</button>
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                </div>
            </form>

        </div>
    </main>
@endsection
