<?php

namespace App\Http\Controllers;

use App\Models\Review;

class AdminReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with([
                'job',
                'hirer',
                'worker'
            ])
            ->latest()
            ->get();

        return view('admin.reviews.index', compact('reviews'));
    }


    public function show(Review $review)
    {
        $review->load([
            'job',
            'hirer',
            'worker'
        ]);

        return view('admin.reviews.show', compact('review'));
    }
}