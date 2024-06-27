@extends('layoutslte.template')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if (session('success'))
        Swal.fire({
            title: 'Success',
            text: '{{ session('success') }}',
            icon: 'success',
            showConfirmButton: true,
        });
    @endif

    @if (session('error'))
        Swal.fire({
            title: 'Error',
            text: '{{ session('error') }}',
            icon: 'error',
            showConfirmButton: true,
        });
    @endif
</script>

<style>
    .table-announcements .highlight-row {
        background-color: #ffc107; /* Yellow color for highlighted row */
        font-weight: bold; /* Bold font for highlighted row */
    }
</style>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Announcements</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
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

            <div class="row">
                <div class="col-12 mb-2">
                    <a href="#" class="btn btn-primary" id="toggleAddForm">Add Announcement</a>
                </div>
            </div>

            <div class="row" id="addAnnouncementForm" style="display: none;">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Announcement</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('announcement.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="content" class="form-label">Content</label>
                                    <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="w-100">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <div id="container-table" class="overflow-hidden">
                                @if ($announcements->count() > 0)
                                    <table class="table table-announcements mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th class="text-center">Title</th>
                                                <th class="text-center">Content</th>
                                                <th class="text-center">Actions</th>
                                                <th class="text-center">Select</th> {{-- Add a new column for selection --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($announcements as $announcement)
                                                <tr class="{{ $announcement->show ? 'highlight-row' : '' }}">
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td class="text-center">{{ $announcement->title }}</td>
                                                    <td class="text-center">{{ $announcement->content }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('announcement.edit', $announcement->id) }}" class="btn btn-warning">Edit</a>
                                                        <form action="{{ route('announcement.delete', $announcement->id) }}" method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger swa2-confirm-delete" onclick="return confirmDelete()">Delete</button>
                                                        </form>
                                                    </td>
                                                    <td class="text-center">
                                                        <form action="{{ route('announcement.toggle-show', $announcement->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-{{ $announcement->show ? 'danger' : 'primary' }}">
                                                                {{ $announcement->show ? 'Remove' : 'Select' }}
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <!-- Display pagination links -->
                                    <div class="pagination-links">
                                        {{ $announcements->links() }}
                                    </div>
                                @else
                                    <p class="text-danger font-weight-bold text-center pt-3">No announcements found.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle add announcement form visibility
    document.getElementById('toggleAddForm').addEventListener('click', function() {
        document.getElementById('addAnnouncementForm').style.display = 'block';
    });

    // Function to confirm delete action
    function confirmDelete() {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.closest('form').submit();
            }
        });
    }
</script>
@endsection
