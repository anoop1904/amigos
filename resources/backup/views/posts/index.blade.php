@extends('layouts.master')


@section('content')
<div class="container-fluid">
  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
        
        <h4 class="page-title"><i class="fa fa-key"></i>Available Permissions
        <a href="{{ route('posts.create') }}" class="btn btn-default pull-right">Posts</a></h4>
      </div>
    </div> 
  </div>
  @if (count($errors) > 0)
  <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>
  </div>
@endif
  @if(Session::has('message'))
    <div class="alert alert-success login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('message') !!} </div>
  @endif
  <!-- end page title end breadcrumb -->
  <div class="row">
   
    <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-body">
          <h4 class="mt-0 header-title">Post List</h4>
          
          <table class="table table-dark">
            <thead>
              <tr>
                <th>#</th>
                <th>Title</th>
                <th>Body</th>
                <th>Operation</th>
              </tr>
            </thead>
            <tbody>
           @php $count = 1; @endphp
           @foreach ($posts as $post)
            <tr>
                <td>{{ $count }}</td>
                <td>{{ $post->title }}</td> 
                <td>{{  str_limit($post->body, 100) }} </td> 
                <td>
                <a href="{{ URL::to('admin/posts/'.$post->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                {!! Form::open(['method' => 'DELETE', 'route' => ['posts.destroy', $post->id] ]) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}

                </td>
            </tr>
            @php $count++; @endphp
            @endforeach
             
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- end col -->
  </div>
  <!-- end row -->
</div>
<!-- end container -->
@endsection