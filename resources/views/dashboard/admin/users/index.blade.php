@extends('layouts.dashboard')

@section('title', 'User Management')

@section('header', 'User Management')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Users List</h3>
                <div class="filters">
                    <select class="form-select" id="roleFilter">
                        <option value="">All Roles</option>
                        <option value="user">Users</option>
                        <option value="business">Business</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td>
                                <span class="badge {{ $user->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-primary" onclick="editUser({{ $user->id }})">Edit</button>
                                    <form action="{{ route('admin.users.status', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm {{ $user->status === 'active' ? 'btn-danger' : 'btn-success' }}">
                                            {{ $user->status === 'active' ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No users found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            {{ $users->links() }}
        </div>
    </div>

    <style>
        .table {
            width: 100%;
            margin-bottom: 1rem;
        }
        .table th,
        .table td {
            padding: 1rem;
            vertical-align: middle;
        }
        .btn-group {
            gap: 0.5rem;
        }
        .filters {
            width: 200px;
        }
        .form-select {
            padding: 0.5rem;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
    </style>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleFilter = document.getElementById('roleFilter');
            
            roleFilter.addEventListener('change', function() {
                const role = this.value;
                window.location.href = `/admin/users?role=${role}`;
            });
        });

        function updateUserStatus(userId, status) {
            if (!confirm('Are you sure you want to update this user\'s status?')) {
                return;
            }

            fetch(`/admin/users/${userId}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert(data.message || 'An error occurred');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating user status');
            });
        }

        function editUser(userId) {
            window.location.href = `/admin/users/${userId}/edit`;
        }
    </script>
    @endpush
@endsection