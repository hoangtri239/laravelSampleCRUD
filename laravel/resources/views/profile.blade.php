@extends('layouts.master')

@section('content')
<style>
    .profile-picture{
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        height: calc(100% - 32px);
        border: 1px dashed #333;
        flex-direction: column;
        margin: 16px;
    }
    .profile-picture img{
        width: 300px;
        cursor: pointer;
        height: 300px;
        object-fit: cover;
    }
    .text-message{
        position: absolute;
        bottom: 0;
    }
</style>
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-5 d-block">
                <div class="profile-picture">
                    <p class="text-center text-white p-2 bg-success text-message" id="message-success" style="display: none;"></p>
                    <p class="text-center text-white p-2 bg-danger text-message" id="message-error" style="display: none;"></p>
                    <img 
                        src="{{url('storage/'.\Auth::user()->avatar)}}" 
                        onerror="if (this.src != '{{url("user.png")}}') this.src = '{{url("user.png")}}';"
                    />
                    <input type="file" class="d-none avatar-upload" id="avatar-file" name="avatar" accept="image/x-png, image/jpeg, .jpg" action="{{route('uploadAvatar')}}"/>
                </div>
            </div>
            <div class="col-lg-7" id="update_user_information">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Complete your Profile!</h1>
                    </div>
                    <form class="user" action="{{route('editProfile')}}" id="formEditProfile">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" placeholder="Full Name" name="name" value="{{\Auth::user()->name}}" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" placeholder="Mobile phone" name="phone" value="{{\Auth::user()->phone}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" value="{{\Auth::user()->email}}"  readonly/>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Save
                        </button>
                    </form>
                    <hr>
                    <p class="text-center text-white p-2 bg-success text-message" id="message-success" style="display: none;"></p>
                    <p class="text-center text-white p-2 bg-danger text-message" id="message-error" style="display: none;"></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection