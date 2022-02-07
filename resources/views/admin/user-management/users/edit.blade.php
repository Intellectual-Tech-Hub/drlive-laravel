@extends('admin.layouts.master')
@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Edit User</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Edit User</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit User</h4>

                <form method="POST" action="{{ route('users.update',$user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row"> 
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">First Name</label>
                                <input type="text" name="first_name" value="{{ $user->first_name }}" class="form-control" id="formrow-email-input">
                                @error('first_name')
                                    <span class="badge badge-soft-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-password-input" class="form-label">Last Name</label>
                                <input type="text" name="last_name" value="{{ $user->last_name }}" class="form-control" id="formrow-password-input">
                                @error('last_name')
                                    <span class="badge badge-soft-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Email</label>
                                <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="formrow-email-input">
                                @error('email')
                                    <span class="badge badge-soft-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-password-input" class="form-label">Password</label>
                                <input type="password" name="password" value="{{ old('password') }}" class="form-control" id="formrow-password-input">
                                @error('password')
                                    <span class="badge badge-soft-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Address</label>
                                <textarea name="address" class="form-control" id="formrow-email-input">{!! $user->address !!}</textarea>
                                @error('address')
                                    <span class="badge badge-soft-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Place</label>
                                <input type="text" name="place" value="{{ $user->place }}" class="form-control" id="formrow-password-input">
                                @error('place')
                                    <span class="badge badge-soft-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <select class="form-control select2" name="gender">
                                    <option value="">Select</option>
                                    <option value="male" {{ old('gender', ($user->gender == 'male' ? 'selected' : '')) }}>Male</option>
                                    <option value="female" {{ old('gender', ($user->gender == 'female' ? 'selected' : '')) }}>Female</option>
                                </select>
                                @error('gender')
                                    <span class="badge badge-soft-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Photo</label>
                                <input type="file" name="image" value="{{ old('image') }}" class="form-control" id="formrow-password-input">
                                @error('image')
                                    <span class="badge badge-soft-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-password-input" class="form-label">Phone</label>
                                <input type="text" name="phone" value="{{ $user->phone }}" class="form-control" id="formrow-password-input">
                                @error('phone')
                                    <span class="badge badge-soft-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-password-input" class="form-label">Pin</label>
                                <input type="text" name="pin" value="{{ $user->pin }}" class="form-control" id="formrow-password-input">
                                @error('pin')
                                    <span class="badge badge-soft-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Role</label>
                                <select class="form-control select2" name="role">
                                    <option value="">Select</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ old('role', ($user->roles[0]['id'] == $role->id ? 'selected' : '')) }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="badge badge-soft-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-control select2" name="status">
                                    <option value="">Select</option>
                                    <option value="1" {{ old('status', ($user->status == '1' ? 'selected' : '')) }}>Active</option>
                                    <option value="0" {{ old('status', ($user->status == '0' ? 'selected' : '')) }}>Inactive</option>
                                </select>
                                @error('status')
                                    <span class="badge badge-soft-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Update</button>
                    </div>
                </form>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
</div>
<!-- end row -->

@endsection

@push('script')
<script src="https://cdn.tiny.cloud/1/odznz7ajohaam8oa0hn79g5yty47asxu4lg8qb3y24i94499/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">
    tinymce.init({
        selector: 'textarea',
        height: 200,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
        content_css: '//www.tiny.cloud/css/codepen.min.css'
    });
</script>
@endpush