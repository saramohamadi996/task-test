@extends('master')
@section('content')
    <div class="row no-gutters">
        <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">دسته بندی ها</p>
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
                    @foreach($categories as $category)
                        <tr role="row" class="">
                            <td><a href="">{{ $category->id }}</a></td>
                            <td><a href="">{{ $category->title }}</a></td>
                            <td>{{ $category->parent }}</td>
                            <td>
                                <a href=""
                                   onclick="deleteItem(event, '{{ route('categories.delete', $category->id) }}')"
                                   class="item-delete mlg-15" title="حذف">
                                </a>
                                <a href="{{route('categories.show', $category->id)}}"
                                   target="_blank" class="item-eye mlg-15" title="مشاهده">
                                </a>
                                <a href="{{ route('categories.edit',  $category->id) }}"
                                   class="item-edit " title="ویرایش">
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection



