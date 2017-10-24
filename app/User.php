<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Cashier\Billable;
use DB;

class User extends Authenticatable
{
    use Billable;
	
	protected $fillable = ['name', 'email', 'role_id', 'password', 'referal_code', 'avatar'];
    
    protected $dates = ['trial_ends_at', 'subscription_ends_at', 'deleted_at'];
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the role record associated with the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function getAvatarAttribute()
    {
        return 'uploads/avatars/' . $this->attributes['avatar'];
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
	
	public function getMonthlyBillingAmount(){
		return DB::table('orders')
			->select(DB::raw('SUM(`monthly_cost`) as monthly_cost'))
			->where('user_id', $this->id)
			->where('status', '<>', 4)->value('monthly_cost');
	}

    public function userreferral() {
        return $this->hasOne('App\User', 'user_id', 'id');
    }
	
	public function deduceCredit($amount){
		$this->total_credit -= (float) $amount;
		$this->save();
	}
    
    public function getActions($authUser){
        //die($authUser->role->name);
        if ($authUser->role->name == 'Admin') {
            $editBtn = '<a style="margin-right: 0.1em;" href="' . url('admin/users/' . $this->id . '/edit') . '"  title="Edit"><i class="fa fa-2 fa-pencil"></i></a>';
            if (!is_null($this->role) && $this->role->name != 'Admin') {
                $deleteBtn = '<a href="' . url('admin/users/' . $this->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Delete"><i class="fa fa-2 fa-remove"></i></a>';
            } else {
                $deleteBtn = '';
            }
            $emailBtn = '<a style="margin:0 0.3em;" href="' . url('admin/user/'.$this->id.'/sendCreditNotify') . '"  title="Send Low credit notification"><i class="fa fa-2 fa-envelope"></i></a>';
        }
        $buttons = '' . $editBtn . $emailBtn. $deleteBtn;
        //die($buttons);
        return $buttons;
    }
}
