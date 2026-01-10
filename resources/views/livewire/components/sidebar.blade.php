<div>
    <!-- Sidebar Content -->
    {{-- <h1>Sidebar</h1> --}}
    @if($featuredPosts->isNotEmpty())
        <a class="text-decoration-none" href="">
            {{-- <h1><span class="text-danger">Big</span> Salad</h1> --}}
        </a>
        <hr class="text-primary" />
        <h3>Most Popular</h3>
        <div class="my-3">
            @foreach ($featuredPosts as $post)
                <!-- popular post 1 -->
                <div class="popular-posts my-5" wire:key='feat-{{ $post->id }}'>
                    <h3 class="lead">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</h3>
                    <a class="text-decoration-none text-secondary" href="{{ route('post.single', $post->slug) }}">
                        <h2 class="lead">{{ $post->title }}</h2>
                    </a>
                </div>
            @endforeach
            <hr class="text-primary" />
        </div>
    @endif
</div>