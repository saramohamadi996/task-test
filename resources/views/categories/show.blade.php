@extends('master')
@section('content')
    <div class="row no-gutters">
        <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title"><a href="{{route('categories.index')}}">بازگشت</a></p>

            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>نام دسته بندی</th>
                        <th>والد</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr role="row" class="">
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->parent }}</td>
                        <td>
                            <a href=""
                               onclick="deleteItem(event, '{{ route('categories.delete', $category->id) }}')"
                               class="item-delete mlg-15" title="حذف">
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
