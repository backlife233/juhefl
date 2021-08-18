@extends('app')

@section('content')
    <!-- Start Post Single Wrapper  -->
    <div class="post-single-wrapper axil-section-gap bg-color-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Start Banner Area -->
                    <div class="banner banner-single-post post-formate post-video axil-section-gapBottom">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Start Single Slide  -->
                                    <div class="content-block">
                                        <!-- Start Post Content  -->
                                        <div class="post-content">
                                            <div class="post-cat">
                                                <div class="post-cat-list">
                                                    <a class="hover-flip-item-wrapper" href="#">
                                                            <span class="hover-flip-item">
                                                                <span
                                                                    data-text="{{safe_str('车牌')}}">{{safe_str('车牌')}}</span>
                                                            </span>
                                                    </a>
                                                </div>
                                            </div>
                                            <h1 class="title">获取赞助VIP</h1>
                                            <!-- Post Meta  -->
                                            <div class="post-meta-wrapper">
                                                <div class="post-meta">
                                                    <div class="post-author-avatar border-rounded">
                                                        <img
                                                            src="{{asset('assets/images/post-images/author/author-image-2.png')}}"
                                                            alt="Author Images">
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="post-author-name">
                                                            <a class="hover-flip-item-wrapper" href="#">
                                                                    <span class="hover-flip-item">
                                                                        <span
                                                                            data-text="Faker">Faker</span>
                                                                    </span>
                                                            </a>
                                                        </h6>
                                                        <ul class="post-meta-list">
                                                            <li>Lv.1</li>
                                                            <li>新手</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <ul class="social-share-transparent justify-content-end">
                                                    <li><i class="fas fa-eye"></i>&nbsp;5.2w
                                                    </li>
                                                    <li><i class="fas fa-clock"></i>&nbsp;1年前
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- End Post Content  -->
                                    </div>
                                    <!-- End Single Slide  -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Banner Area -->

                    <div class="axil-post-details" id="post_content">
                        <p>如果你觉得本站做的不错，那么你可以赞助本站。</p>
                        <p>赞助会员可获得全站所有解锁内容，最高权限。</p>

                        <p>联系客服(需要梯子) 点击-><a href="{{config('telegram')}}"><i
                                    class="fab fa-telegram-plane"></i>{{config('telegram')}}</a>进入频道后查看置顶消息</p>
                        <p>或者支付宝<a href="{{route('vip',['type'=>'alipay'])}}">点击购买->￥50 成为赞助VIP<-</a></p>
                        <p>或者微信<a href="{{route('vip',['type'=>'wxpay'])}}">点击购买->￥50 成为赞助VIP<-</a></p>
                        <div class="social-share-block">
                            <div class="post-like">
                                <a href="javascript:void(0);" class="active"><i
                                        class="fal fa-thumbs-up"></i><span
                                        class="num">522</span><span>&nbsp;赞</span></a>
                            </div>
                            <ul class="social-icon icon-rounded-transparent md-size">
                                <li><a href="{{config('telegram')}}"><i class="fab fa-telegram-plane"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                @include('parts.sidebar')
            </div>
        </div>
    </div>
    <!-- End Post Single Wrapper  -->
@endsection
