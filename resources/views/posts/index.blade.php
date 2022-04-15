<x-app-layout title="All Posts" routeSearch="{{route('posts.search')}}">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">المنشورات</h4>
                <p class="card-description">
                    قم بتصفح جميع المنشورات وفحصها بشكل واضح
                </p>
                <div class="table-responsive pt-3">
                    @if($posts->count() == 0)
                        <div class="text-center m-5 text-gray">لا يوجد منشورات</div>
                    @else
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    النص
                                </th>
                                <th>
                                    حالة المنشور
                                </th>
                                <th>
                                    كاتب المنشور
                                </th>
                                <th>
                                    التعليقات
                                </th>
                                <th>
                                    حظر
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>

                                    <td class="text-center">
                                        <a href="{{route('posts.show',$post->id)}}">
                                            {{$post->id}}
                                        </a>
                                    </td>
                                    <td class="wrap">
                                        {{$post->text}}

                                    </td>
                                    <td class="text-center">
                                        @if($post->is_block)
                                            <div class="badge badge-opacity-danger">محظور</div>
                                        @else
                                            <div class="badge badge-opacity-success">مفعل</div>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('post.user',$post)}}">{{$post->user->name}}</a>
                                    </td>
                                    <td>
                                        <a href="{{route('post.comments',$post)}}">تعليقاته</a>
                                    </td>
                                    <td class="text-center">
                                        @if($post->is_block)
                                            <a href="{{route('post.upBlock',$post)}}" class="text-success" title="رفع الحظر"><i class="mdi mdi-arrow-up-bold-circle-outline icon-md-m"></i> </a>
                                        @else
                                            <a href="{{route('post.block',$post)}}" class="text-danger" title="حظر" ><i class="mdi mdi-block-helper icon-md-m-block"></i> </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{$posts->links()}}
</x-app-layout>
