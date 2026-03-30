<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    // user types
    const USER_TYPE = [
        'MAIN' => 'M',
        'LEFT' => 'A1',
        'RIGHT' => 'A2'
    ];

    // user types
    const USER_STATUS = [
        'NONE' => '1',
        'HALF' => '2',
        'FULL' => '3',
        'ER' => '4'
    ];

    // user ststus labels
    const USER_STATUS_LABLE = [
        '1' => 'NONE',
        '2' => 'HALF',
        '3' => 'FULL',
        '4' => 'ER'
    ];

    const USER_TYPE_LABLE = [
        'M' => 'MAIN',
        'A1' => 'DUMMY',
        'A2' => 'DUMMY',

    ];
    const GENDER_LIST = ['Male', 'Female', 'Other'];

    const MAIN = 'M';
    const LEFT = 'A1';
    const RIGHT = 'A2';

    // user status
    const NONE = 1;
    const FULL = 2;
    const HALF = 3;
    const ER = 4;

    // user active_status
    const UNBLOCKED = 1;
    const BLOCKED = 2;

    const PAYMENT_TYPE =  [
        'BANK TRANSFER' => 1,
        'ONLINE' => 2
    ];

    const PAYMENT_STATUS =  [
        'PENDING' => 1,
        'HALF' => 2,
        'FULL' => 3
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'referrer_approved_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'salary_amount' => 'decimal:2',
        'share_amount' => 'decimal:2',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        // 'profile_photo_url',
    ];

    // protected $with = ['childA1', 'childA2'];

    public function referrer(): HasOne
    {
        return $this->hasOne(User::class, 'reg_no', 'referrer_id')->select(
            'id',
            'reg_no',
            'er_status',
            'first_name',
            'last_name',
            'name',
            'dummy_a2_id',
            'dummy_a1_id',
            'parent_id',
            'left_points',
            'right_points'
        );
    }

    public function childA1(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'dummy_a1_id')
            ->select(
                'id',
                'reg_no',
                'er_status',
                'name',
                'first_name',
                'last_name',
                'dummy_a2_id',
                'dummy_a1_id',
                'parent_id',
                'left_points',
                'right_points'
            );
    }

    public function childA2(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'dummy_a2_id')
            ->select(
                'id',
                'reg_no',
                'er_status',
                'first_name',
                'last_name',
                'name',
                'dummy_a2_id',
                'dummy_a1_id',
                'parent_id',
                'left_points',
                'right_points'
            );
    }

    public function purchase(): HasOne
    {
        return $this->hasOne(UserPuchasedCourse::class, 'user_id', 'id')
            ->where('type', UserPuchasedCourse::TYPE['REFERRAL'])
            ->select('id', 'user_id', 'course_id', 'type');
    }

    public function bank(): HasOne
    {
        return $this->hasOne(UserBankDetail::class, 'user_id', 'id');
    }

    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class, 'user_id', 'id');
    }

    public function promotionHistories(): HasMany
    {
        return $this->hasMany(PromotionHistory::class, 'user_id', 'id');
    }

    public function city(): HasOne
    {
        return $this->hasOne(DashboardCity::class, 'id', 'dashboard_city_id');
    }

    public function district(): HasOne
    {
        return $this->hasOne(DashboardDistrict::class, 'id', 'dashboard_district_id');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * First name only for SMS and email greetings (never includes last name).
     */
    public function notificationFirstName(): string
    {
        $first = trim((string) ($this->first_name ?? ''));
        if ($first !== '') {
            return $first;
        }

        $full = trim((string) ($this->name ?? ''));
        if ($full === '') {
            return 'Member';
        }

        $parts = preg_split('/\s+/u', $full, -1, PREG_SPLIT_NO_EMPTY);

        return $parts[0] ?? 'Member';
    }

    public function monthlySalaries(): HasMany
    {
        return $this->hasMany(UserMonthlySalary::class, 'user_id');
    }

    public function performances(): HasMany
    {
        return $this->hasMany(UserPerformance::class, 'user_id');
    }

    public function salesIncomes(): HasMany
    {
        return $this->hasMany(UserSalesIncome::class, 'user_id');
    }

    public function monthlyBonuses(): HasMany
    {
        return $this->hasMany(UserMonthlyBonus::class, 'user_id');
    }

    public function getChildAttribute()
    {
        return $this->childA1()->get()->toArray();
    }

    public function approvedReferrals()
    {
        return $this->hasMany(User::class, 'referrer_id', 'id')
            ->where('approved_by_admin', true)
            ->where('approved_by_referrer', true)
            ->where('type', User::USER_TYPE['MAIN'])
            ->where('status', '>=', 2)
            ->select('id', 'reg_no',  'payment_status', 'referrer_id', 'name', 'approved_at', 'status', 'type', 'approved_by_referrer', 'approved_by_admin');
    }

    public function criteriaAssignments()
    {
        return $this->hasMany(CriteriaUserAssignment::class, 'user_id');
    }
}
