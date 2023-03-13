<?php

namespace App\Events;

use App\Models\Post;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FollowingUserCreatedNewPost implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * User that added the post.
     *
     * @var \App\Models\User
     */
    public User $user;

    /**
     * Newly created post.
     *
     * @var \App\Models\Post
     */
    public Post $post;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Post $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel("notify.user.{$this->user->id}.followers");
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs()
    {
        return 'post.created';
    }

    /**
     * Build the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return [
          'user' => [
            'name' => $this->user->name,
          ],
          'post' => [
            'title' => $this->post->title,
            'excerpt' => $this->post->excerpt,
          ],
        ];
    }


}
