<!-- Page header -->
<form class="form-validate-jquery" enctype="multipart/form-data" method="post"
      action="{{route('blogs-comments.update',['blog'=>$blogComment->id]) }}">
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


                @method('PUT')

                @csrf
                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold">{{__('blog.comments_form_common_info')}}</legend>


                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('blog.comments_form_name_label')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input id="name_blog" type="text" name="name" required class="form-control"
                                       value="{{$blogComment->name ?? old('name')}}"
                                       placeholder="{{__('blog.comments_form_name_label')}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('blog.comments_form_email_label')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input id="email_blog" required type="email" name="email" required class="form-control"
                                       value="{{$blogComment->email ?? old('email')}}"
                                       placeholder="{{__('blog.comments_form_email_label')}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('blog.comments_form_website_label')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input id="email_blog" type="text" name="site" class="form-control"
                                       value="{{$blogComment->site ?? old('site')}}"
                                       placeholder="{{__('blog.comments_form_website_label')}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('blog.comments_form_comment_label')}} <span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <textarea rows="5" cols="5" name="comment" class="form-control" required
                                      placeholder="{{__('blog.comments_form_comment_label')}}">{{$blogComment->comment ?? old('comment')}}</textarea>
                        </div>
                    </div>

                    @isset($blogComment->photo)
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">{{__('blog.comments_form_photo_label')}}</label>
                            <div class="col-lg-10">
                                <div class="input-group">
                                    <img style="height: 100px;"
                                         src="{{ asset('storage/images/blog/'.$blogComment->photo) }}">
                                </div>
                            </div>
                        </div>
                    @endisset

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('blog.comments_form_status_label')}}</label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input type="hidden" name="status" value="0" >
                                <span><input type="checkbox" name="status" value="1" class="form-check-input-styled" @if((isset($blogComment->status) && $blogComment->status ==='1') || old('show_message') === '1') checked="checked" @endif data-fouc=""></span>
                            </div>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-success btn-labeled btn-labeled-left btn-lg legitRipple "><b><i
                                    class="icon-pin-alt"></i></b>{{__('blog.posts_form_submit_label')}}</button>
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
<!-- /content area -->
