@extends('backend.layout.layout')
@section('content')
<section class="content-header">
    <h1>
      All Order
      <small>All order are displaying in here</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
      <li class="active">Here</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">

    <!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered">
          <tr>
            <th style="width: 10px">#</th>
            <th>Package</th>
            <th>Payment</th>
            <th>Customer Name</th>
            <th>Customer Phone</th>

          </tr>
          @foreach ($orders as $order)
          <tr>
            <td>1.</td>
          <td><span class="badge bg-red">{{ $order->package_name }}</span></td>
          <td><span class="badge bg-light-blue">{{ $order->payement_gateway }}</span></td>
          <td><span class="badge bg-light-blue">{{ $order->billing_name }}</span></td>
          <td><span class="badge bg-green">{{ $order->billing_phone }}</span></td>
          </tr>
          @endforeach

        </table>
      </div>
      <!-- /.box-body -->

  </section>
@endsection
