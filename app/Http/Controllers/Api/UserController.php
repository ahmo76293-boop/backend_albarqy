<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->boolean('status'));
        }

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $query->latest();

        if ($request->boolean('paginate', true)) {
            $users = $query->paginate(
                $request->integer('per_page', 10)
            );
        } else {
            $users = $query->get();
        }

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource.
     *
     * Users are created through the Register API.
     */
    public function store()
    {
        $validated = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'string|in:admin,delivery,customer_service,customer',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'] ?? 'customer',

            // TODO:should remove
            'email_verified_at' => now(),
            'is_active' => true,
        ]);

        // TODO:should uncommit
        // create verification link
        // $url = URL::temporarySignedRoute(
        //     'verify.email',
        //     now()->addMinutes(60),
        //     ['id' => $user->id]
        // );

        // TODO:should uncommit
        // send email
        // Mail::to($user->email)->send(new VerifyEmailMail($url));

        // $resend = Resend::client('re_cNH1SpHd_LL6XCfZN5167H77ZXeeZUWAF');

        // $resend->emails->send([
        //     'from' => 'onboarding@resend.dev',
        //     'to' => 'ahmo76293@gmail.com',
        //     'subject' => 'Hello World',
        //     'html' => '<p>Congrats on sending your <strong>first email</strong>!</p>'
        // ]);

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user,
        ], 201);
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified user.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'is_active' => $request->boolean('is_active', $user->is_active),
            ]);

            return response()->json([
                'message' => __('user.updated'),
                'data' => new UserResource($user->fresh()),
            ]);
        } catch (\Throwable $e) {

            return response()->json([
                'message' => __('user.update_failed'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified user.
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return response()->json([
                'message' => __('user.cannot_delete_self'),
            ], 403);
        }

        $user->delete();

        return response()->json([
            'message' => __('user.deleted'),
        ]);
    }
}
