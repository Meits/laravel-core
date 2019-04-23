<!-- Page header -->
<form class="form-validate-jquery" enctype="multipart/form-data" method="post"
      action="{{(isset($blog)) ? route('blogs.update',['blog'=>$blog->id])  : route('blogs.store') }}">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">{{$title}}</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success btn-labeled btn-labeled-left btn-lg legitRipple "><b><i
                                    class="icon-pin-alt"></i></b>{{__('blog.posts_form_submit_label')}}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">

        <!-- Input group addons -->
        <div class="card">

            <div class="card-body">

                @isset($blog)
                    @method('PUT')
                @endisset

                @csrf
                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold">{{__('blog.posts_form_common_info')}}</legend>


                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('blog.posts_form_titleH1_label')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input id="title_h1_blog" type="text" name="titleH1" required class="form-control"
                                       value="{{$blog->titleH1 ?? old('titleH1')}}"
                                       placeholder="{{__('blog.posts_form_titleH1_label')}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('blog.posts_form_alias_label')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input type="text" name="alias" required class="form-control"
                                       value="{{$blog->alias ?? old('alias')}}"
                                       placeholder="{{__('blog.posts_form_alias_label')}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('blog.posts_form_banner_label')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input type="file" name="banner" class="form-control">
                            </div>
                        </div>
                    </div>

                    @isset($blog->banner)
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">{{__('blog.posts_form_fields_uploaded_image')}}</label>
                            <div class="col-lg-10">
                                <div class="input-group">
                                    <img style="height: 100px;"
                                         src="{{ asset('storage/images/blog/'.$blog->banner) }}">
                                </div>
                            </div>
                        </div>
                    @endisset

                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">{{__('blog.posts_form_text_label')}}</h5>
                    </div>
                    <div class="mb-3">
                        <textarea rows="5" cols="5" name="text" id="text" class="editor" required
                                  placeholder="{{__('blog.posts_form_text_label')}}">{!!  $blog->text ?? old('text') !!}</textarea>
                    </div>

                </fieldset>

                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold">{{__('blog.posts_form_seo_info')}}</legend>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('blog.posts_form_title_label')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input type="text" name="title" required class="form-control"
                                       value="{{$blog->title ?? old('title')}}"
                                       placeholder="{{__('blog.posts_form_title_label')}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('blog.posts_form_description_label')}} <span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <textarea rows="5" cols="5" name="description" class="form-control" required
                                      placeholder="{{__('blog.posts_form_description_label')}}">{{$blog->description ?? old('description')}}</textarea>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold">{{__('blog.posts_form_relations_info')}}</legend>

                    @isset($blogs)
                        <div class="form-group">
                            <label>{{__('blog.posts_form_related_posts')}}</label>
                            <select name="blog_id[]" class="form-control multiselect" multiple="multiple" data-fouc>
                                @foreach($blogs as $item)
                                    <option @if(isset($blog) && in_array($item->id,$related)) selected
                                            @endif value="{{$item->id}}">{{$item->titleH1}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endisset

                </fieldset>

                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold">{{__('blog.posts_form_tips_info')}}</legend>

                    {{--<div id='row' class="input-group">
                        <input type="text" name="tips[]" class="form-control" value="" placeholder="">
                        <button id="" class="btn btn-light bootstrap-touchspin-down legitRipple btn_remove" type="button">–</button>
                    </div>--}}

                    @if(isset($blog) && $blog->tips)

                        @foreach($blog->tips as $tip)
                            <div id='row' class="input-group">
                                <input type="text" name="tips[{{$tip->id}}]" class="form-control" value="{{$tip->text}}"
                                       placeholder="">
                                <button id="" class="btn btn-light bootstrap-touchspin-down legitRipple btn_remove"
                                        type="button">–
                                </button>
                            </div>
                        @endforeach
                    @endif

                    <div class="form-group row">
                        <div class="col-lg-1 offset-lg-11" style="text-align: right;">
                            <button class="btn btn-light bootstrap-touchspin-up legitRipple btn_add" type="button">+
                            </button>
                        </div>
                    </div>


                </fieldset>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


            </div>
        </div>
        <!-- /input group addons -->

    </div>
</form>
<script>
    var i = 1;
    $(document).on('click', '.btn_add', function () {
        var commonDiv = $(this.closest('.form-group'));

        commonDiv.before(
            '<div  class="input-group">' +
            '<input type="text" name="tips[]" class="form-control" value="" placeholder="">' +
            '<button  class="btn btn-light bootstrap-touchspin-down legitRipple btn_remove" type="button">–</button>' +
            '</div>'
        );

    });
    $(document).on('click', '.btn_remove', function () {
        var commonDiv = $(this.closest('.input-group')).remove();

    });
</script>
<!-- /content area -->
