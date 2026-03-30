<?php

namespace App\Livewire\Admin\Settings;

use App\Models\MasterSetting;
use App\Models\MasterSettingHistory;
use App\Models\IncomeSalesMultiplier;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $commission_enabled,
        $reg_success_mail_enabled,
        $reg_success_sms_enabled,
        $approved_mail_enabled,
        $approved_sms_enabled,
        $management_sales_multiplier,
        $director_sales_multiplier;

    public function mount()
    {
        $settings = MasterSetting::first();
        if (!isset($settings)) {
            $settings = MasterSetting::create([
                'commission_enabled' => true,
                'reg_success_mail_enabled' => true,
                'reg_success_sms_enabled' => true,
                'approved_mail_enabled' => true,
                'approved_sms_enabled' => true,
            ]);
        }

        $this->commission_enabled = $settings->commission_enabled;
        $this->reg_success_mail_enabled = $settings->reg_success_mail_enabled;
        $this->reg_success_sms_enabled = $settings->reg_success_sms_enabled;
        $this->approved_mail_enabled = $settings->approved_mail_enabled;
        $this->approved_sms_enabled = $settings->approved_sms_enabled;

        $coeff = IncomeSalesMultiplier::query()->first();
        if (!$coeff) {
            $coeff = IncomeSalesMultiplier::query()->create([
                'management_multiplier' => 1000,
                'director_multiplier' => 4000,
            ]);
        }

        $this->management_sales_multiplier = (float) $coeff->management_multiplier;
        $this->director_sales_multiplier = (float) $coeff->director_multiplier;
    }

    public function render()
    {
        return view('livewire.admin.settings.index');
    }

    public function changeCommissionGenerate()
    {

        $settings = MasterSetting::first();
        if ($settings->commission_enabled == false) {
            $settings->commission_enabled = true;
            $this->addToMasterHistory(type: 'COMISSION_GENERATE', status: 'ENABLED');
        } else {
            $settings->commission_enabled = false;
            $this->addToMasterHistory(type: 'COMISSION_GENERATE', status: 'DISABLED');
        }
        $settings->save();

        return $this->mount();
    }

    public function changeRegEmail()
    {

        $settings = MasterSetting::first();
        if ($settings->reg_success_mail_enabled == false) {
            $settings->reg_success_mail_enabled = true;
            $this->addToMasterHistory(type: 'REG_SUCCESS_MAIL', status: 'ENABLED');
        } else {
            $settings->reg_success_mail_enabled = false;
            $this->addToMasterHistory(type: 'REG_SUCCESS_MAIL', status: 'DISABLED');
        }
        $settings->save();

        return $this->mount();
    }

    public function changeRegSms()
    {

        $settings = MasterSetting::first();
        if ($settings->reg_success_sms_enabled == false) {
            $settings->reg_success_sms_enabled = true;
            $this->addToMasterHistory(type: 'REG_SUCCESS_SMS', status: 'ENABLED');
        } else {
            $settings->reg_success_sms_enabled = false;
            $this->addToMasterHistory(type: 'REG_SUCCESS_SMS', status: 'DISABLED');
        }
        $settings->save();

        return $this->mount();
    }

    public function changeAdminApproveSms()
    {

        $settings = MasterSetting::first();
        if ($settings->approved_sms_enabled == false) {
            $settings->approved_sms_enabled = true;
            $this->addToMasterHistory(type: 'ADMIN_APPROVED_SMS', status: 'ENABLED');
        } else {
            $settings->approved_sms_enabled = false;
            $this->addToMasterHistory(type: 'ADMIN_APPROVED_SMS', status: 'DISABLED');
        }
        $settings->save();

        return $this->mount();
    }

    public function changeAdminApproveEmail()
    {

        $settings = MasterSetting::first();
        if ($settings->approved_mail_enabled == false) {
            $settings->approved_mail_enabled = true;
            $this->addToMasterHistory(type: 'ADMIN_APPROVED_MAIL', status: 'ENABLED');
        } else {
            $settings->approved_mail_enabled = false;
            $this->addToMasterHistory(type: 'ADMIN_APPROVED_MAIL', status: 'DISABLED');
        }
        $settings->save();


        return $this->mount();
    }

    private function addToMasterHistory(string $type, string $status)
    {
        MasterSettingHistory::create([
            'type' => $type,
            'status' => $status,
            'changed_by' => Auth::user()->id,
        ]);
    }

    public function saveIncomeSalesMultipliers(): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $this->validate([
            'management_sales_multiplier' => 'required|numeric|min:0',
            'director_sales_multiplier' => 'required|numeric|min:0',
        ]);

        $coeff = IncomeSalesMultiplier::query()->first();
        if (!$coeff) {
            $coeff = new IncomeSalesMultiplier();
        }

        $coeff->management_multiplier = (float) $this->management_sales_multiplier;
        $coeff->director_multiplier = (float) $this->director_sales_multiplier;
        $coeff->save();

        $this->dispatch('success_alert', ['title' => 'Income multipliers updated.']);
    }
}
