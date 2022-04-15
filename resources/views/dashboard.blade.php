<x-app-layout title="Dashboard" routeSearch="{{route('posts.index')}}">
    <div class="row">
        <div class="col-sm-12">
            <div class="statistics-details d-flex align-items-center justify-content-between mb-2">
                <div>
                    <p class="statistics-title">عدد المنشورات</p>
                    <h3 class="rate-percentage">{{$numberPosts}}</h3>
                </div>
                <div>
                    <p class="statistics-title">عدد المستخدمين</p>
                    <h3 class="rate-percentage">{{$numberUsers}}</h3>
                </div>
                <div>
                    <p class="statistics-title">عدد التعليقات</p>
                    <h3 class="rate-percentage">{{$numberComments}}</h3>
                </div>
                <div class="d-none d-md-block">
                    <p class="statistics-title">عدد المشاركات</p>
                    <h3 class="rate-percentage">{{$numberShares}}</h3>
                </div>
                <div class="d-none d-md-block">
                    <p class="statistics-title">عدد التفاعلات</p>
                    <h3 class="rate-percentage">{{$numberLikes}}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row flex-grow">
        <div class="col-md-6 col-lg-12 grid-margin stretch-card">
            <div class="card bg-primary card-rounded">
                <div class="card-body pb-0">
                    <h4 class="card-title card-title-dash text-white mb-4">منشورات اليوم</h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <p class="status-summary-light-white mb-1">عددها</p>
                            <h2 class="text-info">{{$numberPostsToday}}</h2>
                        </div>
                        <div class="col-sm-8">
                            <div class="status-summary-chart-wrapper pb-4">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="status-summary" width="166" height="66"
                                        style="display: block; width: 166px; height: 66px;"
                                        class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card card-rounded">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h4 class="card-title card-title-dash">Top Performer</h4>
                                </div>
                            </div>
                            <div class="mt-3">
                               @foreach($topUsers as $topUser)
                                    <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                        <div class="d-flex">
                                            <img class="img-sm rounded-10" src="{{asset($topUser->avatar)}}" alt="profile">
                                            <div class="wrapper ms-3">
                                                <p class="ms-1 mb-1 fw-bold">{{$topUser->name}}</p>
                                                <small class="text-muted mb-0">{{$topUser->posts_count}}</small>
                                            </div>
                                        </div>
                                        <div class="text-muted text-small">
                                            {{$topUser->gender}}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
