<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Models\Website;
use App\Notifications\NewPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            'status' => 'success',
            'message' => '',
            'data' => Website::all(),
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'domain' => ['required', 'domain', 'unique:App\Models\Website,domain'],
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'error',
                'message' => 'Validation errors.',
                'data' => $validator->errors(),
            ];
        }

        $validated = $validator->validated();

        $website = new Website($validated);

        if (!$website->save()) {
            return [
                'status' => 'error',
                'message' => 'Unable to add website.',
                'data' => '',
            ];
        }

        return [
            'status' => 'success',
            'message' => '',
            'data' => $website,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Website $website)
    {
        return [
            'status' => 'success',
            'message' => '',
            'data' => $website,
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Website $website)
    {
        $validator = Validator::make($request->all(), [
            'domain' => ['required', 'domain', 'unique:App\Models\Website,domain'],
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'error',
                'message' => 'Validation errors.',
                'data' => $validator->errors(),
            ];
        }

        $validated = $validator->validated();

        $website->domain = $validated['domain'];

        if (!$website->save()) {
            return [
                'status' => 'error',
                'message' => 'Unable to save website.',
                'data' => '',
            ];
        }

        return [
            'status' => 'success',
            'message' => '',
            'data' => $website,
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Website $website)
    {
        if (!Website::destroy($website->id)) {
            return [
                'status' => 'error',
                'message' => 'Unable to delete website.',
                'data' => '',
            ];
        }

        return [
            'status' => 'success',
            'message' => 'Website deleted.',
            'data' => '',
        ];
    }

    public function addPost(Request $request, Website $website)
    {
        $validator = Validator::make($request->all(), [
            'url' => ['required', 'url', 'unique:App\Models\Post,url'],
            'title' => ['required', 'min:4', 'max:255'],
            'description' => ['required', 'min:4'],
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'error',
                'message' => 'Validation errors.',
                'data' => $validator->errors(),
            ];
        }

        $validated = $validator->validated();

        $post = $website->posts()->create($validated);

        Notification::send($website->subscribers, new NewPost($post));

        return [
            'status' => 'success',
            'message' => '',
            'data' => $post,
        ];
    }

    public function subscribe(Request $request, Website $website)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'error',
                'message' => 'Validation errors.',
                'data' => $validator->errors(),
            ];
        }

        $validated = $validator->validated();

        $subscriber = Subscriber::firstOrCreate([
            'email' => $validated['email'],
        ]);

        $subscriber->subscriptions()->sync($website->id);

        return [
            'status' => 'success',
            'message' => '',
            'data' => 'Succesfully subscribed.',
        ];
    }
}
