@extends('layouts.dashboard')

@section('title', 'Category Management')

@section('header', 'Category Management')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Categories</h3>
                <button class="btn btn-primary" onclick="createCategory()">Add Category</button>
            </div>
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Listings Count</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->listings_count }}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-primary" onclick="editCategory({{ $category->id }})">Edit</button>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No categories found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $categories->links() }}
        </div>
    </div>

    <!-- Category Modal -->
    <div class="modal" id="categoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add/Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="categoryForm" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveCategory()">Save</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let categoryModal = null;
        let currentCategoryId = null;

        document.addEventListener('DOMContentLoaded', function() {
            categoryModal = new bootstrap.Modal(document.getElementById('categoryModal'));
        });

        function createCategory() {
            currentCategoryId = null;
            document.getElementById('categoryForm').reset();
            document.querySelector('.modal-title').textContent = 'Add Category';
            categoryModal.show();
        }

        function editCategory(id) {
            currentCategoryId = id;
            fetch(`/admin/categories/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('name').value = data.name;
                    document.getElementById('description').value = data.description;
                    document.querySelector('.modal-title').textContent = 'Edit Category';
                    categoryModal.show();
                });
        }

        function saveCategory() {
            const form = document.getElementById('categoryForm');
            const formData = new FormData(form);
            const url = currentCategoryId 
                ? `/admin/categories/${currentCategoryId}` 
                : '/admin/categories';
            const method = currentCategoryId ? 'PUT' : 'POST';

            fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    categoryModal.hide();
                    window.location.reload();
                } else {
                    alert(data.message || 'An error occurred');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while saving the category');
            });
        }

        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this category?')) {
                document.querySelector(`#deleteForm${id}`).submit();
            }
        }
    </script>
    @endpush

    <style>
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
        }
        .modal.show {
            display: block;
        }
        .modal-dialog {
            margin: 1.75rem auto;
            max-width: 500px;
        }
        .modal-content {
            background: white;
            border-radius: 8px;
        }
        .form-control {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 0.25rem;
        }
    </style>
@endsection