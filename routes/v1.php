<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\EmailValidationController;
use App\Http\Controllers\Api\V1\Auth\InterestController;
use App\Http\Controllers\Api\V1\AuthenicatedUserAactivities\UserActivityFeedController;
use App\Http\Controllers\Api\V1\Comments\CommentDisLikeController;
use App\Http\Controllers\Api\V1\Comments\CommentLikeController;
use App\Http\Controllers\Api\V1\Events\EventCommentController;
use App\Http\Controllers\Api\V1\Events\EventDisLikeController;
use App\Http\Controllers\Api\V1\Events\EventLikeController;
use App\Http\Controllers\Api\V1\Events\EventSaveController;
use App\Http\Controllers\Api\V1\Events\LaunchedEventController;
use App\Http\Controllers\Api\V1\Suggestions\SuggestionController;
use App\Http\Controllers\Api\V1\Timeline\TimelineController;
use App\Http\Controllers\Api\V1\Users\UserFollowController;
use App\Http\Controllers\Api\V1\Users\UserUnFollowController;
use Illuminate\Support\Facades\Route;


Route::prefix('users')->group(function () {
    Route::post('/validate-email', [EmailValidationController::class, 'validateEmail']);
    Route::post('/validate-profile-image', [EmailValidationController::class, 'validateProfileImage']);
    Route::get('/interests', [InterestController::class, 'index']);

    Route::post('/sign-up', [AuthController::class, 'register']);
    Route::post('/sign-in', [AuthController::class, 'login']);
});


Route::middleware('auth:api')->group(function () {

    Route::group(['prefix' => 'users'], function () {
        Route::get('/me', [AuthController::class, 'getAuthUser']);
        Route::get('/me/activities', UserActivityFeedController::class);

        Route::post('/sign-out', [AuthController::class, 'logout']);

        Route::post('/{user}/follow', UserFollowController::class);
        Route::post('/{user}/unfollow', UserUnFollowController::class);
    });


    Route::prefix('events')->group(function () {
        Route::get('/saved', [EventSaveController::class, 'index']);
        Route::post('/{event}/save', [EventSaveController::class, 'store']);
        Route::post('/{event}/un-save', [EventSaveController::class, 'destroy']);
        Route::get('/launched', LaunchedEventController::class);
        Route::get('/{event}/comments', EventCommentController::class);

        Route::post('/{event}/like', EventLikeController::class);
        Route::post('/{event}/dislike', EventDisLikeController::class);

        Route::post('/{event}/comments/{comment}/like', CommentLikeController::class);
        Route::post('/{event}/comments/{comment}/dislike', CommentDisLikeController::class);

        Route::get('/suggestions', SuggestionController::class);
    });

});


Route::middleware('auth:api')->get('/events', TimelineController::class);

