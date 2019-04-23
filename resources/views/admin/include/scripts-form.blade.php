<!-- Page header -->
<form class="form-validate-jquery" enctype="multipart/form-data" method="post"
      action="{{(isset($script)) ? route('scripts.update',['id'=>$script->id])  : route('scripts.store') }}">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">{{$title}}</span></h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success btn-labeled btn-labeled-left btn-lg legitRipple "><b><i
                                    class="icon-pin-alt"></i></b>{{__('admin.script_form_submit_label')}}</button>
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
                @if (isset($script))
                    @method('PUT')
                @endif
                @csrf
                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold">{{__('admin.script_form_common_info')}}</legend>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('admin.scripts_form_title_label')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input type="text" name="title" required class="form-control"
                                       value="{{$script->title ?? old('title')}}"
                                       placeholder="{{__('admin.scripts_form_title_label')}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('admin.script_form_common_info')}} <span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <textarea rows="5" cols="5" name="text" id="text" class="form-control"  required
                                      placeholder="">{!! $script->text ?? old('text') !!}</textarea>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('admin.scripts_form_type_label')}}</label>
                        <div  class="col-lg-10">
                            <select name="type" class="form-control multiselect"  data-fouc>
                                <option @if(isset($script) && $script->type == 1) selected @endif value="1">{{__('admin.scripts_form_type_head')}}</option>
                                <option @if(isset($script) && $script->type == 2) selected @endif value="2">{{__('admin.scripts_form_type_body')}}</option>
                            </select>
                        </div>
                    </div>

                </fieldset>
                <button type="submit" class="btn btn-success btn-labeled btn-labeled-left btn-lg legitRipple "><b><i
                                class="icon-pin-alt"></i></b>{{__('admin.pages_form_submit_label')}}</button>


            </div>
        </div>
        <!-- /input group addons -->

    </div>
</form>
<!-- /content area -->
