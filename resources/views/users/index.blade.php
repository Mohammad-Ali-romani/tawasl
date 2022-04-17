<x-app-layout title='{{count($users) == 1 ? "user | ".$users[0]->name : "all users"}}' routeSearch="{{route('users.search')}}">
    <div class="row flex-grow">
        <div class="col-12 grid-margin stretch-card">
            <div class="card card-rounded">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-start">
                        <div>
                            <h4 class="card-title card-title-dash">المستخدمين</h4>
                            <p class="card-subtitle card-subtitle-dash">
                                يوجد هنا جميع المستخدمين الذين يستخدمون المنصة ويقومون بالتفاعلات عليها
                            </p>
                        </div>
                    </div>
                    <div class="table-responsive  mt-1">
                        @if(count($users) == 0)
                            <div class="text-center m-5 text-gray">لا يوجد مستخدمين</div>
                        @else
                            <table class="table select-table">
                                <thead>
                                <tr>
                                    <th>معلومات الشخصية</th>
                                    <th>الدولة</th>
                                    <th>موليد</th>
                                    <th>الجنس</th>
                                    <th>الحالة</th>
                                    <th>المنشورات</th>
                                    <th>التعليقات</th>
                                    <th>الردود</th>
                                    <th class="text-center">حظر</th>
                                    <th class="text-center">حذف</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex ">
                                                <img src="{{asset('users/avatars/'.$user->avatar)}}" alt="{{$user->name}}"
                                                     class="avatar-admin">
                                                <div class="info-admin">
                                                    <h6>{{$user->name}}</h6>
                                                    <p>{{$user->email}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h6>{{$user->country}}</h6>
                                        </td>
                                        <td>
                                            <h6>{{$user->date_birth}}</h6>
                                        </td>
                                        <td>
                                            <div
                                                class="badge badge-opacity-warning">{{$user->gender == 'male' ? 'ذكر' : 'انثى'}}</div>
                                        </td>
                                        <td>
                                            @if($user->is_block)
                                                <div class="badge badge-opacity-danger">محظور</div>
                                            @else
                                                <div class="badge badge-opacity-success">مفعل</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('users.posts',['id'=>$user->id])}}">منشوراته</a>
                                        </td>
                                        <td>
                                            <a href="{{route('users.comments',['id'=>$user->id])}}">تعليقاته</a>
                                        </td>
                                        <td>
                                            <a href="{{route('users.secondComments',['id'=>$user->id])}}">ردوده</a>
                                        </td>
                                        <td class="text-center">
                                            @if($user->is_block)
                                                <a href="{{route('user.upBlock',$user)}}" class="text-success"
                                                   title="رفع الحظر"><i
                                                        class="mdi mdi-arrow-up-bold-circle-outline icon-md-m"></i> </a>
                                            @else
                                                <a href="{{route('user.block',$user)}}" class="text-danger" title="حظر"><i
                                                        class="mdi mdi-block-helper icon-md-m-block"></i> </a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <form action="{{route('users.destroy',$user->id)}}" method="post"
                                                  id="formDelete{{$user->id}}">
                                                @csrf
                                                @method('delete')
                                                <a class="text-danger btn-delete icon-sm"
                                                   onclick="document.getElementById('formDelete{{$user->id}}').submit()"><i
                                                        class="mdi mdi-cup"></i></a>
                                            </form>
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
    </div>
    @if(count($users) != 1)
        {{$users->links()}}
    @endif
</x-app-layout>
