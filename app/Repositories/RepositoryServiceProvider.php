<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Repositories\Roles\RolesRepositoryInterface;
use App\Repositories\Users\UsersRepositoryInterface;
use App\Repositories\Batch\BatchRepositoryInterface;
use App\Repositories\Batch\CategoryRepositoryInterface;
use App\Repositories\Batch\PlanRepositoryInterface;
use App\Repositories\Batch\StudentRepositoryInterface;
use App\Repositories\Batch\GalleryRepositoryInterface;
use App\Repositories\Batch\EventRepositoryInterface;
use App\Repositories\Batch\EBookRepositoryInterface;
use App\Repositories\Batch\ServiceRepositoryInterface;
use App\Repositories\Batch\ServiceImagesRepositoryInterface;
use App\Repositories\Batch\TestimonialRepositoryInterface;
use App\Repositories\Batch\TrialClassRepositoryInterface;
use App\Repositories\Batch\InquiryClassRepositoryInterface;
use App\Repositories\Batch\ContactClassRepositoryInterface;
use App\Repositories\Batch\StudentSubscriptionRepositoryInterface;
use App\Repositories\Batch\LedgerRepositoryInterface;
use App\Repositories\RenewPlan\RenewPlanRepositoryInterface;
use App\Repositories\Page\PageRepositoryInterface;
use App\Repositories\Page\ImageRepositoryInterface;
use App\Repositories\Page\BannerRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Batch\BatchRepositoryInterface',
            'App\Repositories\Batch\BatchRepository',
        );  
        $this->app->bind(
            'App\Repositories\Category\CategoryRepositoryInterface',
            'App\Repositories\Category\CategoryRepository',
        );
         $this->app->bind(
            'App\Repositories\Plan\PlanRepositoryInterface',
            'App\Repositories\Plan\PlanRepository',
        );
         $this->app->bind(
            'App\Repositories\Student\StudentRepositoryInterface',
            'App\Repositories\Student\StudentRepository',
        );
         $this->app->bind(
            'App\Repositories\Gallery\GalleryRepositoryInterface',
            'App\Repositories\Gallery\GalleryRepository',
        );
         $this->app->bind(
            'App\Repositories\Events\EventRepositoryInterface',
            'App\Repositories\Events\EventRepository',
        );
         $this->app->bind(
            'App\Repositories\EBook\EBookRepositoryInterface',
            'App\Repositories\EBook\EBookRepository',
        );
         $this->app->bind(
            'App\Repositories\Service\ServiceRepositoryInterface',
            'App\Repositories\Service\ServiceRepository',
        );
         $this->app->bind(
            'App\Repositories\ServiceImages\ServiceImagesRepositoryInterface',
            'App\Repositories\ServiceImages\ServiceImagesRepository',
        );
         $this->app->bind(
            'App\Repositories\Testimonial\TestimonialRepositoryInterface',
            'App\Repositories\Testimonial\TestimonialRepository',
        );
         $this->app->bind(
            'App\Repositories\TrialClass\TrialClassRepositoryInterface',
            'App\Repositories\TrialClass\TrialClassRepository',
        );
        $this->app->bind(
            'App\Repositories\Inquiry\InquiryRepositoryInterface',
            'App\Repositories\Inquiry\InquiryRepository',
        );
        $this->app->bind(
            'App\Repositories\Contact\ContactRepositoryInterface',
            'App\Repositories\Contact\ContactRepository',
        );
        $this->app->bind(
            'App\Repositories\StudentSubscription\StudentSubscriptionRepositoryInterface',
            'App\Repositories\StudentSubscription\StudentSubscriptionRepository',
        );
         $this->app->bind(
            'App\Repositories\Ledger\LedgerRepositoryInterface',
            'App\Repositories\Ledger\LedgerRepository',
        );
        $this->app->bind(
            'App\Repositories\RenewPlan\RenewPlanRepositoryInterface',
            'App\Repositories\RenewPlan\RenewPlanRepository',
        ); $this->app->bind(
            'App\Repositories\Page\PageRepositoryInterface',
            'App\Repositories\Page\PageRepository',
        );
        $this->app->bind(
            'App\Repositories\Image\ImageRepositoryInterface',
            'App\Repositories\Image\ImageRepository',
        );
        $this->app->bind(
            'App\Repositories\Banner\BannerRepositoryInterface',
            'App\Repositories\Banner\BannerRepository',
        );

    }
}
