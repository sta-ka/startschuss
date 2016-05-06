<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models as Models;

class BackendServiceProvider extends ServiceProvider {

	/**
	* Register the service provider.
	*/
	public function register()
	{
        $this->app->bind(Models\Applicant\ApplicantRepository::class, 	 			    Models\Applicant\DbApplicantRepository::class);
        $this->app->bind(Models\Applicant\Application\ApplicationRepository::class, 	Models\Applicant\Application\DbApplicationRepository::class);
        $this->app->bind(Models\Company\CompanyRepository::class,					    Models\Company\DbCompanyRepository::class);
        $this->app->bind(Models\Company\Job\JobRepository::class, 		 			    Models\Company\Job\DbJobRepository::class);
        $this->app->bind(Models\Event\EventRepository::class,						    Models\Event\DbEventRepository::class);
        $this->app->bind(Models\Applicant\Education\EducationRepository::class,		    Models\Applicant\Education\DbEducationRepository::class);
        $this->app->bind(Models\Applicant\Experience\ExperienceRepository::class,	    Models\Applicant\Experience\DbExperienceRepository::class);
        $this->app->bind(Models\Organizer\OrganizerRepository::class,				    Models\Organizer\DbOrganizerRepository::class);
        $this->app->bind(Models\Misc\Log\InfoRepository::class,						    Models\Misc\Log\DbInfoRepository::class);
        $this->app->bind(Models\Misc\Article\ArticleRepository::class,				    Models\Misc\Article\DbArticleRepository::class);
        $this->app->bind(Models\Misc\Audience\AudienceRepository::class,				Models\Misc\Audience\DbAudienceRepository::class);
        $this->app->bind(Models\Misc\City\CityRepository::class,						Models\Misc\City\DbCityRepository::class);
        $this->app->bind(Models\Misc\Region\RegionRepository::class,					Models\Misc\Region\DbRegionRepository::class);
        $this->app->bind(Models\Misc\Statistic\StatisticRepository::class,              Models\Misc\Statistic\DbStatisticRepository::class);
        $this->app->bind(Models\User\UserRepository::class,							    Models\User\DbUserRepository::class);
        $this->app->bind(Models\User\Login\LoginRepository::class, 		 			    Models\User\Login\DbLoginRepository::class);
	}

}