<section>
    <div class="container-fluid">
        <!-- Top Category Heading -->
        <div class="row my-5">
            <div class="col-md-12">
                {{-- <h1 class="text-center">{{ $parentCategory->name }}</h1> --}}
                {{-- @foreach ($subcategories as $child)
                @if($child->id === $category->id)
                <h1 class="text-center">{{ $child->name }}</h1>
                @endif
                @endforeach --}}
            </div>
        </div>
        <hr />
        <!-- Sub Category Heading -->
        {{-- <div class="row">
            <div class="my-3 col-md-12 d-flex justify-content-around">
                @foreach ($subcategories as $child)
                @continue($child->id === $category->id)
                <a class="text-decoration-none text-dark" href="{{ route('category.listing', $child->slug) }}">
                    <h3>{{ $child->name }}</h3>
                </a>
                @endforeach
            </div>
        </div> --}}
    </div>
    <!-- Category Listing -->
    <section>
        <div class="container-fluid">
            <div class="row my-5">
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
                    @if($posts->count() >= $perPage * $page)
                        <div class="row my-5">
                            <div class="col-md-12 text-center">
                                <button wire:click='loadMore' wire:loading.attr='disabled' class="btn btn-outline-danger">
                                    <span wire:loading.remove>Load More</span>
                                    <span wire:loading>Loading...</span>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-md-3">
                    <!-- Big Salad -->
                    <div class="big-salad text-center">
                        <livewire:components.sidebar />
                    </div>
                </div>
            </div>
            {{--
            <hr /> --}}
        </div>
    </section>
</section>