<!-- Category Heading -->
<section>
    <div class="container-fluid">
        <!-- Top Category Heading -->
        <div class="row my-5">
            <div class="col-md-12">
                @foreach ($subcategories as $child)
                    @if($child->id === $category->id)
                        <h1 class="text-center">{{ $child->name }}</h1>
                    @endif
                @endforeach
            </div>
        </div>
        <hr />
    </div>
    <!-- Category Listing -->
    <section>
        <div class="container-fluid">
            <div class="row my-5">
                @if ($posts->count() > 0)
                    <div class="col-md-9">
                        <div class="row gap-5">
                            @foreach ($posts as $post)
                                @if($post && $post->cover_image)
                                    <div class="col-md-5 ms-5" wire:key='{{ $post->id }}'>
                                        <div class="card border-0">
                                            <a href="{{ route('post.single', $post->slug) }}">
                                                <img src="{{ Storage::disk('r2')->url($post->cover_image) }}"
                                                    class="card-img-top rounded-0" alt="{{ $post->title }}" />
                                            </a>
                                            <div class="card-body text-center">
                                                <a href="{{ route('post.single', $post->slug) }}"
                                                    class="text-decoration-none text-dark">
                                                    <h5 class="card-title">{{ $post->title }}</h5>
                                                </a>
                                                <p class="card-text">
                                                    {{-- {!! Str::words($post->content, 30) !!} --}}
                                                </p>
                                                <a href="{{ route('post.single', $post->slug) }}"
                                                    class="text-decoration-none text-dark"><span
                                                        class="text-danger">{{ count($post->comments) }}</span> comments</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        @if ($posts->count() >= $perPage * $page)
                            <div class="load my-5 py-5 text-center">
                                <button wire:click="loadMoreOlderPosts" wire:loading.attr="disabled"
                                    class="btn btn-outline-secondary rounded-0">
                                    <span wire:loading.remove>Load Previous articles</span>
                                    <span wire:loading>Loading...</span>
                                </button>
                            </div>
                        @endif
                @else
                            <h2 class="text-center">No Posts Found !</h2>
                        </div>
                    @endif
                <div class="col-md-3">
                    <!-- Big Salad -->
                    <div class="big-salad text-center">
                        <livewire:components.sidebar />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Explore the Categories -->
    {{-- <section>
        <div class="container-fluid">
            <div class="row my-5">
                <div class="col-md-12 text-center">
                    <h2>Explore the categories</h2>
                </div>
            </div>
            <div class="row">
                @foreach ($subcategories as $child)
                @continue($child->id === $category->id)
                @if ($child && $child->cover_image)
                <div class="col-md-3">
                    <div class="card border-0">
                        <a href="">
                            <img src="{{ Storage::url($child->latestPost->cover_image) }}"
                                class="card-img-top rounded-0" alt="{{ $child->name }}" />
                        </a>
                        <div class="card-body">
                            <a href="" class="card-text text-center text-dark text-decoration-none">
                                <h4>{{ $child->name }}</h4>
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </section> --}}
</section>