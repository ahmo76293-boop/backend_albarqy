<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificationRequest as RequestsStoreNotificationRequest;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Get user's notifications
     */
    public function index(Request $request)
    {
        $query = Notification::where(
            'user_id',
            auth()->id()
        );

        // Filter by read/unread
        if ($request->filled('is_read')) {

            if ($request->boolean('is_read')) {
                $query->whereNotNull('read_at');
            } else {
                $query->whereNull('read_at');
            }
        }

        $query->latest();

        if ($request->boolean('paginate', true)) {

            $notifications = $query->paginate(
                $request->integer('per_page', 10)
            );
        } else {

            $notifications = $query->get();
        }

        return NotificationResource::collection($notifications);
    }


    /**
     * Show notification
     */
    public function show($id)
    {
        $notification = Notification::where('user_id', auth()->id())
            ->findOrFail($id);

        return response()->json([
            'data' => new NotificationResource($notification),
        ]);
    }


    /**
     * Create notification
     */
    public function store(RequestsStoreNotificationRequest $request)
    {
        $notification = Notification::create([
            'user_id' => $request->user_id,

            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,

            'message_en' => $request->message_en,
            'message_ar' => $request->message_ar,

            'type' => $request->type,

            'reference_type' => $request->reference_type,
            'reference_id' => $request->reference_id,
        ]);

        return response()->json([
            'message' => __('notification.created'),

            'data' => new NotificationResource($notification),
        ], 201);
    }


    /**
     * Mark notification as read
     */
    public function markAsRead($id)
    {
        $notification = Notification::where(
            'user_id',
            auth()->id()
        )->findOrFail($id);

        $notification->update([
            'read_at' => now(),
        ]);

        return response()->json([
            'message' => __('notification.marked_as_read'),

            'data' => new NotificationResource(
                $notification->fresh()
            ),
        ]);
    }


    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        Notification::where(
            'user_id',
            auth()->id()
        )
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
            ]);

        return response()->json([
            'message' => __('notification.all_marked_as_read'),
        ]);
    }


    /**
     * Delete notification
     */
    public function destroy($id)
    {
        $notification = Notification::where(
            'user_id',
            auth()->id()
        )->findOrFail($id);

        $notification->delete();

        return response()->json([
            'message' => __('notification.deleted'),
        ]);
    }

    public function adminDestroy($id)
    {
        $notification = Notification::findOrFail($id);

        $notification->delete();

        return response()->json([
            'message' => __('notification.deleted'),
        ]);
    }
}
