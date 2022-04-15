<x-app-layout title="edit admin" routeSearch="">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">تعديل معلومات مدير</h4>
                <p class="card-description">
                    قم بالتعديلات اللازمة على زميلك المدير
                </p>
                <form class="forms-sample" method="post" action="{{route('admins.update',$user->id)}}">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="exampleInputName1">الاسم الكامل</label>
                        <input type="text" class="form-control" placeholder="الاسم الكامل" name="name" value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">عنوان البريد الاكتروني</label>
                        <input type="email" class="form-control" placeholder="الإيميل" name="email" value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">كلمة السر</label>
                        <input type="password" class="form-control" placeholder="كلمة السر" name="password">
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">الجنس</label>
                        <select class="form-control" name="gender">
                            <option value="mate" {{$user->gender == 'mate' ? 'selected' : ""}} >ذكر</option>
                            <option value="femate" {{$user->gender == 'femate' ? 'selected' : ""}}>انثى</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">حفظ التعديلات</button>
                    <a class="btn btn-light" href="{{route('admins.index')}}" >تراجع</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
