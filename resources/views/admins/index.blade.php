<x-app-layout title="All admins" routeSearch="{{route('admins.search')}}">
    <div class="row flex-grow">
        <div class="col-12 grid-margin stretch-card">
            <div class="card card-rounded">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-start">
                        <div>
                            <h4 class="card-title card-title-dash">جميع المدراء</h4>
                            <p class="card-subtitle card-subtitle-dash">يوجد هنا جميع المدراء الذين يعملون معك على هذه
                                المنصة</p>
                        </div>
                        <div>
                            <a class="btn btn-primary  text-white " href="{{ route('admins.create')}}">
                                <i class="mdi mdi-account-plus"></i> إضافة مدير جديد </a>
                        </div>
                    </div>
                    <div class="table-responsive  mt-1">
                        <table class="table select-table">
                            <thead>
                            <tr>

                                <th>معلومات الشخصية</th>
                                <th>عنوان السكن</th>
                                <th>موليد</th>
                                <th>الجنس</th>
{{--                                <th>تعديل</th>--}}
                                <th>حذف</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($users as $user)
                                @if ($user->id != auth()->user()->id)
                                    <tr>
                                        <td>
                                            <div class="d-flex ">
                                                <img src="{{ asset($user->avatar) }}" alt="{{ $user->name }}"
                                                     class="avatar-admin">
                                                <div class="info-admin">
                                                    <h6>{{ $user->name }}</h6>
                                                    <p>{{ $user->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h6>{{ $user->country }}</h6>
                                        </td>
                                        <td>
                                            <h6>{{ $user->date_birth }}</h6>
                                        </td>
                                        <td>
                                            <div
                                                class="badge badge-opacity-warning">{{$user->gender == 'male' ? 'ذكر' : 'انثى'}}</div>
                                        </td>
{{--                                        <td>--}}
{{--                                            <a class="text-info icon-sm"--}}
{{--                                               href="{{ route('admins.edit', $user->id) }}"><i--}}
{{--                                                    class="mdi mdi-border-color"></i></a>--}}
{{--                                        </td>--}}
                                        <td>
                                            <form action="{{ route('admins.destroy', $user->id) }}" method="post"
                                                  id="formDelete">
                                                @csrf
                                                @method('delete')
                                                <a class="text-danger btn-delete icon-sm"
                                                   onclick="formDelete.submit()"><i class="mdi mdi-cup"></i></a>
                                            </form>
                                        </td>

                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
