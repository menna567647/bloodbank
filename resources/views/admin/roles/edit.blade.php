@extends('admin.layouts.main')
@section('content')
    <div class="container mt-3">
        <div class="row">
            <!-- left column -->
            <div class="col-md-10 m-auto">
                <!-- general form elements -->
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light border-bottom">
                        <h5 class="mb-0 fw-semibold text-dark">
                            <i class="fas fa-user-tag me-2 text-primary"></i> {{ __('messages.editrole') }}
                        </h5>
                    </div>
                    <form method="post" action="{{ route('admin.roles.update', $role->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{ __('messages.name') }}</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" placeholder="{{ __('messages.Enter Name') }}"
                                        value="{{ old('name', $role->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label
                                        class="form-label fw-bold mb-3 d-flex align-items-center justify-content-between">
                                        {{ __('messages.permissions') }}
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="selectAllBtn">
                                            {{ __('messages.checkall') }}
                                        </button>
                                    </label>

                                    @error('permissions')
                                        <div class="invalid-feedback d-block mb-3">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <div class="row">
                                        @foreach ($permissions->groupBy('group') as $group => $permissionList)
                                            @php
                                                $groupSlug = Str::slug($group);
                                            @endphp
                                            <div class="col-md-6 col-lg-4 mb-4">
                                                <div class="border rounded p-3 h-100">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <h5 class="mb-0 text-primary">{{ $group }}</h5>
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-primary group-select-btn"
                                                            data-group="{{ $groupSlug }}">
                                                            {{ __('messages.checkall') }}
                                                        </button>
                                                    </div>

                                                    @foreach ($permissionList as $permission)
                                                        <div class="form-check mb-2">
                                                            <input type="checkbox"
                                                                class="form-check-input permission-checkbox checkbox-group-{{ $groupSlug }} @error('permissions') is-invalid @enderror"
                                                                name="permissions[]" value="{{ $permission->name }}"
                                                                id="permission_{{ $permission->id }}"
                                                                {{ in_array($permission->name, old('permissions', $rolePermissions ?? [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="permission_{{ $permission->id }}">
                                                                {{ $permission->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <div class="d-flex justify-content-start align-items-center">
                                    <button type="submit" class="btn btn-outline-primary btn-sm mr-3">
                                        <i class="fas fa-save me-1"></i> {{ __('messages.edit') }}
                                    </button> <a href="{{ route('admin.roles.index') }}"
                                        class="btn btn-outline-success btn-sm"><i class="fa-solid fa-arrow-right"></i>
                                        {{ __('messages.back') }}</a>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.querySelectorAll('.group-select-btn').forEach(button => {
            button.addEventListener('click', function() {
                const group = this.dataset.group;
                const checkboxes = document.querySelectorAll(`.checkbox-group-${group}`);
                const allChecked = Array.from(checkboxes).every(cb => cb.checked);

                checkboxes.forEach(cb => cb.checked = !allChecked);

                this.textContent = allChecked ?
                    '{{ __('messages.checkall') }}' :
                    '{{ __('messages.uncheckall') }}';

                updateGlobalSelectAllBtn();
            });
        });

        document.getElementById('selectAllBtn').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.permission-checkbox');
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);
            checkboxes.forEach(cb => cb.checked = !allChecked);

            this.textContent = allChecked ?
                '{{ __('messages.checkall') }}' :
                '{{ __('messages.uncheckall') }}';

            updateGroupButtons();
        });

        function updateGroupButtons() {
            document.querySelectorAll('.group-select-btn').forEach(button => {
                const group = button.dataset.group;
                const checkboxes = document.querySelectorAll(`.checkbox-group-${group}`);
                const allChecked = Array.from(checkboxes).every(cb => cb.checked);
                button.textContent = allChecked ?
                    '{{ __('messages.uncheckall') }}' :
                    '{{ __('messages.checkall') }}';
            });
        }

        function updateGlobalSelectAllBtn() {
            const checkboxes = document.querySelectorAll('.permission-checkbox');
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);
            document.getElementById('selectAllBtn').textContent = allChecked ?
                '{{ __('messages.uncheckall') }}' :
                '{{ __('messages.checkall') }}';
        }

        updateGroupButtons();
        updateGlobalSelectAllBtn();
    </script>
@endpush
