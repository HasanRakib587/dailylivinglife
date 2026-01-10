<section class="container" x-data>
    <div class="article-comments">
        <div class="row">
            <div class="col-md-6 my-5 mx-auto">

                <!-- Loop Comments -->
                @foreach ($post->comments as $comment)
                    <div class="card border-0 border-bottom comment mb-3" wire:key="comment-{{ $comment->id }}"
                        x-data="{ openReply: false }">
                        <div class="card-body">
                            <h5 class="card-title">
                                <span>{{ $comment->name }}</span> says
                            </h5>
                            <p class="card-text">{{ $comment->comment }}</p>

                            <div class="d-flex justify-content-between">
                                <p class="text-muted small mb-0">
                                    {{ $comment->created_at->format('F d, Y g:i a') }}
                                </p>

                                <a href="#" @click.prevent="openReply = !openReply"
                                    class="reply-btn text-decoration-none text-uppercase text-secondary">
                                    <span x-text="openReply ? 'Cancel' : 'Reply'"></span>
                                </a>
                            </div>
                        </div>

                        <!-- Replies -->
                        @foreach ($comment->replies as $reply)
                            <div class="ms-5 card border-0 border-bottom mt-3" wire:key="reply-{{ $reply->id }}">
                                <div class="card-body">
                                    <h5 class="card-title"><span>{{ $reply->name }}</span> says</h5>
                                    <p class="card-text">{{ $reply->reply }}</p>
                                    <p class="text-muted small mb-0">
                                        {{ $reply->created_at->format('F d, Y g:i a') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach

                        <!-- Reply Form (toggle with Alpine) -->
                        <div class="mb-5" x-show="openReply" x-transition>
                            <form wire:submit.prevent="addReply({{ $comment->id }})" class="row g-3 mt-3">
                                <div class="col-12">
                                    <textarea wire:model.defer="replyText" class="form-control border-black rounded-0"
                                        style="height: 150px" placeholder="Write your reply..."></textarea>
                                </div>
                                <div class="col-md-6">
                                    <input wire:model.defer="name" type="text"
                                        class="form-control border-0 border-bottom border-black rounded-0"
                                        placeholder="Name *">
                                </div>
                                <div class="col-md-6">
                                    <input wire:model.defer="email" type="email"
                                        class="form-control border-0 border-bottom border-black rounded-0"
                                        placeholder="Email *">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-outline-danger rounded-0">
                                        Submit Reply
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach

                <!-- Top-Level Comment Form -->
                <div id="commentForm" class="comment-form my-5">
                    <h4>Write a Comment</h4>
                    <form wire:submit.prevent="addComment" class="row g-3">
                        <div class="col-12">
                            <textarea wire:model.defer="comment" class="form-control border-black rounded-0"
                                style="height: 200px" placeholder="Write your comment..."></textarea>
                        </div>
                        <div class="col-md-6">
                            <input wire:model.defer="name" type="text"
                                class="form-control border-0 border-bottom border-black rounded-0" placeholder="Name *">
                        </div>
                        <div class="col-md-6">
                            <input wire:model.defer="email" type="email"
                                class="form-control border-0 border-bottom border-black rounded-0"
                                placeholder="Email *">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-outline-secondary rounded-0">
                                Post Comment
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>