<!-- Author Info -->
@if (!empty($profile))
    <div class="card mb-3 my-5 rounded-0">
        <img
        src="{{ Storage::url($profile['avatar']) }}"
        class="card-img-top rounded-0"
        alt="{{ $profile['name'] }}"
        />
        <div class="card-body bg-warning text-center">
            <h5 class="card-title">{{ $profile['name'] }}</h5>
            <div class="card-text social">
                <a href="">facebook</a>
            </div>
        </div>
    </div>    
@endif