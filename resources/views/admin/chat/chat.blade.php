@extends('admin.layouts.master')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Chat</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Chat</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="d-lg-flex">
    <div class="chat-leftsidebar me-lg-4">
        <div class="">
            <div class="py-4 border-bottom">
                <div class="media">
                    <div class="align-self-center me-3">
                        <img src="{{ asset('storage/user/'.Auth::user()->image) }}" class="avatar-xs rounded-circle" alt="">
                    </div>
                    <div class="media-body">
                        <h5 class="font-size-15 mt-0 mb-1">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</h5>
                        <p class="text-muted mb-0"><i class="fas fa-circle text-success align-middle me-1"></i> Online</p>
                    </div>

                    <div>
                        <div class="dropdown chat-noti-dropdown active">
                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-bell bx-tada"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                              <a class="dropdown-item" href="chat.html#">Action</a>
                              <a class="dropdown-item" href="chat.html#">Another action</a>
                              <a class="dropdown-item" href="chat.html#">Something else here</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="search-box chat-search-box py-4">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <i class="bx bx-search-alt search-icon"></i>
                </div>
            </div>

            <div class="chat-leftsidebar-nav">
                <ul class="nav nav-pills nav-justified">
                    <li class="nav-item">
                        <a href="chat.html#chat" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                            <i class="bx bx-chat font-size-20 d-sm-none"></i>
                            <span class="d-none d-sm-block">Chat</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="chat.html#contacts" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                            <i class="bx bx-book-content font-size-20 d-sm-none"></i>
                            <span class="d-none d-sm-block">Contacts</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content py-4">
                    <div class="tab-pane show active" id="chat">
                        <div>
                            <h5 class="font-size-14 mb-3">Recent</h5>
                            <ul class="list-unstyled chat-list" data-simplebar style="max-height: 410px;">
                                <li class="active">
                                    <a href="chat.html#">
                                        <div class="media">
                                            <div class="align-self-center me-3">
                                                <i class="fas fa-circle text-success font-size-10"></i>
                                            </div>
                                            <div class="align-self-center me-3">
                                                <img src="assets/images/users/avatar-2.jpg" class="rounded-circle avatar-xs" alt="">
                                            </div>
                                            
                                            <div class="media-body overflow-hidden">
                                                <h5 class="text-truncate font-size-14 mb-1">Steven Franklin</h5>
                                                <p class="text-truncate mb-0">Hey! there I'm available</p>
                                            </div>
                                            <div class="font-size-11">05 min</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="tab-pane" id="contacts">
                        <h5 class="font-size-14 mb-3">Contacts</h5>

                        <div  data-simplebar style="max-height: 410px;">
                            <div>
                                <div class="avatar-xs mb-3">
                                    <span class="badge bg-primary">
                                        Admins
                                    </span>
                                </div>

                                <ul class="list-unstyled chat-list">
                                    @foreach ($users as $user)
                                    @if ($user->hasRole('admin'))
                                    <li>
                                        <a href="#">
                                            <h5 class="font-size-14 mb-0">{{ $user->first_name.' '.$user->last_name }}</h5>
                                        </a>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>

                            <div class="mt-4">
                                <div class="avatar-xs mb-3">
                                    <span class="badge bg-primary">
                                        Doctors
                                    </span>
                                </div>

                                <ul class="list-unstyled chat-list">
                                    @foreach ($users as $user)
                                    @if ($user->hasRole('doctor'))
                                    <li>
                                        <a href="#">
                                            <h5 class="font-size-14 mb-0">{{ $user->first_name.' '.$user->last_name }}</h5>
                                        </a>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>

                            <div class="mt-4">
                                <div class="avatar-xs mb-3">
                                    <span class="badge bg-primary">
                                        Patients
                                    </span>
                                </div>

                                <ul class="list-unstyled chat-list">
                                    @foreach ($users as $user)
                                    @if ($user->hasRole('patient'))
                                    <li>
                                        <a href="#">
                                            <h5 class="font-size-14 mb-0">{{ $user->first_name.' '.$user->last_name }}</h5>
                                        </a>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="w-100 user-chat">
        <div class="card">
            <div class="p-4 border-bottom ">
                <div class="row">
                    <div class="col-md-4 col-9">
                        <h5 class="font-size-15 mb-1">Steven Franklin</h5>
                        <p class="text-muted mb-0"><i class="fas fa-circle text-success align-middle me-1"></i> Active now</p>
                    </div>
                    <div class="col-md-8 col-3">
                        <ul class="list-inline user-chat-nav text-end mb-0">
                            <li class="list-inline-item d-none d-sm-inline-block">
                                <div class="dropdown">
                                    <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-search-alt-2"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-md">
                                        <form class="p-3">
                                            <div class="form-group m-0">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                                    
                                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                                    
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            <li class="list-inline-item  d-none d-sm-inline-block">
                                <div class="dropdown">
                                    <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-cog"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="chat.html#">View Profile</a>
                                        <a class="dropdown-item" href="chat.html#">Clear chat</a>
                                        <a class="dropdown-item" href="chat.html#">Muted</a>
                                        <a class="dropdown-item" href="chat.html#">Delete</a>
                                    </div>
                                </div>
                            </li>

                            <li class="list-inline-item">
                                <div class="dropdown">
                                    <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-horizontal-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="chat.html#">Action</a>
                                        <a class="dropdown-item" href="chat.html#">Another action</a>
                                        <a class="dropdown-item" href="chat.html#">Something else</a>
                                    </div>
                                </div>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>


            <div>
                <div class="chat-conversation p-3">
                    <ul class="list-unstyled mb-0" data-simplebar style="max-height: 486px;">
                        <li> 
                            <div class="chat-day-title">
                                <span class="title">Today</span>
                            </div>
                        </li>
                        <li>
                            <div class="conversation-list">
                                <div class="dropdown">

                                    <a class="dropdown-toggle" href="chat.html#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="chat.html#">Copy</a>
                                        <a class="dropdown-item" href="chat.html#">Save</a>
                                        <a class="dropdown-item" href="chat.html#">Forward</a>
                                        <a class="dropdown-item" href="chat.html#">Delete</a>
                                    </div>
                                </div>
                                <div class="ctext-wrap">
                                    <div class="conversation-name">Steven Franklin</div>
                                    <p>
                                        Hello!
                                    </p>
                                    <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:00</p>
                                </div>
                                
                            </div>
                        </li>

                        <li class="right">
                            <div class="conversation-list">
                                <div class="dropdown">

                                    <a class="dropdown-toggle" href="chat.html#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="chat.html#">Copy</a>
                                        <a class="dropdown-item" href="chat.html#">Save</a>
                                        <a class="dropdown-item" href="chat.html#">Forward</a>
                                        <a class="dropdown-item" href="chat.html#">Delete</a>
                                    </div>
                                </div>
                                <div class="ctext-wrap">
                                    <div class="conversation-name">Henry Wells</div>
                                    <p>
                                        Hi, How are you? What about our next meeting?
                                    </p>

                                    <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:02</p>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="conversation-list">
                                <div class="dropdown">

                                    <a class="dropdown-toggle" href="chat.html#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="chat.html#">Copy</a>
                                        <a class="dropdown-item" href="chat.html#">Save</a>
                                        <a class="dropdown-item" href="chat.html#">Forward</a>
                                        <a class="dropdown-item" href="chat.html#">Delete</a>
                                    </div>
                                </div>
                                <div class="ctext-wrap">
                                    <div class="conversation-name">Steven Franklin</div>
                                    <p>
                                        Yeah everything is fine
                                    </p>
                                    
                                    <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:06</p>
                                </div>
                                
                            </div>
                        </li>

                        <li class="last-chat">
                            <div class="conversation-list">
                                <div class="dropdown">

                                    <a class="dropdown-toggle" href="chat.html#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="chat.html#">Copy</a>
                                        <a class="dropdown-item" href="chat.html#">Save</a>
                                        <a class="dropdown-item" href="chat.html#">Forward</a>
                                        <a class="dropdown-item" href="chat.html#">Delete</a>
                                    </div>
                                </div>
                                <div class="ctext-wrap">
                                    <div class="conversation-name">Steven Franklin</div>
                                    <p>& Next meeting tomorrow 10.00AM</p>
                                    <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:06</p>
                                </div>
                                
                            </div>
                        </li>

                        <li class=" right">
                            <div class="conversation-list">
                                <div class="dropdown">

                                    <a class="dropdown-toggle" href="chat.html#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                      </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="chat.html#">Copy</a>
                                        <a class="dropdown-item" href="chat.html#">Save</a>
                                        <a class="dropdown-item" href="chat.html#">Forward</a>
                                        <a class="dropdown-item" href="chat.html#">Delete</a>
                                    </div>
                                </div>
                                <div class="ctext-wrap">
                                    <div class="conversation-name">Henry Wells</div>
                                    <p>
                                        Wow that's great
                                    </p>

                                    <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:07</p>
                                </div>
                            </div>
                        </li>
                        
                        
                    </ul>
                </div>
                <div class="p-3 chat-input-section">
                    <div class="row">
                        <div class="col">
                            <div class="position-relative">
                                <input type="text" class="form-control chat-input" placeholder="Enter Message...">
                                <div class="chat-input-links" id="tooltip-container">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item"><a href="chat.html#" title="Emoji"><i class="mdi mdi-emoticon-happy-outline"></i></a></li>
                                        <li class="list-inline-item"><a href="chat.html#" title="Images"><i class="mdi mdi-file-image-outline"></i></a></li>
                                        <li class="list-inline-item"><a href="chat.html#" title="Add Files"><i class="mdi mdi-file-document-outline"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection