@extends('admin.master')

@section('container')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">All Sliders</h4>
                        <a href="{{ route('sliders.create') }}" class="btn btn-primary btn-round ms-auto">
                            <i class="fa fa-plus"></i>
                            Add Slider
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Media</th>
                                <th>Title</th>
                                <th>Updated At</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sliders as $slider)
                                <tr>
                                    <td>{{ $slider->id }}</td>
                                    <td>
                                        @if($slider->media)
                                            @php
                                                // Get the file extension of the uploaded media
                                                $extension = pathinfo($slider->media, PATHINFO_EXTENSION);

                                                // Define image and video extensions
                                                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                                $videoExtensions = ['mp4', 'avi', 'mov', 'webm'];
                                            @endphp

                                            @if(in_array(strtolower($extension), $imageExtensions))
                                                <!-- Display image -->
                                                <img src="{{ Storage::url('upload/sliders/'. $slider->media ) }}"
                                                     alt="Uploaded Image" width="75px">

                                            @elseif(in_array(strtolower($extension), $videoExtensions))
                                                <!-- Display video -->
                                                <video width="120" controls>
                                                    <source src="{{ Storage::url('upload/sliders/'. $slider->media ) }}"
                                                            type="video/{{ $extension }}">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @else
                                                <p>Unsupported media type.</p>
                                            @endif
                                        @else
                                            <p>No media uploaded.</p>
                                        @endif
                                    </td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->updated_at }}</td>
                                    <td>
                                        <div class="form-button-action">
                                            <a href="{{ route('sliders.edit', $slider->id) }}" type="button"
                                               data-bs-toggle="tooltip" title="edit"
                                               class="btn btn-link btn-primary btn-lg"
                                               data-original-title="Edit Task">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-link btn-danger"
                                                    data-bs-toggle="modal" title="delete"
                                                    data-original-title="Remove"
                                                    data-bs-target="#Modal{{$slider->id}}">
                                                <i class="fa fa-times"></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="Modal{{$slider->id}}" tabindex="-1"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Are You
                                                                Sure?</h5>
                                                            <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">Are you sure that you want to delete
                                                            this
                                                            item?
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                Close
                                                            </button>

                                                            <form action="{{ route('sliders.destroy', $slider->id) }}"
                                                                  method="post">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger px-5">
                                                                    Yes, delete
                                                                </button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
