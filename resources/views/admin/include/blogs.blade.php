<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">{{$title}}</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="d-flex justify-content-center">
            <a href="{{route('blogs.create')}}" class="btn btn-success btn-labeled btn-labeled-left btn-lg legitRipple"><b><i class="icon-pin-alt"></i></b>{{ __('blog.posts_create_button_label') }}
            </a>

        </div>
    </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">
    <!-- Hover rows -->
    <div class="card">
        <div class="table-responsive">
            @if($blogs)
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>{{ __('blog.posts_th1') }}</th>
                        <th>{{ __('blog.posts_th2') }}</th>
                        <th>{{ __('blog.posts_th3') }}</th>
                        <th>{{ __('blog.posts_th4') }}</th>
                        <th>{{ __('blog.posts_th5') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($blogs as $blog)
                        <tr>
                            <td>{{$blog->id}}</td>
                            <td>{{$blog->titleH1}}</td>
                            <td>{{$blog->created_at->format('d.m.Y')}}</td>
                            <td>{{$blog->views}}</td>
                            <td>
                                <a href="{{route('blogs.edit',['blog'=>$blog->id])}}"
                                   class="btn btn-primary btn-labeled btn-labeled-left btn-lg legitRipple"><b><i
                                                class="icon-pin-alt"></i></b>{{ __('blog.posts_edit_button_label') }}
                                </a>
                                <a data-app-id="{{$blog->id}}" href="{{route('blogs.destroy',['blog'=>$blog->id])}}" data-toggle="modal" data-target="#confirm_delete_contacts"
                                   class="btn btn-danger btn-labeled btn-labeled-left btn-lg legitRipple"><b><i
                                                class="icon-pin-alt"></i></b>{{ __('blog.posts_delete_button_label') }}
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div style="display:none">
                    <form method="post" id="contact-applications-delete" action="">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                {{ $blogs->links() }}
            @endif
        </div>
    </div>
    <!-- /hover rows -->

</div>
<!-- /content area -->
