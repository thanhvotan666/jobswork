@php
    $footer = \App\Models\Footer::first();
@endphp
<footer>
    <div class="container-fluid p-5">
        <div class="row">
            <div class="col-12 col-lg-3 mb-3">
                <div>
                    <strong>
                        {{ $footer->company }}
                    </strong>
                </div>
                <div>
                    <strong>
                        {{ __('northern office') }}:
                    </strong>
                    <a href="">{{ $footer->address_n }}</a>
                </div>
                <div>
                    <strong>
                        {{ __('phone') }}:
                    </strong> 
                    {{ $footer->phone_n}}
                </div>
                <div>
                    <strong>
                        {{ __('southern office') }}:
                    </strong>
                    <a href="">{{ $footer->address_s }}</a>
                </div>
                <div>
                    <strong>
                        {{ __('phone') }}:
                    </strong> 
                    {{ $footer->phone_s }}
                </div>
                <div>
                    <strong>
                        {{ __('email') }}:
                    </strong>
                    <a href="mailto:{{ $footer->email }}">{{ $footer->email }}</a>
                </div>
                <div>
                    <strong>
                        {{ __('hotline') }}:
                    </strong>
                    <a href="">
                        {{ $footer->hotline }}
                    </a>
                </div>
            </div>
            <div class="col-12 col-lg-9 d-flex flex-wrap gap-5 justify-content-between ">
                <div>
                    <div>
                        <strong>
                            {{ __('job by location') }}
                        </strong>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        @foreach (\App\Models\LocationSelect::limit(8)->get() as $location)
                            <a href="{{ route('jobs', ['location' => $location->location]) }}">
                                {{ __('job') }}
                                {{ $location->location }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <div>
                    <div>
                        <strong>
                            {{ __('job by profession') }}
                        </strong>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        @foreach (\App\Models\Profession::limit(8)->get() as $profession)
                            <a href="{{ route('jobs', ['profession_name' => $profession->name]) }}">
                                {{ __('job') }} {{ $profession->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <div>
                    <div>
                        <strong>
                            {{ __('job by company') }}
                        </strong>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <a href="">---</a>
                        <a href="">---</a>
                    </div>
                </div>
                <div>
                    <div><strong>
                            {{ __('job by demand') }}
                        </strong></div>
                    <div class="d-flex flex-column gap-2">
                        @foreach (['fulltime', 'parttime', 'urgent', 'online', 'remote'] as $demand)
                            <a href="{{ route('jobs', ['demand' => $demand]) }}">
                                {{ __('job') }}
                                {{ $demand }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row container-fluid">
        <div class="col-12 col-sm-9">
            <ul class="list-inline list-unstyled mb-1 text-primary">
                <li class="list-inline-item"><a rel="nofollow" href="" title="About Us"><u>
                            {{ __('About Us') }}
                        </u></a></li>
                <li class="list-inline-item"><a rel="nofollow" target="_blank" href="" title="Policy"><u>
                            {{ __('Policy') }}
                        </u></a></li>
                <li class="list-inline-item"><a rel="nofollow" target="_blank" href=""
                        title="Terms of Service"><u>
                            {{ __('Terms of Service') }}
                        </u></a></li>
                <li class="list-inline-item"><a rel="nofollow" href="" title="Dispute Resolution"><u>
                            {{ __('Dispute Resolution') }}
                        </u></a>
                </li>
                <!--<li><a href="https://jobsgo.vn/site/term-of-service" title="Terms of Service">Terms of Service</a></li>-->
                <li class="list-inline-item"><a rel="nofollow" target="_blank" href=""><u>
                            {{ __('User Agreement') }}
                        </u></a></li>
                <li class="list-inline-item"><a rel="nofollow" href="" title="Privacy Policy"><u>
                            {{ __('Privacy Policy') }}
                        </u></a></li>
                <li class="list-inline-item"><a rel="nofollow" target="_blank" href="" title="Employers"><u>
                            {{ __('Employers') }}
                        </u></a></li>
                <li class="list-inline-item"><a rel="nofollow" href="" title="FAQ"><u>
                            {{ __('FAQ') }}
                        </u></a>
                </li>
                <li class="list-inline-item"><a href="" target="_blank" title="Blog"><u>
                            {{ __('Blog') }}
                        </u></a></li>
                <li class="list-inline-item"><a href="" target="_blank" title="Q&A"><u>
                            {{ __('Q&A') }}
                        </u></a></li>
                <li class="list-inline-item"><a href="" title="Sitemap"><u>
                            {{ __('Sitemap') }}
                        </u></a></li>
            </ul>
        </div>
        <div class="col-12 col-sm-3">
            <ul class="footer-social text-center list-inline mb-1">
                @if ($footer->facebook)
                <li class="list-inline-item"><a title="Facebook" rel="nofollow" href="{{ $footer->facebook }}"
                    target="_blank">
                    <i class="bi bi-facebook"></i></a></li>
                @endif
                @if ($footer->linkedin)
                <li class="list-inline-item"><a title="LinkedIn" rel="nofollow" href="{{ $footer->linkedin }}"
                    target="_blank">
                    <i class="bi bi-linkedin"></i></a></li>
                @endif
                @if ($footer->instagram)
                <li class="list-inline-item"><a title="Instagram" rel="nofollow" href="{{ $footer->instagram }}"
                    target="_blank">
                    <i class="bi bi-instagram"></i></a></li>
                @endif
                @if ($footer->tiktok)
                <li class="list-inline-item"><a title="TikTok" rel="nofollow" href="{{ $footer->tiktok }}"
                    target="_blank">
                    <i class="bi bi-tiktok"></i></a></li>
                @endif
                @if ($footer->threads)
                    <li class="list-inline-item"><a title="Threads" rel="nofollow" href="{{ $footer->threads }}"
                        target="_blank">
                        <i class="bi bi-threads"></i></a></li>
                @endif
            </ul>
        </div>
    </div>
        <br>
    <div class="row container-fluid">
        <div class="col-12 d-flex justify-content-center align-items-center gap-3 py-3">
                <img src="{{ asset('storage/image/qrcode/qr.png')}}" height="100" alt="download qr">
            <a href="{{ asset('storage/file/jobwork.apk')}}">
                <img src="{{ asset('storage/image/apk.png')}}" height="60" alt="download apk">
            </a>
        </div>
    </div>
    <br>
    <div class="row container-fluid">
        <div class="col-sm-10">
            <pre class="pull-left fw-bold text-center">{{$footer->bottom}}</pre>
        </div>
        <div class="col-sm-2">
            <div class="text-center">
                <div>
                    <a target="_blank" rel="nofollow" href="{{ config('app.online_gov') }}">
                        <img loading="lazy" src="https://media.jobsgo.vn/teks/img/online-gov.svg" alt=""
                            width="100" height="38">
                    </a>
                </div>
                <div>
                    <a target="_blank" rel="nofollow" href="{{ config('app.dmca') }}"
                        title="DMCA.com Protection Status" class="dmca-badge">
                        <img loading="lazy" src="https://media.jobsgo.vn/teks/img/dmca.svg" alt=""
                            width="100" height="21">
                    </a>
                </div>
                <script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"></script>
            </div>
        </div>
    </div>
    </div>
</footer>
