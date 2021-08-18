@extends('user.layout')

@section('user_title','设置')
@section('user_body')
    <div class="user_setting">
        <ul>
            <li>
                <div class="set_field">
                    昵称
                </div>
                <div class="set_value">
                    {{me()->name}}
                </div>
            </li>
        </ul>
    </div>
@endsection
