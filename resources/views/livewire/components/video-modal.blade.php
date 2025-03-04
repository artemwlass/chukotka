<div>
    <div class="modal video-modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
{{--                {!! $data?->link_video !!}--}}
                <button type="button" class="modal-close d-flex align-items-center justify-content-center rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <img src="{{asset('assets/images/times-white.svg')}}" alt="">
                </button>
                <video controls>
                    <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                    <source src="mov_bbb.ogg" type="video/ogg">
                </video>
            </div>
        </div>
    </div>
</div>
