@extends('operators.layouts.main')

@section('content')
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
  <p class="mb-4 float-left">Opertaor / Master / <span class="text-primary">{{ $title }}</span></p>
  <br><br>
  <!-- DataTales Example -->
  @if(session('success'))
    <div class="alert alert-success">
      {{session('success')}}
    </div>
  @endif
  @if(session('danger'))
    <div class="alert alert-danger">
      {{session('danger')}}
    </div>
  @endif
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th width="20px">#</th>
              <th>TXID</th>
              <th>Customer</th>
              <th>Bukti</th>
              <th>Date Order</th>
              <th>Total</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($tables as $item)
              <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->order_id }}</td>
                <td>{{ $item->order->customer->name }}</td>
                <td class="text-center">
                  @if ($item->evidence_of_transfer == null)
                    Null
                  @else
                    <a href="{{ asset('storage/'.$item->evidence_of_transfer) }}" class="text-center btn btn-sm btn-info" target="_blank">{{ 'check' }}</a>
                  @endif
                </td>
                <td>{{ $item->order->order_date }}</td>
                <td>Rp. {{ number_format($item->order->total) }}</td>
                <td>{{ $item->status }}</td>
                <td class="text-center">
                  @if ($item->status == 'paid')
                    <a href="#" class="text-center btn btn-sm btn-success">{{ 'Paid' }}</a>
                  @elseif($item->status == 'processing')
                    <a href="/operator/payment/{{ $item->order_id }}/paid" class="text-center btn btn-sm btn-info" onclick="return confirm('Apakah anda yakin?')">{{ 'Confirmation Done' }}</a>
                  @else
                    <a href="/operator/payment/{{ $item->order_id }}/processing" class="text-center btn btn-sm btn-primary" onclick="return confirm('Apakah anda yakin?')">{{ 'Confirmation' }}</a>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection