@extends('layouts.template')

@section('title')
Home
@endsection

@section('content')
<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h1>{{ $title }}</h1>
    <h3 class="pt-1 mb-3">All Items</h3>
    <div class="row">
        <table class="table table-striped">
            <thead class="table-head">
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Stock</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              @php $i = 1; @endphp
              @foreach ($produk as $prd)
                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $prd->nama_produk }}</td>
                  <td>{{ $prd->kategori }}</td>
                  <td>{{ $prd->jumlah_barang }}</td>
                  <td>
                    <form action="{{ route('produk.destroy', $prd->nama_produk) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                 </td>
                </tr>
                @php $i++; @endphp
              @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
