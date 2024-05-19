@extends('layouts.master')

@section('title','users Details')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
<section>
    <div class="card border-0 mb-3">
        <div class="card-body p-4">
            <div class="row g-3">
                <div class="col-lg-3">
                    <div class="card h-100">
                        <div class="card-body">
                            @if($user->image)
                                <img class="img-fluid rounded" src="{{ asset('storage/profile/'.$user->image) }}" alt="Profile Image" />
                            @else
                                <img class="img-fluid rounded" src="{{asset('assets/img/profile.jpg')}}" alt="Profile Image" />
                            @endif
                            <h5 class="mt-3"> {{$user->name}}</h5>
                            <p><i class="fa-solid fa-phone"></i> {{$user->phone}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0">
                        <div class="card-body">
                            <h4 class="mb-4"><i class="fa-solid fa-circle-info text-secondary"></i> Information</h4>
                            <div class="row mb-2">
                                <div class="col-md-5 col-sm-12"><i class="fa-regular fa-envelope me-2"></i> <strong>Email: </strong></div>
                                <div class="col-md-7 col-sm-12">{{$user->email}}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-5 col-sm-12"><i class="fa-solid fa-location-crosshairs me-2"></i> <strong>Farm Name: </strong></div>
                                <div class="col-md-7 col-sm-12">{{$user->farm_name}}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-5 col-sm-12"><i class="fa-solid fa-location-dot me-2"></i> <strong>Farm Location: </strong></div>
                                <div class="col-md-7 col-sm-12">{{$user->location}}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-5 col-sm-12"><i class="fa-solid fa-layer-group me-2"></i> <strong>Farm Size: </strong></div>
                                <div class="col-md-7 col-sm-12">{{$user->farm_size}} acres</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-5 col-sm-12"><i class="fa-brands fa-sourcetree me-2"></i> <strong>Water Source: </strong></div>
                                <div class="col-md-7 col-sm-12">{{$user->water_source}}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-5 col-sm-12"><i class="fa-solid fa-calendar-days me-2"></i> <strong>Establishment</strong></div>
                                <div class="col-md-7 col-sm-12">{{$user->establishment_date}}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-5 col-sm-12"><i class="fa-solid fa-certificate me-2"></i> <strong>Certifications: </strong></div>
                                <div class="col-md-7 col-sm-12">{{$user->certifications}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-3 mb-3">
        <div class="col-lg-4">
            <div class="card border-0 shadow">
            <div class="card-body">
                <div class="d-flex">
                <div class="">
                    <h6>Toal Ponds</h6>
                    <h3>{{App\Models\Pond::where('user_id', $user->id)->count()}}</h3>
                    <a href="#">More Details <i class="fa-solid fa-arrow-right"></i></a>
                </div>
                <img style="height: 100px" class="ms-auto" src="{{asset('assets/img/pond.png')}}" alt="">
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow">
            <div class="card-body">
                <div class="d-flex">
                <div class="">
                    <h6>Quantity Stocked</h6>
                    <h3>{{App\Models\Pond::where('user_id', $user->id)->sum('quantity')}}</h3>
                    <a href="#">More Details <i class="fa-solid fa-arrow-right"></i></a>
                </div>
                <img style="height: 100px" class="ms-auto" src="{{asset('assets/img/fish.png')}}" alt="">
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow">
            <div class="card-body">
                <div class="d-flex">
                <div class="">
                    <h6>Toal Cost</h6>
                    <h3><span>৳</span>500000</h3>
                    <a href="#">More Details <i class="fa-solid fa-arrow-right"></i></a>
                </div>
                <img style="height: 100px" class="ms-auto" src="{{asset('assets/img/money.png')}}" alt="">
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="card border-0 mb-3">
        <div class="card-header border-0 bg-white"><h5 class="mt-2"><i class="fa-solid fa-circle-info text-secondary"></i> Pond information</h5></div>
        <div class="card-body">
            <table id="example" class="table table-striped">
                <thead>
                    <tr>
                    <th>#SN</th>
                    <th>Pond name</th>
                    <th>Size</th>
                    <th>Type</th>
                    <th>Stock Date</th>
                    <th>Stocked</th>
                    <th>Species</th>
                    <th>Source</th>
                    <th>Density</th>
                    <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $ponds = App\Models\Pond::where('user_id', $user->id)->get();
                    @endphp
                    @foreach ($ponds as $key => $pond)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$pond->name}}</td>
                            <td>{{$pond->pond_size}}</td>
                            <td>{{$pond->pond_type}}</td>
                            <td>{{$pond->stock_date}}</td>
                            <td>{{$pond->quantity}}</td>
                            <td>{{$pond->species}}</td>
                            <td>{{$pond->source}}</td>
                            <td>{{$pond->density}}</td>
                            <td class="text-end">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$pond->slug}}" title="Edit"><i class="fa-regular fa-pen-to-square"></i></button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$pond->slug}}" tabindex="-1" aria-labelledby="exampleModal{{$pond->slug}}Label" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content p-4">
                                        <form action="{{route('user.pond.update',$pond->id)}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModal{{$pond->slug}}Label">Create Pond</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-start">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Pond name</label>
                                                            <input type="text" class="form-control" name="name" placeholder="Pond name name" value="{{$pond->slug}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="pond_size2" class="form-label">Pond size</label>
                                                            <input type="number" step=0.01 class="form-control" id="pond_size2" name="pond_size" placeholder="Pond size" value="{{$pond->pond_size}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-2">
                                                            <label for="pond_type" class="form-label">Pond type</label>
                                                            <select class="form-select bg-light" aria-label="Default select example" name="pond_type" id="pond_type" required>
                                                                <option value="Nursery" {{ $pond->pond_type == 'Nursery' ? 'selected' : '' }}>Nursery</option>
                                                                <option value="Grow out" {{ $pond->pond_type == 'Grow out' ? 'selected' : '' }}>Grow out </option>
                                                                <option value="Other" {{ $pond->pond_type == 'Other' ? 'selected' : '' }}>Other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="stock_date" class="form-label">Stock date</label>
                                                            <input type="date" class="form-control" id="stock_date" name="stock_date" placeholder="stock_date" value="{{$pond->stock_date}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="species" class="form-label">Species</label>
                                                            <input type="text" class="form-control" id="species" name="species" placeholder="Species" value="{{$pond->species}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="quantity2" class="form-label">Quantity Stocked</label>
                                                            <input type="number" class="form-control" id="quantity2" name="quantity" placeholder="Quantity" value="{{$pond->quantity}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-2">
                                                            <label for="source" class="form-label">Source</label>
                                                            <select class="form-select bg-light" aria-label="Default select example" name="source" id="source" required>
                                                                <option value="" selected>Select...</option>
                                                                <option value="Supplier" {{ $pond->source == 'Supplier' ? 'selected' : '' }}>Supplier</option>
                                                                <option value="Bred on the farm" {{ $pond->source == 'Bred on the farm' ? 'selected' : '' }}>Bred on the farm</option>
                                                                <option value="Obtained elsewhere" {{ $pond->source == 'Obtained elsewhere' ? 'selected' : '' }}>Obtained elsewhere</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="density2" class="form-label">Stocking Density</label>
                                                            <input type="number" step=0.01 class="form-control" id="density2" name="density" placeholder="density" value="{{$pond->density}}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                        <label for="note" class="form-label">Additional information (optional)</label>
                                                        <textarea class="form-control" id="note" rows="1" name="note">{{$pond->note}}</textarea>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update Pond</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-danger btn-sm" type="button" onclick="deletePond({{ $pond->id }})" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fa-regular fa-trash-can"></i></button>
                            <form id="delete-form-{{ $pond->id }}" action="{{ route('user.pond.destroy',$pond->id) }}" method="post" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card border-0 mb-3">
        <div class="card-header border-0 bg-white"><h5 class="mt-2"><i class="fa-solid fa-circle-info text-secondary"></i> Water Quality information</h5></div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped">
                    <thead>
                        <tr>
                        <th>#SN</th>
                        <th>Pond name</th>
                        <th>Reading date</th>
                        <th>Recorded by</th>
                        {{-- <th>note</th> --}}
                        <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ponds as $item)
                            @foreach ($item->waters as $key => $water)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$water->pond->name}}</td>
                                <td>{{$water->reading_date}}</td>
                                <td>{{$water->recorded_by}}</td>
                                {{-- <td>{{$water->note}}</td> --}}
                                <td class="text-end">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn text-warning btn-sm p-0" data-bs-toggle="modal" data-bs-target="#exampleModal{{$water->id}}" title="Edit">
                                <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$water->id}}" tabindex="-1" aria-labelledby="exampleModal{{$water->id}}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content p-4">
                                            <form action="{{route('user.water.update',$water->id)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModal{{$water->id}}Label"><i class="fa-solid fa-circle-info text-secondary"></i> Update Water Quality info</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-2">
                                                                <label for="pond_id" class="form-label">Pond Name</label>
                                                                <select class="form-select bg-light" aria-label="Default select example" name="pond_id" id="pond_id" required>
                                                                    @foreach ($ponds->where('user_id', Auth::id()) as $pond)
                                                                        <option 
                                                                            {{$water->pond_id == $pond->id ? 'selected' : ''}}
                                                                        value="{{$pond->id}}">{{$pond->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="reading_date" class="form-label">Reading date</label>
                                                                <input type="date" class="form-control" id="reading_date" name="reading_date" placeholder="reading_date" value="{{$water->reading_date}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="temperature" class="form-label">Temperature</label>
                                                                <input type="number" class="form-control" id="temperature" name="temperature" placeholder="Pond size" value="{{$water->temperature}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="ph_level" class="form-label">pH level</label>
                                                                <input type="number" step=0.01 class="form-control" id="ph_level" name="ph_level" placeholder="pH level" value="{{$water->ph_level}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="dissolved_oxygen" class="form-label">Dissolved Oxygen</label>
                                                                <input type="number" step=0.01 class="form-control" id="dissolved_oxygen" name="dissolved_oxygen" placeholder="Dissolved Oxygen" value="{{$water->dissolved_oxygen}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="ammonia_level" class="form-label">Ammonia_level</label>
                                                                <input type="number" step=0.01 class="form-control" id="ammonia_level" name="ammonia_level" placeholder="Ammonia level" value="{{$water->ammonia_level}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="nitrate_level" class="form-label">nitrate_level</label>
                                                                <input type="number" step=0.01 class="form-control" id="nitrate_level" name="nitrate_level" placeholder="Nitrate level" value="{{$water->nitrate_level}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="salinity" class="form-label">Salinity</label>
                                                                <input type="number" step=0.01 class="form-control" id="salinity" name="salinity" placeholder="Salinity" value="{{$water->salinity}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="alkalinity" class="form-label">Alkalinity</label>
                                                                <input type="number" step=0.01 class="form-control" id="alkalinity" name="alkalinity" placeholder="Alkalinity" value="{{$water->alkalinity}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="recorded_by" class="form-label">Recorded by</label>
                                                                <select class="form-select bg-light" aria-label="Default select example" name="recorded_by" id="recorded_by" required>
                                                                    <option value="Supervisor" {{$water->recorded_by == 'Supervisor' ? 'selected' : ''}}>Supervisor</option>
                                                                    <option value="Field Worker" {{$water->recorded_by == 'Field Worker' ? 'selected' : ''}}>Field Worker</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="mb-3">
                                                            <label for="note" class="form-label">Additional information (optional)</label>
                                                            <textarea class="form-control" id="note" rows="2" name="note">{{$water->note}}</textarea>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update Water data</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn text-danger btn-sm p-0" type="button" onclick="deleteWater({{ $water->id }})" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fa-regular fa-trash-can"></i></button>
                                <form id="delete-form-{{ $water->id }}" action="{{ route('user.water.destroy',$water->id) }}" method="post" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="button" class="btn text-primary btn-sm p-0" data-bs-toggle="modal" data-bs-target="#exampleModal-details{{$water->id}}" title="View DEtails">
                                <i class="fas fa-eye"></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal-details{{$water->id}}" tabindex="-1" aria-labelledby="exampleModal-details{{$water->id}}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModal{{$water->id}}Label"><i class="fa-solid fa-circle-info text-secondary"></i> Water Quality info</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <div class="card text-start border-0">
                                                    <div class="card-body">
                                                        <div class="row mb-3">
                                                            <div class="col-md-4 col-sm-12"><i class="fa-regular fa-square-check text-success me-1"></i> <strong>Pond name: </strong></div>
                                                            <div class="col-md-7 col-sm-12">{{$water->pond->name}}</div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-4 col-sm-12"><i class="fa-regular fa-square-check text-success me-1"></i> <strong>Reading Date: </strong></div>
                                                            <div class="col-md-7 col-sm-12">{{$water->reading_date}}</div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-4 col-sm-12"><i class="fa-regular fa-square-check text-success me-1"></i> <strong>Temperature: </strong></div>
                                                            <div class="col-md-7 col-sm-12">{{$water->temperature}}</div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-4 col-sm-12"><i class="fa-regular fa-square-check text-success me-1"></i> <strong>pH Level: </strong></div>
                                                            <div class="col-md-7 col-sm-12">{{$water->ph_level}}</div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-4 col-sm-12"><i class="fa-regular fa-square-check text-success me-1"></i> <strong>Dissolved Oxygen: </strong></div>
                                                            <div class="col-md-7 col-sm-12">{{$water->dissolved_oxygen}}</div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-4 col-sm-12"><i class="fa-regular fa-square-check text-success me-1"></i> <strong>Ammonia Level</strong></div>
                                                            <div class="col-md-7 col-sm-12">{{$water->ammonia_level}}</div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-4 col-sm-12"><i class="fa-regular fa-square-check text-success me-1"></i> <strong>Nitrate Level: </strong></div>
                                                            <div class="col-md-7 col-sm-12">{{$water->nitrate_level}}</div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-4 col-sm-12"><i class="fa-regular fa-square-check text-success me-1"></i><strong>Salinity: </strong></div>
                                                            <div class="col-md-7 col-sm-12">{{$water->salinity}}</div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-4 col-sm-12"><i class="fa-regular fa-square-check text-success me-1"></i> <strong>Alkalinity: </strong></div>
                                                            <div class="col-md-7 col-sm-12">{{$water->alkalinity}}</div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-4 col-sm-12"><i class="fa-regular fa-square-check text-success me-1"></i> <strong>Recorded by: </strong></div>
                                                            <div class="col-md-7 col-sm-12">{{$water->recorded_by}}</div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-4 col-sm-12"><i class="fa-regular fa-square-check text-success me-1"></i> <strong>Note: </strong></div>
                                                            <div class="col-md-7 col-sm-12">{{$water->note}}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card border-0 p-3">
        <div class="card-header bg-white border-0">
            <h5>Contact to user</h5>
        </div>
        <div class="card-body">
            <form action="{{route('admin.ticket.store')}}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="mb-3">
                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{$user->id}}">
                    <label class="form-label" for="exampleFormControlTextarea1">Message</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message"></textarea>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary px-3" type="submit">Send Message</button>
                </div>
            </form>
        </div>
    </div>
    @if ($user->tickets()->count() > 0)
    <div class="card mt-3 border-0 p-3">
        <div class="card-header border-0 bg-white">
            <div class="d-flex align-items-center">
                <h5 class="">All Message</h5>
                <button class="btn btn-danger btn-sm ms-auto" type="button" onclick="deleteTicket({{ $user->id }})" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><span class="text-500 fas fa-trash-alt"></span> Delete All</button>
                <form id="delete-form-{{ $user->id }}" action="{{ route('admin.ticket.destroy',$user->id) }}" method="post" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    
        <div class="card-body">
            @foreach ($user->tickets()->latest()->get() as $key => $message)
                @if (Auth::guard('admin')->user()->id == $message->admin_id)
                    <div class="d-flex align-items-cente mb-4">
                        <div class="me-2">
                            @if(Auth::guard('admin')->user()->image)
                            <img style="height: 30px; width:30px;" class="rounded-circle" src="{{ asset('storage/profile/'.Auth::guard('admin')->user()->image) }}" alt="Image" /> 
                            @else
                            <img style="height: 30px; width:30px;" class="rounded-circle" src="{{asset('assets/img/profile.jpg')}}" alt="Image" />
                            @endif
                        </div>
                        <div class="">
                            <p class="mb-1"><strong>You</strong> : {{$message->message}}</p>
                            <span class="small text-success">{{$message->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    
                @else
                    <div class="d-flex align-items-cente mb-4">
                        <div class="me-2">
                            @if($user->image)
                            <img style="height: 30px; width:30px;" class="rounded-circle" src="{{ asset('storage/profile/'.$user->image) }}" alt="Image" /> 
                            @else
                            <img style="height: 30px; width:30px;" class="rounded-circle" src="{{asset('assets/img/profile.jpg')}}" alt="" />
                            @endif
                        </div>
                        <div class="notification-body">
                            <p class="mb-1"><strong>{{$user->name}} (User) : </strong> {{$message->message}}</p>
                            <span class="text-secondary">{{$message->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    
                @endif
            @endforeach
        </div>
    </div>
    @endif
</section>

@endsection
@push('js')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
    new DataTable('#example');
    new DataTable('#example2');
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script type="text/javascript">
    function deletePayment(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('delete-form-' + id).submit();
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your data is safe :)',
                    'error'
                )
            }
        })
    }

    function deleteOrder(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('delete-form-' + id).submit();
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your data is safe :)',
                    'error'
                )
            }
        })
    }

    function deleteTicket(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('delete-form-' + id).submit();
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your data is safe :)',
                    'error'
                )
            }
        })
    }
</script>
@endpush
