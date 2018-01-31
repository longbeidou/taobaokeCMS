@extends('admin.layouts.fooTable.index')

@section('title', $title)
@section('headcss')

@stop
@section('content')
  @include('admin.layouts.table._tips')
  @include('admin.layouts.fooTable._errors')

@stop
@section('footJs')

@stop
