<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    protected $table="opportunities";
    protected $fillable=[
                            'id', 'organization_id', 'title', 'description', 'start_date', 'end_date',
                            'support_for_volunteer','benefit_for_volunteer','issues', 'volunteering_field_id',
                            'city','status_id','officer_id','type_id','member_type_id','age_type_id','report_image',
                            'opportunity_image','no_of_volunteers','no_of_hours', 'created_at', 'updated_at',
                            'volunteer_type','opportunity_domain','tasks'
    ];
    public $timestamps=false;
}
