@extends('layouts.nav')
@section('content')
     <style>
         label{
             font: 18px bold;
         }
     </style>
    <audio class="bell" src="bell.mp3"></audio>
     <div class="card-header" style="text-align: center;  font: 25px bold;">
         Add new book
     </div>
    <div class="container mt-5">
        {!! Form::open(['route' => 'adminBooks.store','enctype'=>'multipart/form-data']) !!}
        <div class="form-group">
            {!! Form::label('title', 'Book Title', ['class' => 'awesome']); !!}
            {!! Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Title....'] ) !!}
        </div>
        <div class="form-group">
            {!! Form::label('amount', 'Amount', ['class' => 'awesome']); !!}
            {!! Form::number('amount', 1, ['class'=>'form-control'] ) !!}
        </div>
        <div class="form-group">
            {!! Form::label('author', 'Author', ['class' => 'awesome']); !!}
            {!! Form::text('author', null, ['class'=>'form-control', 'placeholder'=>'Author...'] ) !!}
        </div>
        <div class="form-group">
            {!! Form::label('description', 'Description', ['class' => 'awesome']); !!}
            {!! Form::textarea('description', null, ['class'=>'form-control', 'placeholder'=>'text...'] ) !!}
        </div>
        <div class="form-group">
            {!! Form::label('price', 'Price', ['class' => 'awesome']); !!}
            {!! Form::number('price',50, ['class'=>'form-control'] ) !!}
        </div>
        <div class="form-group">
            {!! Form::label('cate_id', 'Category', ['class' => 'awesome']); !!}
            {{ Form::select('cate_id', $categories, null, ['class'=>'form-control','required'=>'true']) }}
        </div>
        <div class="form-group">
            {!! Form::label('book_img', 'Image', ['class' => 'awesome']); !!}
            {!! Form::file('book_img', ['class'=>'form-control-file'] ) !!}
        </div>
             <div style="margin-left:520px">
                 {!! Form::submit('ADD',['class'=>'btn btn-dark']); !!}
             </div>

        {!! Form::close() !!}
    </div>
@endsection
