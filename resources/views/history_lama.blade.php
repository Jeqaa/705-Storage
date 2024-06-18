@extends('layouts.template');

@section('title')
History
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
              <th>Last Modified</th>
              <th>Edited By</th>
            </tr>
          </thead>
          <tbody>
            <tr class="itemsRow">
              <td>Neckar Hijau</td>
              <td>Neckar</td>
              <td>100</td>
              <td>20 minutes ago</td>
              <td>Gabriel</td>
            </tr>
            <tr class="itemsRow">
              <td>Neckar Hijau</td>
              <td>Neckar</td>
              <td>100</td>
              <td>20 minutes ago</td>
              <td>Gabriel</td>
            </tr>
            <tr class="itemsRow">
              <td>Neckar Hijau</td>
              <td>Neckar</td>
              <td>100</td>
              <td>20 minutes ago</td>
              <td>Gabriel</td>
            </tr>
            <tr class="itemsRow">
              <td>Neckar Hijau</td>
              <td>Neckar</td>
              <td>100</td>
              <td>20 minutes ago</td>
              <td>Gabriel</td>
            </tr>
            <tr class="itemsRow">
              <td>Neckar Hijau</td>
              <td>Neckar</td>
              <td>100</td>
              <td>20 minutes ago</td>
              <td>Gabriel</td>
            </tr>
            <tr class="itemsRow">
              <td>Neckar Hijau</td>
              <td>Neckar</td>
              <td>100</td>
              <td>20 minutes ago</td>
              <td>Gabriel</td>
            </tr>
            <tr class="itemsRow">
              <td>Neckar Hijau</td>
              <td>Neckar</td>
              <td>100</td>
              <td>20 minutes ago</td>
              <td>Gabriel</td>
            </tr>
            <tr class="itemsRow">
              <td>Neckar Hijau</td>
              <td>Neckar</td>
              <td>100</td>
              <td>20 minutes ago</td>
              <td>Gabriel</td>
            </tr>
            <tr class="itemsRow">
              <td>Neckar Hijau</td>
              <td>Neckar</td>
              <td>100</td>
              <td>20 minutes ago</td>
              <td>Gabriel</td>
            </tr>
            <tr class="itemsRow">
              <td>Neckar Hijau</td>
              <td>Neckar</td>
              <td>100</td>
              <td>20 minutes ago</td>
              <td>Gabriel</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
@endsection