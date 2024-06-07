<form method="post" id="role-form" class="save-form">
    @csrf
    <div class="card mb-3">
        <div class="modal fade" id="role-modal" aria-labelledby="role-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="role-modal-label">{{ __('Role') }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="role-name" class="col-sm-2 col-form-label">{{ __('Role name') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="role-name" value=""
                                    placeholder="{{ __('Enter a role name') }}">
                            </div>
                        </div>
                        <div class="row">
                            @php
                            use Spatie\Permission\Models\Permission;
                            $permissions = Permission::get();
                            @endphp
                            @foreach($permissions as $index => $permission)
                            @if($index == 0 || $permission->section != $permissions[$index-1]->section)
                            <div class="col-12 col-lg-4 col-md-6 mb-4">
                                <fieldset>
                                    <div class="d-flex">
                                        <div class="form-check form-switch d-flex align-items-center">
                                            <input class="form-check-input permissions h6 me-3" type="checkbox" role="switch" id="permissions-{{ $index }}">
                                        </div>
                                        <legend>
                                            <label class="form-check-label" for="permissions-{{ $index }}">{{ __($permission->section) }}</label>
                                        </legend>
                                    </div>
                                    @endif
                                    <div class="form-check form-switch">
                                        <input class="form-check-input permission" name="permissions[]" value="{{ $permission->id }}" type="checkbox" role="switch" id="permission-{{ $permission->id }}">
                                        <label class="form-check-label" for="permission-{{ $permission->id }}">{{ __($permission->name) }}</label>
                                    </div>
                                    @if($index == count($permissions)-1 || $permission->section != $permissions[$index+1]->section)
                                </fieldset>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        <hr class="px-5">
                        <div class="row align-items-center">
                            <div class="col-6">
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                @if (!empty(Auth::user()->hasAnyPermission(App\Models\User::UPDATE_ROLE,App\Models\User::CREATE_ROLE)))
                                <input type="hidden" name="id">
                                <button type="submit" id="role-submit" class="btn btn-primary">{{ __('Save') }}</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>