<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    public function index(Request $request)
    {
        $reviews = Review::query()
            ->with([
                'job',
                'hirer',
                'worker.workerProfile',
            ])
            ->when(
                $request->filled('search'),
                function ($query) use ($request) {
                    $search = trim($request->string('search')->toString());

                    $query->where(function ($subQuery) use ($search) {
                        $subQuery
                            ->where('review', 'like', "%{$search}%")
                            ->orWhereHas(
                                'job',
                                fn ($jobQuery) => $jobQuery->where(
                                    'title',
                                    'like',
                                    "%{$search}%"
                                )
                            )
                            ->orWhereHas(
                                'hirer',
                                fn ($hirerQuery) => $hirerQuery
                                    ->where('name', 'like', "%{$search}%")
                                    ->orWhere('email', 'like', "%{$search}%")
                            )
                            ->orWhereHas(
                                'worker',
                                fn ($workerQuery) => $workerQuery
                                    ->where('name', 'like', "%{$search}%")
                                    ->orWhere('email', 'like', "%{$search}%")
                            );
                    });
                }
            )
            ->when(
                $request->filled('rating'),
                fn ($query) => $query->where(
                    'rating',
                    (int) $request->input('rating')
                )
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalReviews = Review::count();

        $fiveStarReviews = Review::where('rating', 5)->count();

        $fourStarReviews = Review::where('rating', 4)->count();

        $averageRating = round(
            (float) Review::avg('rating'),
            1
        );

        return view('admin.reviews.index', compact(
            'reviews',
            'totalReviews',
            'fiveStarReviews',
            'fourStarReviews',
            'averageRating'
        ));
    }

    public function show(Review $review)
    {
        $review->load([
            'job',
            'hirer',
            'worker.workerProfile',
        ]);

        return view('admin.reviews.show', compact('review'));
    }
}