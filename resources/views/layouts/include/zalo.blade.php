
@php
    $includeZalo = \App\Models\Footer::first()->zalo;
@endphp
{{-- @if( $includeZalo )
    <zalo>
        <a href="{{ $includeZalo }}" target="_blank" rel="nofollow">
            <img loading="lazy" src="{{ asset('storage/image/icon/zalo.svg') }}" alt="jobsgo">
        </a>
        
    </zalo>
@endif --}}
<zalo>
    <div class="zalo-chat-widget" data-oaid="1726358842334767767" data-welcome-message="Rất vui khi được hỗ trợ bạn!" data-autopopup="0" data-width="200" data-height="300"></div>

    <script src="https://sp.zalo.me/plugins/sdk.js"></script>
</zalo>
