<x-app-layout title="{{$comment->text}}" routeSearch="{{route('comments.search')}}">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">التعليقات</h4>
                <p class="card-description">
                    يمكنك تصفح التعليقات ورصدها لترى ان كان هناك تعليقات مسيئة
                </p>
                <div class="table-responsive pt-3">

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
                                    الحالة
                                </th>
                                <th>
                                    المعلق
                                </th>
                                <th>
                                    الردود
                                </th>
                                <th>
                                    حظر
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">
                                        <a href="{{ route('comments.show', $comment) }}">
                                            {{ $comment->id }}
                                        </a>
                                    </td>
                                    <th class="wrap text-line">
                                        {{ $comment->text }}
                                    </th>
                                    <td class="text-center">
                                        @if($comment->is_block)
                                            <div class="badge badge-opacity-danger">محظور</div>
                                        @else
                                            <div class="badge badge-opacity-success">مفعل</div>
                                        @endif
                                    </td>
                                    <td>
                                        <a
                                            href="{{ route('comment.user', $comment) }}">{{ $comment->user->name }}</a>
                                    </td>
                                    <td class="text-center">
                                        @if ($comment->is_second)
                                            <a href="{{route('seccomments.index',$comment)}}">الردود</a>
                                        @else
                                            لا يوجد ردود
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($comment->is_block)
                                            <a href="{{ route('comment.upBlock', $comment) }}" class="text-success"
                                               title="رفع الحظر"><i
                                                    class="mdi mdi-arrow-up-bold-circle-outline icon-md-m"></i> </a>
                                        @else
                                            <a href="{{ route('comment.block', ['comment' => $comment]) }}"
                                               class="text-danger" title="حظر"><i
                                                    class="mdi mdi-block-helper icon-md-block"></i> </a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
