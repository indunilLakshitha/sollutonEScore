<?php

namespace App\Livewire\Home;

use App\Models\Course;
use App\Models\User;
use App\Models\UserPuchasedCourse;
use Livewire\Component;

class ThankYou extends Component
{
    public $user_id, $user, $course;

    public function mount($user_id)
    {
        $this->user_id = $user_id;
        $this->user = User::find($user_id);
        $purchase = UserPuchasedCourse::where('user_id', $user_id)->first();
        $course = Course::find($purchase->course_id);
        $this->course = $course;
    }

    public function render()
    {
        return view('livewire.home.thank-you');
    }
}
