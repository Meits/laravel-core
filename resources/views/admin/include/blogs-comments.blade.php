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
    <!-- Hover rows -->
    <div class="card">
        <div class="table-responsive">
            @if($blogsComments)
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>{{ __('blog.comments_th1') }}</th>
                        <th>{{ __('blog.comments_th2') }}</th>
                        <th>{{ __('blog.comments_th3') }}</th>
                        <th>{{ __('blog.comments_th4') }}</th>
                        <th>{{ __('blog.comments_th5') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($blogsComments as $comment)
                        <tr>
                            <td>{{$comment->id}}</td>
                            <td>{{$comment->name}}</td>
                            <td>{{$comment->email}}</td>
                            <td>{{$comment->status}}</td>
                            <td>
                                <a href="{{route('blogs-comments.edit',['blogs_comment'=>$comment->id])}}"
                                   class="btn btn-primary btn-labeled btn-labeled-left btn-lg legitRipple"><b><i
                                                class="icon-pin-alt"></i></b>{{ __('blog.posts_edit_button_label') }}
                                </a>
                                <a data-app-id="{{$comment->id}}" href="{{route('blogs-comments.destroy',['blogs_comment'=>$comment->id])}}" data-toggle="modal" data-target="#confirm_delete_contacts"
                                   class="btn btn-danger btn-labeled btn-labeled-left btn-lg legitRipple"><b><i
                                                class="icon-pin-alt"></i></b>{{ __('blog.posts_delete_button_label') }}
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            {{ $blogsComments->links() }}
                <div style="display:none">
                    <form method="post" id="contact-applications-delete" action="">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                {{ $blogsComments->links() }}
            @endif
        </div>
    </div>
    <!-- /hover rows -->

</div>
<!-- /content area -->
