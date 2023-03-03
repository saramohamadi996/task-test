@extends('master')
@section('content')
    <div class="row no-gutters">
        <div class="col-10 bg-white">
            <p class="box__title">ایجاد دسته بندی جدید</p>
            <form action="{{ route('categories.store') }}" method="post" class="padding-30">
                @csrf
                <input type="text" name="title" required placeholder="نام دسته بندی" class="text">
                <p class="box__title margin-bottom-15">انتخاب والد</p>
                <select name="parent_id" id="parent_id">
                    <option value="">ندارد</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
                <button class="btn btn-webamooz_net">اضافه کردن</button>
            </form>
        </div>
    </div>
@endsection
