@php
    $__csVideo = trim((string) (content('home', 'clients_say', 'side_video') ?? ''));
    $__csSide = trim((string) (content('home', 'clients_say', 'side_image') ?? ''));
    $__defaultImg = asset('assets/images/af338afc80410c34-DypsTNmxrRW7PqSF2Maw0oUSz4.webp');
@endphp
<div class="framer-1j39lpu-container" style="opacity: 1;">
    @if ($__csVideo !== '')
        <video
            src="{{ cms_public_url($__csVideo, '') }}"
            controls
            loop
            muted
            playsinline
            preload="metadata"
            style="cursor:auto;width:100%;height:100%;border-radius:8px;display:block;object-fit:cover;background-color:rgba(0, 0, 0, 0);object-position:50% 50%"
        ></video>
        <script>
        (function () {
            var script = document.currentScript;
            var video = script && script.previousElementSibling;
            if (!video || video.tagName !== 'VIDEO') return;
            if (!('IntersectionObserver' in window)) {
                video.play().catch(function () {});
                return;
            }
            var io = new IntersectionObserver(function (entries) {
                entries.forEach(function (e) {
                    if (e.isIntersecting) {
                        video.play().catch(function () {});
                    } else {
                        video.pause();
                    }
                });
            }, { threshold: 0.35, rootMargin: '0px 0px -5% 0px' });
            io.observe(video);
        })();
        </script>
    @else
        <img
            decoding="auto"
            loading="lazy"
            width="1920"
            height="1080"
            src="{{ cms_public_url($__csSide !== '' ? $__csSide : null, $__defaultImg) }}"
            alt=""
            style="cursor:auto;width:100%;height:100%;border-radius:8px;display:block;object-fit:cover;background-color:rgba(0, 0, 0, 0);object-position:50% 50%"
        >
    @endif
</div>
