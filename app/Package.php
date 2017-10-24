<?php

namespace App;

use App\BaseModel;
use DB;

/**
 * @property mixed name
 * @property array|integer cost
 * @property array|string cost_per
 * @property array|string plan
 * @property array|boolean status
 * @property array|boolean featured
 * @property array|integer pricing_order
 */
class Package extends BaseModel
{
    const BOX_NORMAL = 1;
    const LARGE_ITEM = 2;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    function scopeActive($query)
    {
        return $query->where('status', 1)->orderBy('pricing_order');
    }

    function getStatusAttribute()
    {
        return $this->attributes['status'] ? 'active' : 'inactive';
    }

    function getFeaturedAttribute()
    {
        return $this->attributes['featured'] ? 'featured' : 'normal';
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class)->withPivot('spec')->withTimestamps();
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
    
    public static function getFeaturePackageByPackageId($packageId){
        return DB::table('feature_package')
                ->join('features', 'feature_package.feature_id', '=', 'features.id')
                ->where('feature_package.package_id', $packageId)
                ->get();        
    }
    
    public static function getPackageArray($packages){
        $packages_arr = array();
        foreach($packages as $package){
            $packages_arr[$package->id] = array('box_quantity' => 0, 'amt_service' => 0);
            
            $packages_arr[$package->id]['package'] = $package;
            $feature_packages = self::getFeaturePackageByPackageId($package->id);
            foreach($feature_packages as $feature_package){
                $packages_arr[$package->id]['feature'][$feature_package->name_english] = $feature_package->spec;
            }
        }
        return $packages_arr;
    }
    
    public static function getSinglePackage($package_id){
        return DB::Table('packages')
                ->where('packages.id', $package_id)
                ->first();
    }
}
