@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{  route('courses.index')  }}" title="دوره ها">دوره ها</a></li>
    <li><a href="#" title="ایجاد دوره">ویرایش دوره</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-12 bg-white">
            <p class="box__title">ویرایش دوره</p>
            <div class="row no-gutters bg-white">
                <div class="col-12">
                    <form action="{{  route('courses.update', $course->id)  }}" class="padding-30" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <x-input name="title" value="{{  $course->title  }}" placeholder="عنوان دوره" type="text" required/>

                        <x-input name="slug" class="text-left " value="{{  $course->slug  }}"
                                 placeholder="نام انگلیسی دوره" type="text" required/>


                        <div class="d-flex multi-text">
                            <x-input type="text" value="{{  $course->priority  }}"
                                     class="text-left mlg-15" name="priority" placeholder="ردیف دوره"/>

                            <x-input type="text" value="{{  $course->price  }}"
                                     placeholder="مبلغ دوره" name="price" class="text-left" required/>

                            <x-input type="number" value="{{  $course->percent  }}"
                                     placeholder="درصد مدرس" name="percent" class="text-left" required/>

                        </div>

                        <x-select name="teacher_id" class="mb-0" required>
                            <option value="">انتخاب مدرس دوره</option>
                            @foreach($teachers as $teacher)
                                <option value="{{  $teacher->id  }}"
                                    @if($teacher->id == $course->teacher_id) selected @endif
                                >{{  $teacher->name  }}</option>
                            @endforeach
                        </x-select>


                        <x-tag-select name="tags"/>

                        <x-select name="type" required class="mt-2 mb-0">
                            <option value="">نوع دوره</option>
                            @foreach(\Darius\Course\Models\Course::$types as $type)
                                <option value="{{  $type  }}"
                                        @if($type == $course->type) selected @endif
                                >@lang($type)</option>
                            @endforeach
                        </x-select>


                        <x-select name="status" required class="mt-2 mb-0">
                            <option value="">وضعیت دوره</option>
                            @foreach(\Darius\Course\Models\Course::$statuses as $status)
                                <option value="{{  $status  }}"
                                        @if($status == $course->status) selected @endif
                                >@lang($status)</option>
                            @endforeach
                        </x-select>

                        <x-select name="category_id" required class="mt-2 mb-0">
                            <option value="">زیر دسته بندی</option>
                            @foreach($categories as $category)
                                <option value="{{  $category->id  }}"
                                        @if($category->id == $course->category_id) selected @endif
                                >{{  $category->title  }}</option>
                            @endforeach
                        </x-select>

                        <x-file placeholder="آپلود بنر دوره" name="image" :value="$course->banner"/>

                        <x-textarea placeholder="توضیحات دوره" name="body" value="{{  $course->body  }}" />

                        <br>

                        <button class="btn btn-brand mt-2">ویرایش دوره</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
