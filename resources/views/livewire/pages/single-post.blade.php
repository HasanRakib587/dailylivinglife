@section('meta_description', $post->meta_description)
<section>
    <div class="container">
        <hr class="my-5" />
        <div class="article-meta d-flex justify-content-between">
            <p>{{ $post->published_at->format('F j, Y') }}</p>
            <p class="d-none d-md-block">
                <a class="text-decoration-none text-secondary text-uppercase"
                    href="{{ route('category.listing', $post->category->slug) }}">
                    {{ $post->category->name }}
                </a>
            </p>
            <p class="text-uppercase">
                by <span class="text-secondary">Safiul Manowar</span>
            </p>
        </div>
        {{-- <div class="article-heading text-center my-5">
            <h1>{{ $post->title }}</h1>
        </div>
        <div class="article-cover">
            <div class="row">
                <div class="col-md-12 mx-auto my-5">
                    <img src="{{ asset('uploads/' . $post->cover_image) }}" class="img-fluid"
                        alt="{{ $post->title }}" />
                </div>
            </div>
        </div> --}}
    </div>
    <div class="container-fluid">
        <div class="article-content">
            <div class="row g-5 justify-content-center my-5">
                <div class="col-md-2 text-end">
                    <hr />
                    <a href="#allComments" class="fs-5 text-decoration-none text-black">
                        <span class="text-secondary">{{ count($post->comments) }}</span> comments
                    </a>
                    <a href="#commentForm" id="topWriteCommentLink" class="btn btn-outline-secondary rounded-0 my-3">
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
                        @forelse ($post->tags as $tag)
                            <a href="{{ route('tag.listing', $tag->slug) }}" class="text-decoration-none text-danger">
                                {{ $tag->name }}@if (!$loop->last),@endif
                            </a>
                        @empty
                            <span class="text-muted">No tags</span>
                        @endforelse

                        <p>
                            <a class="text-decoration-none text-secondary"
                                href="https://www.facebook.com/profile.php?id=61561551233074" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95" />
                                </svg>
                            </a>
                            <a class="text-decoration-none text-secondary" href="https://x.com/dailylivinglif3"
                                target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M10.488 14.651L15.25 21h7l-7.858-10.478L20.93 3h-2.65l-5.117 5.886L8.75 3h-7l7.51 10.015L2.32 21h2.65zM16.25 19L5.75 5h2l10.5 14z" />
                                </svg>
                            </a>
                            <a class="text-decoration-none text-secondary"
                                href="https://www.instagram.com/yourdailylivinglife/?hl=en" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                                    <g fill="none">
                                        <path stroke="currentColor" stroke-width="2"
                                            d="M3 11c0-3.771 0-5.657 1.172-6.828S7.229 3 11 3h2c3.771 0 5.657 0 6.828 1.172S21 7.229 21 11v2c0 3.771 0 5.657-1.172 6.828S16.771 21 13 21h-2c-3.771 0-5.657 0-6.828-1.172S3 16.771 3 13z" />
                                        <circle cx="16.5" cy="7.5" r="1.5" fill="currentColor" />
                                        <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2" />
                                    </g>
                                </svg>
                            </a>
                            <a class="text-decoration-none text-secondary" href="https://www.pinterest.com/jashimhi5/"
                                target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M9.04 21.54c.96.29 1.93.46 2.96.46a10 10 0 0 0 10-10A10 10 0 0 0 12 2A10 10 0 0 0 2 12c0 4.25 2.67 7.9 6.44 9.34c-.09-.78-.18-2.07 0-2.96l1.15-4.94s-.29-.58-.29-1.5c0-1.38.86-2.41 1.84-2.41c.86 0 1.26.63 1.26 1.44c0 .86-.57 2.09-.86 3.27c-.17.98.52 1.84 1.52 1.84c1.78 0 3.16-1.9 3.16-4.58c0-2.4-1.72-4.04-4.19-4.04c-2.82 0-4.48 2.1-4.48 4.31c0 .86.28 1.73.74 2.3c.09.06.09.14.06.29l-.29 1.09c0 .17-.11.23-.28.11c-1.28-.56-2.02-2.38-2.02-3.85c0-3.16 2.24-6.03 6.56-6.03c3.44 0 6.12 2.47 6.12 5.75c0 3.44-2.13 6.2-5.18 6.2c-.97 0-1.92-.52-2.26-1.13l-.67 2.37c-.23.86-.86 2.01-1.29 2.7z" />
                                </svg>
                            </a>
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
                            <span class="text-secondary">{{ count($post->comments) }}</span> Comments
                        </p>
                        <a id="writeCommentBtn" class="btn btn-outline-secondary rounded-0" href="#commentForm">Write a
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