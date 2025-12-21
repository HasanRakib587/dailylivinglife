{{-- <!-- Footer -->
<footer class="bg-primary text-light py-5">
    <div class="container">
        <div class="row">
            @if (!empty($profile))
            <div class="col-sm-2">
                <ul class="list-unstyled d-flex justify-content-around align-items-center">
                    @if (!empty($profile['facebook'] && $profile['show_facebook'] ?? false))
                    <li>
                        <a class="text-decoration-none" href="{{ $profile['facebook'] }}" target="_blank"><i
                                class="bi bi-facebook display-6 text-light px-4"></i></a>
                    </li>
                    @endif
                    @if (!empty($profile['twitter'] && $profile['show_twitter'] ?? false))
                    <li>
                        <a class="text-decoration-none" href="#"><i
                                class="bi bi-twitter-x display-6 text-light px-4"></i></a>
                    </li>
                    @endif
                    @if (!empty($profile['instagram'] && $profile['show_instagram'] ?? false))
                    <li>
                        <a class="text-decoration-none" href="#"><i
                                class="bi bi-instagram display-6 text-light px-4"></i></a>
                    </li>
                    @endif
                    @if (!empty($profile['pinterest'] && $profile['show_pinterest'] ?? false))
                    <li>
                        <a class="text-decoration-none" href="#"><i
                                class="bi bi-pinterest display-6 text-light px-4"></i></a>
                    </li>
                    @endif
                </ul>
            </div>
            @endif
            <div class="col-sm-10 text-center">
                <p>ALL MATERIALS COPYRIGHT Safiul Manowar {{ now()->year }}</p>
            </div>
        </div>
    </div>
</footer> --}}

<footer class="bg-dark mt-5" style="height: 150px">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-md-4 d-flex flex-wrap gap-3">
                <a class="text-light text-decoration-none" href="#">Facebook</a>
                <a class="text-light text-decoration-none" href="#">Twitter</a>
                <a class="text-light text-decoration-none" href="#">Instagram</a>
                <a class="text-light text-decoration-none" href="#">Pinterest</a>
            </div>
            <div class="col-md-8 text-md-end text-light">
                <p class="m-0">Copyright &copy; All Rights Reserved</p>
            </div>
        </div>
    </div>
</footer>