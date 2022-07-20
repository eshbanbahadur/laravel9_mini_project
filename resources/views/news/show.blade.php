@extends('layouts.app')

@section('content')


    <div class="row justify-content-center">
        <div class="col-lg-8 margin-tb">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5">
                        <h2>All News</h2>
                    </div>
                </div>

                <div class="col-md-12 text-end mt-4">
                    <a class="btn btn-primary" href="news/create">Add News</a>
                </div>

            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8 margin-tb">
            @if (session('success'))
                <div>&nbsp;</div>
                <div class="alert alert-danger">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>





    <div class="row justify-content-center mt-5">
        <div class="col-lg-8 margin-tb">
            <table class="table table-bordered">


                <tr>
                    <th>User Id</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Action</th>
                </tr>

                @foreach ($news as $news)
                <tr>
                    <td>{{$news->id}}</td>
                    <td>{{$news->title}}</td>
                    <td>{{$news->content}}</td>
                    <td>
                        <form action="{{ route('news.destroy',$news->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-primary" href="{{ route('news.edit',$news->id) }}">Edit</a>
                            <button type="submit" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
