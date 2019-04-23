<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">{{$title}}</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">

    <!-- Input group addons -->
    <div class="card">

        <div class="card-body">
            <form class="form-validate-jquery" enctype="multipart/form-data" method="post"
                  action="{{route('robots.store')}}">
                @csrf
                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold">{{__('admin.pages_form_common_info')}}</legend>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('admin.robots_form_content_label')}} <span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <textarea rows="5" cols="5" name="content" class="form-control" required
                                      placeholder="{{__('admin.robots_form_content_label')}}">{!! $content !!}</textarea>
                        </div>
                    </div>

                </fieldset>


                <button type="submit" class="btn btn-success btn-labeled btn-labeled-left btn-lg legitRipple"><b><i
                                class="icon-pin-alt"></i></b>{{__('admin.pages_form_submit_label')}}</button>


            </form>
        </div>
    </div>
    <!-- /input group addons -->

</div>
<!-- /content area -->