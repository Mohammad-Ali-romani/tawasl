<x-app-layout title="My Profile" routeSearch="">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">ملفي الشخصي</h4>
                <p class="card-description">
                    قم بتعديل معلوماتك الشخصية
                </p>
                @isset(session()->get['success'])
                    <div class="alert alert-success" role="alert">
                        A simple success alert—check it out!
                    </div>
                @endisset
                <form class="forms-sample" method="post" action="{{ route('users.updateProfile',auth()->user()->id) }}" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('put')
                    <div class="form-group text-center">
                        <div class="box-image rounded-circle">
                            <img class="img-xl  image-avatar" src="{{asset(auth()->user()->avatar)}}"  onclick="avatar.click()"
                                 alt="Profile image" >
                        </div>
                        <input type="file" name="avatar" id="avater" onchange="form.submit()" class=" @error('avatar') is-invalid @enderror" hidden>
                        @error('avatar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">الاسم الكامل</label>

                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               placeholder="الاسم الكامل" name="name" value="{{auth()->user()->name}}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">عنوان البريد الالكتروني</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               placeholder="الإيميل" name="email" value="{{auth()->user()->email}}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>الدولة</label>
                        <input type="text" class="form-control" name="country" placeholder="الدولة"
                               value="{{auth()->user()->country}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">الجنس</label>
                        <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                            <option value="mate" {{auth()->user()->gender == 'mate' ? "selected" : ""}} >ذكر</option>
                            <option value="femate" {{auth()->user()->gender == 'femate' ? "selected" : ""}}>انثى</option>
                        </select>
                        @error('gender')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label class="col-sm-3 col-form-label">تاريخ الميلاد</label>
                        <input class="form-control" placeholder="يوم/شهر/سنة" type="date"
                               value="{{auth()->user()->date_birth}}" name="date_birth">
                        @error('date_birth')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <hr class="text-gray">
                    <h6 class="mb-4">
                        تغيير كلمة المرور
                    </h6>
                    <div class="form-group">
                        <label for="exampleInputPassword4">كلمة السر</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               placeholder="كلمة السر" name="password" id="password">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">تأكيد كلمة السر</label>
                        <input type="password" class="form-control @error('password_confirmation ') is-invalid @enderror"
                               placeholder="تأكيد كلمة السر" name="password_confirmation" id="password_confirmation ">
                        @error('password_confirmation ')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary me-2">تحديث</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
