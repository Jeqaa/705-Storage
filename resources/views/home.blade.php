@extends('layouts.template');

@section('title')
Home
@endsection

@section('content')
    <!-- Main Content -->
    <div class="container-fluid">
      <h1>{{ $title }}</h1>
      <h3 class="pt-1 mb-3">All Items</h3>
      <div class="row">
        <table class="table table-striped">
          <thead class="table-head">
            <tr>
              <th>Name</th>
              <th>Category</th>
              <th>Stock</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr class="itemsRow">
              <td>namanyaaaaaaaaa</td>
              <td>categorynyaaaaaaa</td>
              <td>101</td>
              <td class="tdBtn">
                <button class="editBtn me-4 rounded-2">Edit</button>
                <button class="deleteBtn rounded-2">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

@endsection