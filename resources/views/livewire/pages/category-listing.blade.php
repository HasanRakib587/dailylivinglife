{{-- <section class="container-fluid">
    <div class="my-5 text-center text-capitalize">
        <h1>{{ $category->name }}</h1>
        <hr>
    </div>
    <div class="row">
        <div class="col-md-4">
            @foreach ($category->posts as $post)
            <div class="card border-0 text-center" wire:key='{{ $post->id }}'>
                <a wire:navigate href="{{ route('post.single', $post->slug) }}">
                    <img src="{{ Storage::url($post->cover_image) }}" class="card-img-top" alt="{{ $post->title }}">
                </a>
                <div class="card-body">
                    <a class="text-decoration-none text-dark" wire:navigate
                        href="{{ route('post.single', $post->slug) }}">
                        <h5 class="card-title">{{ $post->title }}</h5>
                    </a>
                    <p class="card-text">
                        {!! Str::words($post->content, 10) !!}
                    </p>
                    <a wire:navigate href="{{ route('post.single', $post->slug) }}"
                        class="text-decoration-none text-dark"><span class="text-danger">{{ count($post->comments)
                            }}</span> comments</a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="col-md-4 offset-md-4">
            @livewire('components.sidebar')
        </div>
    </div>
</section> --}}

<!-- Category Heading -->
<section>
    <div class="container-fluid">
        <!-- Top Category Heading -->
        <div class="row my-5">
            <div class="col-md-12">
                {{-- <h1 class="text-center">{{ $parentCategory->name }}</h1> --}}
                @foreach ($subcategories as $child)
                    @if($child->id === $category->id)
                        <h1 class="text-center">{{ $child->name }}</h1>
                    @endif
                @endforeach
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
                                            <img src="{{ asset('uploads/' . $post->cover_image) }}" class="card-img-top rounded-0"
                                                alt="{{ $post->title }}" />
                                        </a>
                                        <div class="card-body text-center">
                                            <a href="{{ route('post.single', $post->slug) }}"
                                                class="text-decoration-none text-dark">
                                                <h5 class="card-title">{{ $post->title }}</h5>
                                            </a>
                                            <p class="card-text">
                                                {!! Str::words($post->content, 30) !!}
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
                    <div class="row my-5">
                        <div class="col-md-12 text-center">
                            <a href="" class="btn btn-outline-danger">Load More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- Big Salad -->
                    <div class="big-salad text-center">
                        <livewire:components.sidebar />
                    </div>
                </div>
            </div>
            <hr />
        </div>
    </section>
    <!-- Explore the Categories -->
    <section>
        <div class="container-fluid">
            <div class="row my-5">
                <div class="col-md-12 text-center">
                    <h2>Explore the categories</h2>
                </div>
            </div>
            <div class="row">
                @foreach ($subcategories as $child)
                    {{-- Skip current category --}}
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
    </section>
</section>