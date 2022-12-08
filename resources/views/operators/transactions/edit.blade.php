@extends('operators.layouts.main')

@section('content')
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
  <p class="mb-4 float-left">Opertaor / Master / <span class="text-primary">{{ $title }}</span></p>
  <a href="/operator/transaction" class="btn btn-primary btn-md float-right"><i class="fa fa-arrow-left mr-1"></i> Back</a>
  <br><br>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
    </div>
    <div class="card-body">
      <form action="/operator/transaction/{{ $tables->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group row">
          <div class="col-md-6">
            <label for="">Choice Driver : </label>
            <select name="driver_id" id="driver_id" class="form-control @error('driver_id') is-invalid @enderror">
              @foreach ($drivers as $row)
                <option value="{{ $row->id }}" {{ ($row->id == 3) ? 'disabled selected' : '' }}>{{ $row->name }}</option>
              @endforeach
            </select>
            @error('driver_id')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="">Total : </label>
            <input type="number" name="total" id="total" class="form-control @error('total') is-invalid @enderror" placeholder="Category Name" value="{{ $tables->total }}">
            @error('total')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
          <div class="col-md-6">
            <label for="">Customer Name : </label>
            <input type="text" readonly id="none" class="form-control @error('none') is-invalid @enderror" placeholder="Category Name" value="{{ $tables->customer->name }}">
            @error('none')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="">Date Order : </label>
            <input type="text" readonly id="none" class="form-control @error('none') is-invalid @enderror" placeholder="Category Name" value="{{ $tables->order_date }}">
            @error('none')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
          <div class="col-md-6">
            <label for="">Pickup Address : </label>
            <input type="text" readonly id="none" class="form-control @error('none') is-invalid @enderror" placeholder="Category Name" value="{{ $tables->schedule->pickup_address }}">
            @error('none')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="">Destination Address : </label>
            <input type="text" readonly id="none" class="form-control @error('none') is-invalid @enderror" placeholder="Category Name" value="{{ $tables->schedule->destination_address }}">
            @error('none')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
          <div class="col-md-6">
            <label for="">Pickup Address (Go home) : </label>
            <input type="text" readonly id="none" class="form-control @error('none') is-invalid @enderror" placeholder="Category Name" value="{{ $tables->schedule->pickup_return_address }}">
            @error('none')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="">Destination Address (Go home) : </label>
            <input type="text" readonly id="none" class="form-control @error('none') is-invalid @enderror" placeholder="Category Name" value="{{ $tables->schedule->pickup_address }}">
            @error('none')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
          <div class="col-md-3">
            <label for="">Date From : </label>
            <input type="text" readonly id="none" class="form-control @error('none') is-invalid @enderror" placeholder="Category Name" value="{{ $tables->schedule->date_start }}">
            @error('none')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="col-md-3">
            <label for="">Date End : </label>
            <input type="text" readonly id="none" class="form-control @error('none') is-invalid @enderror" placeholder="Category Name" value="{{ $tables->schedule->date_end }}">
            @error('none')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="col-md-3">
            <label for="">Time Pickup : </label>
            <input type="text" readonly id="none" class="form-control @error('none') is-invalid @enderror" placeholder="Category Name" value="{{ $tables->schedule->time_pickup }}">
            @error('none')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="col-md-3">
            <label for="">Time Return : </label>
            <input type="text" readonly id="none" class="form-control @error('none') is-invalid @enderror" placeholder="Category Name" value="{{ $tables->schedule->time_return }}">
            @error('none')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>
        
        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-md">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection