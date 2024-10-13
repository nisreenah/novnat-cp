@extends('admin.master')

@section('container')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add New Member Team</div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <form action="{{ route('teams.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="role">Member Role</label>
                                    <select id="role" name="role" class="single-select form-control">
                                        <option value="member" {{ old('role') == 'member' ? 'selected' : '' }}>Main Member</option>
                                        <option value="adviser" {{ old('role') == 'adviser' ? 'selected' : '' }}>Adviser</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Member Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                           value="{{ old('name') }}" placeholder="Enter member Name"/>
                                </div>
                                <div class="form-group">
                                    <label for="position">Member Position</label>
                                    <input type="text" name="position" class="form-control" id="position"
                                           value="{{ old('position') }}" placeholder="Enter member Position"/>
                                </div>

                                <div class="form-group">
                                    <label for="bio">Bio</label>
                                    <textarea rows="5" id="bio" name="bio" class="form-control">
                                        {{ old('bio') }}
                                    </textarea>
                                </div>

                            </div>

                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="linkedin_url">LinkedIn URL</label>
                                    <input type="url" name="linkedin_url" class="form-control" id="linkedin_url"
                                           placeholder="https://www.linkedin.com/" value="{{ old('linkedin_url') }}"/>
                                </div>

                                <div class="form-group">
                                    <label for="image">Member Image</label>
                                    <input type="file" name="image" class="form-control" id="image"/>
                                </div>

                                <!-- Hidden Field for Advisers -->
                                <div id="adviser_fields" style="display: none;">
                                    <div class="form-group">
                                        <label for="provide">Provide Us</label>
                                        <textarea rows="5" id="provide" name="provide" class="form-control">
                                             {{ old('provide') }}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button class="btn btn-danger">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        // Function to toggle the visibility of the adviser fields based on the selected role
        function toggleAdviserFields() {
            var role = document.getElementById('role').value;
            var adviserFields = document.getElementById('adviser_fields');

            if (role === 'adviser') {
                adviserFields.style.display = 'block';  // Show fields if role is 'adviser'
            } else {
                adviserFields.style.display = 'none';  // Hide fields for other roles
            }
        }

        // Attach change event listener to the role select box
        document.getElementById('role').addEventListener('change', function () {
            toggleAdviserFields();  // Trigger when the role is changed
        });

        // Trigger the function on page load to check the initial selection
        document.addEventListener('DOMContentLoaded', function () {
            toggleAdviserFields();  // Trigger on page load
        });
    </script>
@endsection
