<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    public function company_rates()
    {
        return $this->hasMany('App\Model\CompanyRateDetails','companyId','id')->orderBy('type','ASC');
    }

    public function company_discount()
    {
        return $this->hasMany('App\Model\CompanyDiscount','companyId','id');
    }

    public function company_plan()
    {
        return $this->hasMany('App\Model\CompanyPlanDetails','companyId','id')->orderBy('type','ASC');
    }

    public function company_calculation()
    {
        return $this->hasMany('App\Model\CompanyCalculation','companyId','id')->orderBy('type','ASC');
    }

    public function feature()
    {
        return $this->hasMany('App\Model\CompanyFeature','companyId','id');
    }

    public function author()
    {
        return $this->belongsTo('App\User','created_by','id');
    }
}
