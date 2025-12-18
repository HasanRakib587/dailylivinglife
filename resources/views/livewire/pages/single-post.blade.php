@section('meta_description', $post->meta_description)
<section>
    <div class="container">
        <hr class="my-5" />
        <div class="article-meta d-flex justify-content-between">
            <p>{{ $post->created_at->format('F j, Y') }}</p>
            <p>
                <a class="text-decoration-none text-black text-uppercase" href="">
                    {{ $post->category->name }}
                </a>
            </p>
            <p class="text-uppercase">
                by <span class="text-danger">Safiul Manowar</span>
            </p>
        </div>
        <div class="article-heading text-center my-5">
            <h1>{{ $post->title }}</h1>
        </div>
        <div class="article-cover">
            <div class="row">
                <div class="col-md-12 mx-auto my-5">
                    <img src="{{ Storage::url($post->cover_image) }}" class="img-fluid" alt="{{ $post->title }}" />
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="article-content">
            <div class="row g-5 justify-content-center my-5">
                <div class="col-md-2 text-end">
                    <hr />
                    <a href="#allComments" class="fs-5 text-decoration-none text-black">
                        <span class="text-danger">{{ count($post->comments) }}</span> comments
                    </a>
                    <a href="#commentForm" id="topWriteCommentLink" class="btn btn-outline-danger rounded-0 my-3">
                        Write a comment
                    </a>
                </div>
                <div class="col-md-6 my-5 mx-auto">
                    <article>
                        {!! $post->content !!}
                    </article>

                    <hr class="my-5" />
                    <!-- Tags -->
                    <div class="tags">
                        <span>Tags:</span>
                        <a href="" class="text-decoration-none text-danger">Cofeee ,</a>
                        <a href="" class="text-decoration-none text-danger">Style ,</a>
                        <a href="" class="text-decoration-none text-danger">Life </a>
                        <p>
                            <a href="">facebook</a>
                            <a href="">twitter</a>
                            <a href="">pinterest</a>
                            <a href="">email</a>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- Big Salad -->
                    <div class="big-salad text-center">
                        <livewire:components.sidebar />
                    </div>
                </div>
            </div>
        </div>
        <div class="article-footer mt-5">
            <div class="container">
                <div class="row align-items-center text-md-start">
                    <!-- Previous -->
                    <div class="col-6 col-md-3 order-1">
                        @if ($previousPost)
                            <a href="">Previous Article</a>
                        @else
                            <span class="text-muted">No previous post</span>
                        @endif
                    </div>
                    <!-- Next -->
                    <div class="col-6 col-md-3 text-end order-2 order-md-3">
                        @if ($nextPost)
                            <a href="">Next Article</a>
                        @else
                            <span class="text-muted">No next post</span>
                        @endif
                    </div>
                    <!-- Comments section -->
                    <div
                        class="col-12 col-md-6 d-flex flex-column flex-md-row justify-content-md-between align-items-center my-3 my-md-0 order-3 order-md-2">
                        <p class="mb-2 mb-md-0">
                            <span class="text-danger">{{ count($post->comments) }}</span> Comments
                        </p>
                        <a id="writeCommentBtn" class="btn btn-outline-danger rounded-0" href="#commentForm">Write a
                            comment</a>
                    </div>
                </div>
            </div>
            <hr class="my-5" />
            <!-- ------------ COMMENTS AREA (example) ------------ -->
            <livewire:components.comments :post="$post" />
        </div>
    </div>
</section>