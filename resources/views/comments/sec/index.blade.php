<x-app-layout title="All comments" routeSearch="{{route('secondComments.search',$comment)}}">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">الردور</h4>
                <p class="card-description">
                    يمكنك تصفح الردور ورصدها لترى ان كان هناك رد مسيئة
                </p>
                <div class="table-responsive pt-3">
                    @if ($secondComments->count() == 0)
                        <div class="text-center m-5 text-gray">لا يوجد تعليقات</div>
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
                                    الحالة
                                </th>
                                <th>
                                    المعلق
                                </th>
                                <th>
                                    حظر
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($secondComments as $secondComment)
                                <tr>
                                    <td class="text-center">
                                        <a href="{{ route('comments.show', $secondComment) }}">
                                            {{ $secondComment->id }}
                                        </a>
                                    </td>
                                    <td class="wrap">
                                        {{ $secondComment->text }}
                                    </td>
                                    <td class="text-center">
                                        @if($secondComment->is_block)
                                            <div class="badge badge-opacity-danger">محظور</div>
                                        @else
                                            <div class="badge badge-opacity-success">مفعل</div>
                                        @endif
                                    </td>
                                    <td>
                                        <a
                                            href="{{ route('comment.user', $secondComment) }}">{{ $secondComment->user->name }}</a>
                                    </td>

                                    <td class="text-center">
                                        @if ($secondComment->is_block)
                                            <a href="{{ route('comment.upBlock', $secondComment) }}" class="text-success"
                                               title="رفع الحظر"><i
                                                    class="mdi mdi-arrow-up-bold-circle-outline icon-md-m"></i> </a>
                                        @else
                                            <a href="{{ route('comment.block', ['comment' => $secondComment]) }}"
                                               class="text-danger" title="حظر"><i
                                                    class="mdi mdi-block-helper icon-md-block"></i> </a>
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
    {{ $secondComments->links() }}
</x-app-layout>
