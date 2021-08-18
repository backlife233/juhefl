@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '200')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
@php
    $right=1;
@endphp
