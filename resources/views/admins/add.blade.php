<x-app-layout title="create new admin" routeSearch="">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">إضافة مدير جديد</h4>
                <p class="card-description">
                    قم بإضافة مدير جديد لمساعدتك في ادارة المشروع
                </p>
                <form class="forms-sample" method="post" action="{{ route('admins.store') }}" novalidate>
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1">الاسم الكامل</label>

                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               placeholder="الاسم الكامل" name="name" value="{{old('name')}}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">عنوان البريد الاكتروني</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               placeholder="الإيميل" name="email" value="{{old('email')}}">
                        @error('email')
                        <div class="   invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
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
                        <label for="exampleSelectGender">الجنس</label>
                        <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                            <option value="mate" {{old('gender') == 'mate' ? "selected" : ""}} >ذكر</option>
                            <option value="femate" {{old('gender') == 'femate' ? "selected" : ""}}>انثى</option>
                        </select>
                        @error('gender')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary me-2">إضافة مدير</button>
                    <a class="btn btn-light" href="{{ route('admins.index') }}">تراجع</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
